
<?php
$er = $_POST['er'];
if($_POST&&$er=='yes')
{
	
	$departmental = $_POST['departmental'];
	$phone = $_POST['phone'];
	$address = $_POST['address'];
	$fax = $_POST['fax'];
	$email = $_POST['email'];
	/*连接数据库*/
	$DB_Server = "localhost";
	$DB_Username = "root";
	$DB_Password = "";
	$DB_DBName = "xsl";  //目标数据库名
	$DB_TBLName = "departmental";  //目标表名
	$Connect = @mysql_connect($DB_Server, $DB_Username, $DB_Password) or die("Couldn't connect.");
	mysql_query("Set Names 'gb2312'");

	$savename = date("YmjHis"); //导出excel文件名
	$file_type = "vnd.ms-excel";
	$file_ending = "xls";
	header("Content-Type: application/$file_type;charset=gb2312");
	header("Content-Disposition: attachment; filename=".$savename.".$file_ending");
	//header("Pragma: no-cache");

	/*写入备注信息*/
	$now_date = date("Y-m-j H:i:s");
	$title = "数据库名:$DB_DBName,数据表:$DB_TBLName,备份日期:$now_date";
	echo("$title\n");

	/*查询数据库*/
	$sql = "Select * from departmental left join(service,contact) ON (departmental.departmental=service.departmental and departmental.departmental=contact.departmental) ";
	$sql.="where"; 
	#if($departmental!=="")
	$sql.=" departmental.departmental like '%$departmental%'";
    #if($phone!=="")
	$sql.=" and departmental.phone like '%$phone%'";
    #if($address!=="")
	$sql.=" and departmental.address like '%$address%'";
    #if($fax!=="")
	$sql.=" and departmental.fax like '%$fax%'";
    #if($email!=="")
	$sql.=" and departmental.email like '%$email%'";
    
	$ALT_Db = @mysql_select_db($DB_DBName, $Connect) or die("Couldn't select database");
	$result = @mysql_query($sql,$Connect) or die(mysql_error());

	/*写入表字段名*/
	for ($i = 0; $i < mysql_num_fields($result); $i++) {
	 echo mysql_field_name($result,$i) . "\t";
	}
	echo "\n";

	/*写入表数据*/
	$sep = "\t";
	while($row = mysql_fetch_row($result)) {
	 $data = "";
	  for($i=0; $i<mysql_num_fields($result);$i++) {
	   if(!isset($row[$i]))
		$data .= "NULL".$sep; //处理NULL字段
	   elseif ($row[$i] != "")
		$data .= "$row[$i]".$sep;
	   else
		$data .= "".$sep; //处理空字段
	  }
	 echo $data."\n";
	}
	
}
else{
	mysql_connect('localhost','root','');
mysql_select_db('xsl');//数据库选择
mysql_query('set names "gb2312"');
	$departmental = $_POST['departmental'];
	$phone = $_POST['phone'];
	$address = $_POST['address'];
	$fax = $_POST['fax'];
	$email = $_POST['email'];
	$sql = "Select * from departmental left join(service,contact) ON (departmental.departmental=service.departmental and departmental.departmental=contact.departmental) ";
	$sql.="where "; 
	#if($departmental!=="")
	$sql.="departmental.departmental like '%$departmental%'";
    #if($phone!=="")
	$sql.=" and departmental.phone like '%$phone%'";
    #if($address!=="")
	$sql.=" and departmental.address like '%$address%'";
    #if($fax!=="")
	$sql.=" and departmental.fax like '%$fax%'";
    #if($email!=="")
	$sql.=" and departmental.email like '%$email%'";
	
 $query = mysql_query($sql ) or die("查询出错了");
 
 if( mysql_num_rows( $query ) )
 {
	 echo '查询结果:';
	 echo '<table border="1">';
	 echo '<tr>';
	 echo "<th>departmental</th>";
	 echo "<th>phone</th>";
	 echo "<th>address</th>";
	 echo "<th>fax</th>";
	 echo "<th>email</th>";
	 echo "<th>systemname</th>";
	 echo "<th>city</th>";
         echo "<th>ip</th>";
	 echo "<th>port</th>";
	 echo "<th>protocol</th>";
         echo "<th>systeminfo</th>";
	 echo "<th>database</th>";
	 echo "<th>middleware</th>";
	 echo "<th>framework</th>";
	 echo "<th>script</th>";
	 echo "<th>language</th>";
	 echo "<th>developer</th>";
	 echo "<th>maintenance</th>";
	 echo "<th>trusteeship</th>";
	 echo "<th>departmental</th>";
	 echo "<th>contact</th>";
         echo "<th>contact</th>";
     	 
	 echo "<th>phone</th>";
	 echo "<th>departmental</th>";
	 echo "<th>email</th>";
	 
	 echo '</tr>';
  while( $rs = mysql_fetch_array( $query ) )
  {
   
   
   echo '<tr>';
   echo '<td>'.$rs['departmental'].'</td>';
   echo '<td>'.$rs['phone'].'</td>';
   echo '<td>'.$rs['address'].'</td>';
   echo '<td>'.$rs['fax'].'</td>';
   echo '<td>'.$rs['email'].'</td>';
   echo '<td>'.$rs['systemname'].'</td>';
   echo '<td>'.$rs['city'].'</td>';
   echo '<td>'.$rs['ip'].'</td>';
   echo '<td>'.$rs['port'].'</td>';
   echo '<td>'.$rs['protocol'].'</td>';
   echo '<td>'.$rs['systeminfo'].'</td>';
   echo '<td>'.$rs['database'].'</td>';
   echo '<td>'.$rs['middleware'].'</td>';
   echo '<td>'.$rs['framework'].'</td>';
   echo '<td>'.$rs['script'].'</td>';
   echo '<td>'.$rs['language'].'</td>';
   echo '<td>'.$rs['developer'].'</td>';
   echo '<td>'.$rs['maintenance'].'</td>';
   echo '<td>'.$rs['trusteeship'].'</td>';
   echo '<td>'.$rs['departmental'].'</td>';
   echo '<td>'.$rs['contact'].'</td>';
   echo '<td>'.$rs['contact'].'</td>';
   echo '<td>'.$rs['phone'].'</td>';
   echo '<td>'.$rs['departmental'].'</td>';
   echo '<td>'.$rs['email'].'</td>';
   
   echo '</tr>';
   echo '<br>';
  }
 }
}
?>
