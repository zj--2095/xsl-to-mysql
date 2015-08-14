<?php

error_reporting(E_ALL ^ E_NOTICE);

if($_POST){
$choice = $_POST['choice'];

$Import_TmpFile = $_FILES['file']['tmp_name'];

require_once 'conn.php';

mysql_select_db('xls'); //选择数据库    

require_once 'reader.php';

$data = new Spreadsheet_Excel_Reader();

$data->setOutputEncoding('UTF-8');

$data->read($Import_TmpFile);

$array =array();

    

for ($i = 1; $i <= $data->sheets[0]['numRows']; $i++) {

    for ($j = 1; $j <= $data->sheets[0]['numCols']; $j++) {

     $array[$i][$j] = $data->sheets[0]['cells'][$i][$j];

    }

}

sava_data($array);

}

function sava_data($array){    

    $count =0;    

    $total =0;

    foreach( $array as $tmp){    

         $Isql = "Select id from ".$choice." where id='".$tmp[1]."'";

         $sql = "Insert into ".$choice." value(";

         $sql.="'".$tmp[1]."','".$tmp[2]."','".$tmp[3]."')";
         

        if(! mysql_num_rows(mysql_query($Isql) )){

         if( mysql_query($sql) ){

            $count++;

         }

        }

        $total++;

    }

    echo "<script>alert('共有".$total."条数据，导入".$count."条数据成功');</script>";
    
    $url="http://127.0.0.1/xls/index.html";
    echo "<SCRIPT LANGUAGE=\"JavaScript\">location.href='$url'</SCRIPT>";

    

}

    

function TtoD($text){

    $jd1900 = GregorianToJD(1, 1, 1900)-2;

    $myJd = $text+$jd1900;

    $myDate = JDToGregorian($myJd);

    $myDate = explode('/',$myDate);

    $myDateStr = str_pad($myDate[2],4,'0', STR_PAD_LEFT)."-".str_pad($myDate[0],2,'0', STR_PAD_LEFT)."-".str_pad($myDate[1],2,'0', STR_PAD_LEFT);

    return $myDateStr;        

    }

?> 