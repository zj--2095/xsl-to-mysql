<?php
$host="localhost";
$user="root";
$password="";
$database="xsl";
 $connect=@mysql_connect("$host","$user","$password");
if(!$connect)
{
echo "database connect wrong";
exit;
}

$db=mysql_select_db("$database",$connect);
$sql=mysql_query("SET NAMES 'gb2312'");
?>