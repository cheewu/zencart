<?php
/*//=================================
//
//	 MS Sql Server数据库操作类 mssql [更新时间: 2009-9-5]
//
//===================================*/
  
  class mssql
 {
  
   var $Host = "192.168.0.199"; // Hostname of our MySQL server
   var $Database = "test"; // Logical database name on that server
   var $User = "user"; // Database user
   var $Password = "password"; // Database user’s password
  
   var $Link_ID = 0; // Result of mssql_connect()
   var $Query_ID = 0; // Result of most recent mssql_query()
   var $Row = 0; // Current row number
   var $Errno = 0; // Error state of query
   var $Error = "";
  
  var $AffNum=0;
  
  /**************************************
   *打印错误方法：显示页面处理的错误信息。
  ****************************************/
  function Halt($msg) 
  {
   	printf("</td></tr></table><b>Database error:</b> %s<br>\n", $msg);
   	printf("<b>mssql Error</b>: %s (%s)<br>\n",
   	$this->Errno,
   	$this->Error);
   	die("Session halted.");
  }
  
  /**************************************
   *连接数据库，并且选择默认的数据库
   **************************************/
  function Connect() 
  {
	if ( 0 == $this->Link_ID ) {
  		$this->Link_ID=mssql_connect($this->Host,$this->User,$this->Password) or die("Couldn’t connect to SQL Server on $servername");
  		$db=@mssql_select_db($this->Database,$this->Link_ID);
   		if (!$this->Link_ID){ $this->Halt("Link-ID == false, mssql_connect failed"); }
   	}
  }
  
  /****************************************
   *关闭数据库，如果数据库连接已打开则关闭他
   *请在调用Connect()并处理后使用Close()
   ****************************************/
  function Close()
  {
  	if (0 != $this->Link_ID){
  		mssql_close();
  	}
  }
  
  /*************************************************
   *输入sql语句，有select,update,insert,delete
   *包括存储过程也能通过这个方法来调用。
   *************************************************/
  function Query($Query_String)
  {
	$this->Connect();
  
	$this->Query_ID = mssql_query($Query_String);
	$this->Row = 0;
	if(!$this->Query_ID){
	  $msg=mssql_get_last_message();
	  if($msg==null || $msg==""){	  
		  $this->AffNum=1;
		  return 1;
	  }
	  if(strtolower(substr($Query_String,0,6))!="select"){
		  $this->AffNum=1;
		  return 1;
  	  }
  
	  $this->Errno = 1;
	  $this->Error = "General Error (The mssql interface cannot return detailed error messages)(".$msg.").";
	  $this->halt("Invalid SQL: ".$Query_String);
    }
    return $this->Query_ID;
  }
  
  /*******************************************************
   *把查询数据库的指针移到下一条记录
   *******************************************************/
  function NextRecord()
  {
	  $this->Record = array();
	  mssql_next_result($this->Query_ID);
	  $this->Record=mssql_fetch_array($this->Query_ID);
  
	  $result = $this->Record;
	  if(!is_array($result)) return $this->Record;
	  foreach($result as $key => $value){
		  $keylower=strtolower($key);
		  if($keylower!=$key) $this->Record[$keylower]=$value;
	  }  
   	  return $this->Record;
   }
  
  /********************************************************
   *重新定位查询数据库的指针
   ********************************************************/
  function Seek($pos)
  {
	  if($pos<=0) return;
	  if(eregi("[0-9]",$pos)) mssql_data_seek($this->Query_ID,$pos);
   }
  
  /********************************************************
   *获取查询数据库得到的总行数
   ********************************************************/
  function NumRows() 
  {
	  if($this->Query_ID){
	  	$num_rows=mssql_num_rows($this->Query_ID);
	  }else{
	  	$num_rows=$this->AffNum;
  	  }
   	  return $num_rows;
   }
  
  /*******************************************************
   *字段数
   *******************************************************/
  function NumFields()
  {
  	return count($this->Record)/2;
  }
  
  /*******************************
   *该字段的值
   *******************************/
  function FieldValue($Field_Name)
  {
  	return $this->Record[$Field_Name];
  }
  
  /******************************
   *update,insert,delete影响的行数
   ******************************/
  function AffectedRows()
  {
  	if($this->Query_ID){
  		return mssql_num_rows($this->Query_ID);
  	}else{
  		return $this->AffNum;
	}
  }
  
  
}  
  
/*/  以下是使用示例：  

  //构造新的DB类
  $DBConn=new DB;
  
  //写入sql查询语句
  $SqlStr="select * from test";
  $DBConn->Query($SqlStr);
  
  //循环输出查询得到的结果
  while($Row=$DBConn->NextRecord()){
  echo $Row[testid];
  }
  
  //关闭数据库连接
  $DBConn->Close(); 
*/

?> 