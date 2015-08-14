<?php
$choice=$_POST['choice'];
/*连接数据库*/
$DB_Server = "localhost";
$DB_Username = "root";
$DB_Password = "";
$DB_DBName = "xsl";  //目标数据库名
$DB_TBLName = $choice;  //目标表名
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
$sql = "Select * from $DB_TBLName";
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
?> 