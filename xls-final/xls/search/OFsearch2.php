
<?php
$er = $_POST['er'];
if($_POST&&$er=='yes')
{
	
	$departmental = $_POST['departmental'];
	$phone = $_POST['phone'];
	$address = $_POST['address'];
	$fax = $_POST['fax'];
	$email = $_POST['email'];
	/*�������ݿ�*/
	$DB_Server = "localhost";
	$DB_Username = "root";
	$DB_Password = "";
	$DB_DBName = "xsl";  //Ŀ�����ݿ���
	$DB_TBLName = "departmental";  //Ŀ�����
	$Connect = @mysql_connect($DB_Server, $DB_Username, $DB_Password) or die("Couldn't connect.");
	mysql_query("Set Names 'gb2312'");

	$savename = date("YmjHis"); //����excel�ļ���
	$file_type = "vnd.ms-excel";
	$file_ending = "xls";
	header("Content-Type: application/$file_type;charset=gb2312");
	header("Content-Disposition: attachment; filename=".$savename.".$file_ending");
	//header("Pragma: no-cache");

	/*д�뱸ע��Ϣ*/
	$now_date = date("Y-m-j H:i:s");
	$title = "���ݿ���:$DB_DBName,���ݱ�:$DB_TBLName,��������:$now_date";
	echo("$title\n");

	/*��ѯ���ݿ�*/
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

	/*д����ֶ���*/
	for ($i = 0; $i < mysql_num_fields($result); $i++) {
	 echo mysql_field_name($result,$i) . "\t";
	}
	echo "\n";

	/*д�������*/
	$sep = "\t";
	while($row = mysql_fetch_row($result)) {
	 $data = "";
	  for($i=0; $i<mysql_num_fields($result);$i++) {
	   if(!isset($row[$i]))
		$data .= "NULL".$sep; //����NULL�ֶ�
	   elseif ($row[$i] != "")
		$data .= "$row[$i]".$sep;
	   else
		$data .= "".$sep; //������ֶ�
	  }
	 echo $data."\n";
	}
	
}
else{
	mysql_connect('localhost','root','');
mysql_select_db('xsl');//���ݿ�ѡ��
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
	
 $query = mysql_query($sql ) or die("��ѯ������");
 
 if( mysql_num_rows( $query ) )
 {
	 echo '��ѯ���:';
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
