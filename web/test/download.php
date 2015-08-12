<?php
$file_name="中文测试.doc";
$file_name=iconv("UTF-8","GBK",$file_name);//用以解决中文不能显示出来的问题
$file_sub_path="D:/27/";
$file_path=$file_sub_path.$file_name;
$file_path = iconv("UTF-8","GBK",$file_path);
//首先要判断给定的文件存在与否
if(!file_exists($file_path)){
    return ;
}
$fp=fopen($file_path,"r");
$file_size=filesize($file_path);
//下载文件需要用到的头
header("Content-Type: application/octet-stream");
header("Content-Disposition: attachment; filename=".$file_name);
$buffer=1024;
$file_count=0;
//向浏览器返回数据
while(!feof($fp) && $file_count<$file_size){
    $file_con=fread($fp,$buffer);
    $file_count+=$buffer;
    echo $file_con;
}
fclose($fp);
?>