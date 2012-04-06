/*==================

    fpage 分页操作

===================
// 函数说明: 可以自定义url路径的 分页函数 （页码标签为: $page）, 返回分页的html代码字符串
// 参数说明:  num 总记录数, n 每页要显示的记录数, tpl_url 分页链接的URL模板, show_num 显示的最多页码数
// 函数引用: 例如: fpage(100,10,5,"page/$page",10);
*/
function fpage(num,n,nowpage,tpl_url,show_num)
{
	tpl_page = '$page'; //输出页码时的模板标签
	
	num = toint(num);
	n = toint(n);
	
	//计算出最大页码
	var maxpage;
	maxpage = divint(num,n);
	if( (num % n) != 0 ){ maxpage = maxpage + 1; }
	
	nowpage = toint(nowpage);
	if(nowpage<1){ nowpage=1; } //页码下界限定
	if(nowpage>maxpage){ nowpage=maxpage; } //页码上界限定
	
	var html = '';//分页模板
	
	if(num>0){
		html = '<div id="cex_fpage" style="width:100%; height:20px; text-align:center; font-size:12px;">'; //分页模板
		html = html + "总共记录数:<strong>"+ num +"</strong>&nbsp;";
		//首页
		html = html + '<a href="'+ tpl_url.replace(tpl_page,'1')+'">首页</a>&nbsp;';
		//上一页
		if(nowpage>1){
			html = html+'<a href="'+tpl_url.replace(tpl_page,(nowpage-1))+'">&lt;上一页</a>&nbsp;';
		}
		//输出中间页码
		var start; //起始页码
		var end; //结束页码		
		themod = show_num % 2; //取模
		thequo = divint(show_num,2); //取商		
		start = nowpage - thequo + 1; //取得起始页码		
		end = nowpage + thequo + themod; //取得结束页码
		if(start<1){ end = show_num; }
		if(end>maxpage){ start = maxpage - show_num + 1; }		
		for(var i=start;i<=end;i++){
			if(i>=1 && i<=maxpage){
				if(i==nowpage){
				//输出当前页码
					html = html + "["+ i +"]&nbsp;";					
				}else{
				//输出非当前页码
					html = html+'<a href="'+tpl_url.replace(tpl_page,i)+'">['+i+']</a>&nbsp;';			
				}
			}
		}		
		//下一页
		if(nowpage<maxpage){
			html = html+'<a href="'+tpl_url.replace(tpl_page,nowpage+1)+'">下一页&gt;</a>&nbsp;';
		}
		//末页
		html = html+'<a href="'+tpl_url.replace(tpl_page,maxpage)+'">末页</a>&nbsp;';
		//第几页共几条
		html = html+"第<strong>"+nowpage+"/"+maxpage+"</strong>页 <strong>"+n+"</strong>条/页";
		html = html+'</div>';
	}else{
		html = '<div id="cex_fpage" style="width:100%; height:20px; text-align:center; font-size:14px;">当前没有记录!</div>';
	}
	return html;
}