<?php
if($_POST)
{$choice = $_POST['choice'];
 if($choice=='service')
 {
	 $url="http://127.0.0.1/xls/inputfile/inputfile1.html";
    echo "<SCRIPT LANGUAGE=\"JavaScript\">location.href='$url'</SCRIPT>";
 }
 if($choice=='departmental')
 {
	 $url="http://127.0.0.1/xls/inputfile/inputfile2.html";
    echo "<SCRIPT LANGUAGE=\"JavaScript\">location.href='$url'</SCRIPT>";
 }
 if($choice=='contact')
 {
	 $url="http://127.0.0.1/xls/inputfile/inputfile3.html";
    echo "<SCRIPT LANGUAGE=\"JavaScript\">location.href='$url'</SCRIPT>";
 }
}
?>