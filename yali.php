<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>压力测试</title>
</head>
<body>
<div  align="center" style=" margin:50px auto; font-size: 36px; color: #9fbbe1;"><span>压力测试</span></div>
<div align="center" id="divcontent">
insert into database test ->tabale info to the infomation of <span id="content"></span>
//
	
</div>	


<div id="jsdiv">

<script>
	var insert=document.getElementById('content')
	var insertdiv=document.getElementById('divcontent')
	var jsdiv=document.getElementById('jsdiv')
	var id1= insertdiv.innerHTML

</script>


	<?php 
	ini_set('max_execution_time', '18000');

	include('./mysqli.php');
	$mysqli=qi::getmysqli();
	$link=$mysqli->res;

	// // 建表

	// $sql= "CREATE TABLE `info` (
	//   `id` int(12) NOT NULL AUTO_INCREMENT,
	//   `time` int(12) DEFAULT NULL,
	//   `information` text,
	//   PRIMARY KEY (`id`)
	// ) ENGINE=MyISAM DEFAULT CHARSET=latin1;"; //下面是写到一行内的方便注释!!!
	// $sql= "CREATE TABLE `info` (`id` int(12) NOT NULL AUTO_INCREMENT,`time` int(12) DEFAULT NULL,`information` text,PRIMARY KEY (`id`) ) ENGINE=MyISAM DEFAULT CHARSET=latin1;"; //这和上面一样上面方便理解,这里是写到一行内的方便注释!!!

	$arrStr = array('接数','据库','选择','数据','库','connect','mysqli','connect','localhost','root','englishok','or','die','Unale','to','connect','设置显示字符集','sql','set','names','utf8','执行sql语句','mysqli','query','connect','sql','选择数','据表','查询单条数','据并以','json','的格式输出','sql','select','from','cetsix','where','word','.word.','执行sql语句返回结果集','result','mysqli','query','connect','sql','row','mysqli','fetch','row','result','echo','json','encode','row','sql','select','from','cetsix','执行sql语句返回结果集','result','mysqli','query','connect','sql','通过循环获得数组','while','row','mysqli','fetch','row','result','list[]','row','print','r','list','创建对象并打开连接，最后一个参数是选择的数据库名称','mysqli','new','mysqli','localhost','root','conn','检查连接是否成功','if','mysqli','connect','errno','注意mysqli','connect','error','新特性','die','Unable','to','connect!','.','mysqli','connect','error','sql','select','from','msg','执行sql语句，完全面向对象的','result','mysqli->query','sql','while','row','result->fetch','array','list[]','row' );

	$yali=100000;
	$nn=50;
	$tipe=100/$nn;
	$shownum= ceil($yali/$nn);
	var_dump($shownum);
	$arrnum = array();
	for ($i=0; $i < $yali; $i++) { 

		$arr=array_rand($arrStr,20);
		$str='';
		foreach ($arr as $key => $value) {
			$str.=$arrStr[$value];
		}
		$time = time();
		// sql语句
		$sql='insert into `info` values("null","'. $time . '","'.$str.'")';
		//$sql= 'select * from info where id= 1';
		$res=mysqli_query($link,$sql);if(!$res)break;

		if(!($i % $shownum == 0 ))continue;
		//$shownum+=3;
		$per+=$tipe;
		array_unshift($arrnum,$per);	
		$arrcount=count($arrnum);
		if($arrcount>5)array_pop($arrnum);
		$divstr='';
		foreach ($arrnum as $key => $value1) {
			$divstr.= "insert into database test ->tabale info to the infomation of $value1 <br />";
			//echo "<script>insertdiv.innerHTML = 'insert into database test ->tabale info to the infomation of $value '</script>";
		}
		echo "<script>insertdiv.innerHTML='$divstr'</script>";
		echo "<script>jsdiv.innerHTML=''</script>";

		ob_flush(); //把php缓存写入apahce缓存
		flush(); //把apahce缓存写入浏览器缓存	
	}

	$sql='select id,time from info where id in ((select min(id) from info),(select max(id) from info))';
	$res=mysqli_query($link,$sql);
	$datearr=mysqli_fetch_all($res);
	
	@$begintime=date('Y-m-d H:i:s',$datearr[0][1]);
	@$endtime=date('Y-m-d H:i:s',$datearr[1][1]);
	$showtime=($datearr[1][1]-$datearr[0][1])/60 ;
	if($showtime<1){
		$showtime=($datearr[1][1]-$datearr[0][1]) ;
		$timestr=$showtime."秒钟";
	}else{
		$showtime=floor($showtime) ;
		$showtimes=($datearr[1][1]-$datearr[0][1])%60;
		$timestr=$showtime."分".$showtimes."秒";
	}


	echo "<br />";
	echo " <table width='80%' border='1' align='center' rules='all'>
	<tr>
		<th>开始插入的数据:</th>
		<th>开始插入的时间:</th>
		<th>操作的时间:</th>
	</tr>
	<tr>
		<th>{$datearr[0][0]}</th>
		<th>$begintime</th>
		<th>插入数据库数目:$yali</th>
	</tr>
	<tr>
		<th>{$datearr[1][0]}</th>
		<th>$endtime</th>
		<th>$timestr</th>
	</tr>
</table> ";
	

	 ?>

</div>

</body>
</html>
