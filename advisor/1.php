<?php
/*
 * 
 * @Authors peng--jun 
 * @Email   1098325951@qq.com
 * @Date    2015-10-04 01:27:23
 * @Link    http://www.cnblogs.com/xs-yqz/
 * @version $Id$
 思路
用fopen函数和fread函数得到模板，然后用str_replace函数替换模板标签为变量，最后用fwrite函数输出新的HTML页面
 ==========================================
 */
 header("Content-type: text/html; charset=UTF-8"); 
 $conn=mysql_connect('localhost','root','');  
 $db=mysql_select_db('minda',$conn);  
 mysql_query('set names utf8');  
 $sql="select * from notice";  
 $query=mysql_query($sql);  
 
//print_r($arr);  
 while($arr=mysql_fetch_array($query))  
 {  
     $title=$arr['title'];  
     $content=$arr['content'];  
     $file="index.html";  
     $neirong=$arr['id'].".html";  
     //fopen函数和fread函数得到的模板
     $fp=fopen($file,'r')or die("文件打开失败");//fopen参数有两个，第一个是要被打开文件的URL，第二个是打开方式
     $ht=fread($fp,filesize($file));//读取文件的所有内容  $ht=fread($fp,100);//表示从文件中读取前100个字节
     //用str_replace函数替换模板标签为变量
     $str=str_replace('{title}',$title,$ht);//将$ht中全部的{title}都被$title替换之后的结果，赋值给变量str
     $str=str_replace('{content}',$content,$str); //将上面$str中全部的{content}都被$content替换之后的结果，赋值给变量$str
     fclose($file);
     //用fwrite函数输出新的HTML页面  
     $file_new=fopen($neirong,'w');  //选定指定的模版
     $write=fwrite($file_new,$str);  //将内容写入到指定的文件夹中
 }  



/*fgets()读取方式===从文件资源中一行一行的读取文件内容
$handle = fopen("jun.txt", "r") or die("文件打开失败");
while (!feof($handle)) {
    # code...
    $buffer = fgets($handle,4096);
    echo "<b>".$buffer."</b><br>";
}
fclose($handle);
*/

/* readfile()读取方式
readfile("jun.txt");*/

/*fread()读取方式
$handle = fopen("jun.txt", "r") or die("文件打开失败");
$txt = fread($handle, filesize("jun.txt"));
fclose($handle);
echo $txt;
*/



/*fwrite(handle, string)写入文件
$fileName = "jun1.txt";
$handle = fopen($fileName, 'w')or die('打开<b>'.$fileName.'</b>文件失败！！');

for ($row=0; $row < 10; $row++) { 
    fwrite($handle, $row.":这是写入的文件内容\n");
}
fclose($handle);
*/

/*file_put_contents(filename, data)快速写入文件
$fileName = "jun1.txt";
$data = "共有10条数据\n";
for ($row=0; $row < 10; $row++) { 
    $data.=$row.":写入的文件内容\n";
}
file_put_contents($fileName, $data);
*/

 ?>