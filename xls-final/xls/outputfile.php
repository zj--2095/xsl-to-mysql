<?php
$choice=$_POST['choice'];
/*�������ݿ�*/
$DB_Server = "localhost";
$DB_Username = "root";
$DB_Password = "";
$DB_DBName = "xsl";  //Ŀ�����ݿ���
$DB_TBLName = $choice;  //Ŀ�����
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
$sql = "Select * from $DB_TBLName";
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
?> 