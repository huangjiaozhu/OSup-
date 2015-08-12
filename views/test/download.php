<?php
header("Content-type:text/html;charset=utf-8");
$file_name="12.gif";
$file_sub_path="";
$file_path=$file_sub_path.$file_name;
var_dump($file_path);
//首先要判断给定的文件存在与否
if(!file_exists($file_path)){
    echo "没有该文件文件";
    return ;
}
$buffer=1024;
$file_count=0;
//向浏览器返回数据
Header("Content-type: application/octet-stream");
Header("Accept-Ranges: bytes");
Header("Accept-Length:".$file_size);
Header("Content-Disposition: attachment; filename=".$file_name);
echo $file_name;
while(!feof($fp) && $file_count<$file_size){
    $file_con=fread($fp,$buffer);
    $file_count+=$buffer;
    echo $file_con;
}
fclose($fp);
?>