<?php
//---------------------------用户自定义标签函数文件








//显示结合项筛选选项
function user_ShowFieldandChange($ecms=0){
	global $public_r;

	//------- 函数参数设置开始 -----

	//要显示的结合项字段列表，多个字段用半角逗号“,”隔开
	$fieldandvar='myarea,sex,age';

	//字段显示选项设置，多项用双“#”号隔开，格式：选项说明|==|内容1,值1##内容2,值2
	$fieldandval=array();
	$fieldandval['myarea']='<b>地区：</b>|==|不限,##东城,东城区##朝阳,朝阳区##崇文,崇文区##宣武,宣武区##海淀,海淀区##丰台,丰台区';
	$fieldandval['sex']='<b>性别：</b>|==|不限,##男,男##女,女##人妖,人妖';
	$fieldandval['age']='<b>年龄：</b>|==|不限,##1-10,1__10##11-20,11__20##21-30,21__30##31-40,31__40##41-50,41__50##50岁以上,51__200';

	//正常链接样式
	$fieldandcss='fieldandcss';

	//已选的选项链接样式
	$changefieldandcss='changefieldandcss';

	//字段与字段的显示间隔符，格式：开始显示字符|结束显示字符
	$fieldexp='<table><tr><td>|</td></tr></table>';

	//选项与选项的显示间隔符，格式：开始显示字符|结束显示字符
	$valexp='| ';

	//------- 函数参数设置结束 -----


	$userfunecmsver=function_exists('ehtmlspecialchars')?1:0;
	//附加参数
	$urlcs='';
	$mid=(int)$_GET['mid'];
	if($mid)
	{
		$urlcs.='&mid='.$mid;
	}
	if($_GET['classid'])
	{
		$classid=RepPostVar($_GET['classid']);
		$urlcs.='&classid='.$classid;
	}
	else
	{
		if(!$_GET['mid']&&!$_GET['ttid']&&!$_GET['ztid'])
		{
			$classid=intval($GLOBALS['navclassid']);
			$urlcs.='&classid='.$classid;
		}
	}
	if($_GET['ttid'])
	{
		$ttid=RepPostVar($_GET['ttid']);
		$urlcs.='&ttid='.$ttid;
	}
	if($_GET['ztid'])
	{
		$ztid=RepPostVar($_GET['ztid']);
		$urlcs.='&ztid='.$ztid;
	}
	if($_GET['firsttitle'])
	{
		$firsttitle=(int)$_GET['firsttitle'];
		$urlcs.='&firsttitle='.$firsttitle;
	}
	if($_GET['isgood'])
	{
		$isgood=(int)$_GET['isgood'];
		$urlcs.='&isgood='.$isgood;
	}
	if($_GET['endtime'])
	{
		$starttime=RepPostVar($_GET['starttime']);
		$endtime=RepPostVar($_GET['endtime']);
		$urlcs.='&starttime='.$starttime.'&endtime='.$endtime;
	}
	$line=(int)$_GET['line'];
	if($line)
	{
		$urlcs.='&line='.$line;
	}
	$tempid=(int)$_GET['tempid'];
	if($tempid)
	{
		$urlcs.='&tempid='.$tempid;
	}
	if($_GET['orderby'])
	{
		$orderby=RepPostVar($_GET['orderby']);
		$myorder=(int)$_GET['myorder'];
		$urlcs.='&orderby='.$orderby.'&myorder='.$myorder;
	}
	//间隔字符
	$fieldexpr=explode('|',$fieldexp);
	$valexpr=explode('|',$valexp);
	//输出选项
	$fr=explode(',',$fieldandvar);
	$fcount=count($fr);
	$allstr='';
	$urladd='';
	for($i=0;$i<$fcount;$i++)
	{
		$field=$fr[$i];
		//选项链接
		$getval='';
		if($_GET[$field])
		{
			$getval=$userfunecmsver==1?ehtmlspecialchars($_GET[$field],ENT_QUOTES):htmlspecialchars($_GET[$field],ENT_QUOTES);
			$urladd.='&'.$field.'='.urlencode($getval);
		}
		//选项说明
		$vsayr=explode('|==|',$fieldandval[$field]);
		//选项内容
		$valallstr='';
		$vr=explode('##',$vsayr[1]);
		$vcount=count($vr);
		for($vi=0;$vi<$vcount;$vi++)
		{
			$vtr=explode(',',$vr[$vi]);
			if($getval==$vtr[1])
			{
				$css=$changefieldandcss;
			}
			else
			{
				$css=$fieldandcss;
			}
			$valallstr.=$valexpr[0].'<a href="'.$public_r['newsurl'].'e/action/ListInfo.php?'.$urlcs.'&ph=1<!--url.add-->&'.$field.'='.urlencode($vtr[1]).'" class="'.$css.'">'.$vtr[0].'</a>'.$valexpr[1];
		}
		$allstr.=$fieldexpr[0].$vsayr[0].$valallstr.$fieldexpr[1];
	}
	$allstr=str_replace('<!--url.add-->',$urladd,$allstr);
	echo $allstr;
}








?>