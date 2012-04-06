<?php
/*//=================================
//
//	 Oracle数据库操作类 oracle [更新时间: 2009-9-5]
//
//===================================*/

// 【文件名】:                c_ora_db.inc
// 【作  用】:               
// 【作  者】:                天灰
//  
// 【最后修改日期】：        2001/05/11[cxx]      
// 【变量定义规则】：‘C_’=字符型,‘I_’=整型,‘N_’=数字型,‘L_’=布尔型,‘A_’=数组型

//    ※db_logon()                    开启数据库连接     
//    ※db_query()                    通用select             
//    ※db_change()                    数据库改变的通用函数（insert,delete,update）
//    ※db_insert()                    insert,直接调用db_change()
//    ※db_delete()                    delete,直接调用db_change()
//    ※db_update()                    update,直接调用db_change()                 
//    ※db_commit()                    事务递交
//    ※db_rollback()                    事务回退
//    ※db_logoff()                    断开数据库连接
//------------------------------------------------------------------------------------------


class oracle
{
	//        变量定义
    var $C_user          = "";              //数据库用户名
    var $C_passwd        = "";            //数据库口令
    var $C_db            = "";                    //数据库名
    var $I_linkID        = 0;                          //连线句柄
    var $I_stmtID        = 0;                          //查询句柄
    var $color             ="";                    //全局颜色


	//        函数名：db_logon()
	//        作  用：开启数据库连接
	//        参  数：无
	//        返回值：连线句柄（整型）
	//        备  注：无
    function  db_logon()    
    {    
        $this->I_linkID =  @OCILogon($this->C_user,$this->C_passwd,$this->C_db);
        if ($this->I_linkID == 0){AlertExit('数据库链接失败，请与DBA联系！');}
        return  $this->I_linkID;    
    }


	//        函数名：db_query($C_sql,$A_define="",$I_start=-1,$I_end=-1)
	//        作  用：select
	//        参  数：$C_sql                    sql语句
	//                $A_define                需绑定的字段。数组型         
	//                $I_start                开始取记录 -1则取出查询的所有记录
	//                $I_end                    结束取纪录
	//        返回值：二维数组($A_rs)
	//        备  注：通过数字0,1,2....可访问对应字段的值; 或通过查询字段名也可访问对应字段的值
	//                如通过$A_rs[0][0]或$A_rs[0]['NAME']或$A_rs[0]['name']都可访问首条记录NAME字段
	//                $I_start,$I_end是配合分页使用的参数。
    function  db_query($C_sql,$A_define="",$I_start=-1,$I_end=-1)
    {    
       if (!$C_sql){AlertExit("参数不全！");}//检查参数
        
       //连接检测
       if ($this->I_linkID == 0){AlertExit('数据库链接失败，请与DBA联系！');}
        
       //格式检测
       $this -> I_stmtID = OCIParse($this -> I_linkID,$C_sql);     
       if (!$this -> I_stmtID){AlertExit(' sql格式出错！请与程序员联系');}
        
       //如果没指定绑定的字段，则从SQL语句中去取
       if($A_define=="")
       {
            $A_Cur = explode("select",$C_sql);
            $A_Cur = explode("from",$A_Cur[1]);
            $A_define = explode(",",$A_Cur[0]);
       }
       
           //绑定数据库表字段
        if(gettype($A_define) == "array")            //查询列是数组
        {
            for($i=0;$i<count($A_define);$i++)
            {
                $A_define_up[$i] = trim(strtoupper($A_define[$i]));    //大写并去除空格
            }
            for($i=0;$i<count($A_define_up);$i++)
            {
                OCIDefineByName($this->I_stmtID,"$A_define_up[$i]",&$$A_define[$i]);    //绑定
            }
        }
        elseif(trim($A_define) <> "")                //查询列只有一个
        {
            $A_define_up = trim(strtoupper($A_define));
            OCIDefineByName($this -> I_stmtID,"$A_define_up",&$$A_define);
        }

        //执行绑定好的SQL语句
        if(!OCIExecute($this -> I_stmtID))
        {
            echo "<font color=red><b>执行出错:</b></font>SQL Error:<font color=red>$C_sql</font><br>";
            return false;
        }
         
        $lower = 0;                    //返回二维数组的第一维下标控制变量
        $cnt = 0;                    //开始取数标识
         
        //取记录
        while (OCIFetchInto($this -> I_stmtID,&$cur,OCI_ASSOC))
        {
            //取查询出来的所有记录
            if ($I_start == -1)
            {
                if (gettype($A_define) == "array")        //查询列是数组
                {
                    for ($i=0;$i<count($A_define);$i++)
                    {
                        if ($cur[$A_define_up[$i]] <> $$A_define[$i])
                        {
                            $$A_define[$i] = $cur[$A_define_up[$i]];     
                        }
                        $A_rs[$lower][$i] = $$A_define[$i];                    //用数字访问
                        $A_rs[$lower][$A_define[$i]] = $$A_define[$i];        //用小些访问
                        $A_rs[$lower][$A_define_up[$i]] = $$A_define[$i];    //用大写访问
                    }         
                }
                elseif (trim($A_define) <> "")            //查询列只有一个
                {
                     
                    if ($cur[$A_define_up] <> $$A_define)
                    {
                        $$A_define = $cur[$A_define_up];     
                    }
                    $A_rs[$lower][0] = $$A_define;                    //用数字访问
                    $A_rs[$lower][$A_define] = $$A_define;        //用小写访问
                    $A_rs[$lower][$A_define_up] = $$A_define;    //用大些访问
                }
                $lower++;            //下标加一
            }
             
            //取出指定记录(配合分页使用)
            if ($I_start <> -1)
            {
                if ($cnt >= $I_start)
                {
                    $cnt++;
                    if ($I_end - $I_start <> 0)
                    {
                        $I_end--;
                            if (gettype($A_define) == "array")
                            {
                                for($i=0;$i<count($A_define_up);$i++)
                                {
                                    if ($cur[$A_define_up[$i]] <> $$A_define[$i])
                                    {
                                        $$A_define[$i] = $cur[$A_define_up[$i]];     
                                    }
                                    $A_rs[$lower][$i] = $$A_define[$i];                    //用数字访问
                                    $A_rs[$lower][$A_define[$i]] = $$A_define[$i];        //用小些访问
                                    $A_rs[$lower][$A_define_up[$i]] = $$A_define[$i];    //用大写访问
                                }
                            }elseif(trim($A_define) <> "")
                            {
                                if ($cur[$A_define_up] <> $$A_define)
                                {
                                    $$A_define = $cur[$A_define_up];     
                                }
                                $A_rs[$lower][0] = $$A_define;                    //用数字访问
                                $A_rs[$lower][$A_define] = $$A_define;        //用小些访问
                                $A_rs[$lower][$A_define_up] = $$A_define;    //用大写访问                     
                            }
                        $lower++;
                    }else
                    {
                        break;        //如果$I_end-$I_start=0  表示取完记录并跳出while循环
                    }     
                }else
                {
                    $cnt++;        //如果$cnt<$I_start,$cnt++
                }                 
            }
             
        }     //while的结束
         
        //释放句柄并返回查询数据（一个二维数组）
        OCIFreestatement($this -> I_stmtID);
        return $A_rs;      
         
    } //function的结束


	//        函数名：db_change($C_sql,$A_bind)
	//        作  用：db change
	//        参  数：$C_sql                        sql语句
	//                $A_bind                        需绑定的字段。数组型         
	//        返回值：布尔值
	//        备  注：insert,delete,update通用
    function db_change($C_sql,$A_bind="")
    {
        if (!$C_sql){AlertExit("参数不全！");}//检查参数
         
        //连接检测
        if($this -> I_linkID==""){    AlertExit("我们的数据库正忙，请稍后再连接！");}     
         
        //格式检测
        $this -> I_stmtID = OCIParse($this -> I_linkID,$C_sql);     
        if (!$this -> I_stmtID){AlertExit(' sql格式出错！请与程序员联系');}
         
        //绑定
        if(gettype($A_bind) == "array")
        {
            for($i=0;$i<count($A_bind);$i++)
            {
                global $$A_bind[$i];
                $$A_bind[$i] = StripSlashes($$A_bind[$i]);            //去掉反斜线字元
                $$A_bind[$i] = str_replace("<?","< ?",$$A_bind[$i]);    //过滤掉PHP标示
            }
            for($i=0;$i<count($A_bind);$i++){
                OCIBindByName($this -> I_stmtID, ":$A_bind[$i]", &$$A_bind[$i], -1);  //绑定
            }
        }
        elseif(trim($A_bind) <> "")                                //不是数组，是字符
        {
            global $$A_bind;
            $$A_bind = StripSlashes($$A_bind);
            $$A_bind = str_replace("<?","< ?",$$A_bind);                //过滤掉PHP标示
            OCIBindByName($this -> I_stmtID, ":$arrBind", &$$A_bind, -1);                 
        }
         
        //执行并检测是否成功
        if(!OCIExecute($this -> I_stmtID,OCI_DEFAULT))
        {
            echo "<font color=red><b>执行出错:</b></font>SQL Error:<font color=red>$C_sql</font><br>";
            return false;
        }
         
        /*//传回受影响的行数
        global $I_changenum;
        $I_changenum = OCINumrows($this -> I_stmtID);*/
         
        //释放句柄，传回值
        OCIFreeStatement($this -> I_stmtID);
        return true;
    }

	//        函数名：db_delete($C_sql)
	//        作  用：delete
	//        参  数：C_sql                    sql语句
	//        返回值：布尔值
	//        备  注：该函数只是为了使用直观,本质调用db_change()
    function db_delete($C_sql)
    {
        return $this -> db_change($C_sql);
    }

	//        函数名：db_insert($C_sql,A_bind)
	//        作  用：insert
	//        参  数：C_sql                    sql语句
	//                A_bind                    绑定
	//        返回值：布尔值
	//        备  注：该函数只是为了使用直观,本质调用db_change()
    function db_insert($C_sql,$A_bind="")
    {
        return $this -> db_change($C_sql,$A_bind);
    }

	//        函数名：db_update($C_sql,A_bind)
	//        作  用：update
	//        参  数：C_sql                    sql语句
	//                A_bind                    绑定
	//        返回值：布尔值
	//        备  注：该函数只是为了使用直观,本质调用db_change()
    function db_update($C_sql,$A_bind="")
    {
        return $this -> db_change($C_sql,$A_bind);
    }


	//        函数名：db_commit()
	//        作  用：事务递交
	//        参  数：无
	//        返回值：布尔值
	//        备  注：无  
    function db_commit()
    {
        return    (OCICommit($this->I_linkID));
    }     


	//        函数名：db_rollback()
	//        作  用：事务回退
	//        参  数：无
	//        返回值：布尔值
	//        备  注：无    
    function db_rollback()
    {
        return  (OCIRollback($this->I_linkID));
    }     


	//        函数名：db_logoff()
	//        作  用：断开数据库连接
	//        参  数：无
	//        返回值：布尔值
	//        备  注：无     
    function db_logoff()
    {
        return (OCILogoff($this->I_linkID));
    }

}
?> 