<?php
//先确认，再写入
$reminder=
    "<script>
    if (!confirm('确定要继续，将会覆盖原来的留言内容！点击取消返回。'))
    {
    history.go(-2);
    }
    </script>";
//打开文件
$datafile=fopen("datafile.xml","w");
if (!$datafile)
{
 echo "错误:无法打开文件！"."<br/>"."联系站长！";
 die();
}
else
{
 $contents=
 "<?xml version='1.0' encoding='ISO-8859-1 ?>
 <{$_POST['type']}>
 <日期>{$_POST['date']}</日期>
 <任务>{$_POST['todo']}</任务>
 <位置>{$_POST['loc']}</位置>
 <标签>{$_POST['lab']}</标签>
 <{$_POST['type']}>
 ";
  if (!file_put_contents(datafile.xml,$contents))
  {
   echo "错误:无法写入文件！"."<br/>"."联系站长！";
   die();
  }
$return=
 "<script>
 alert('写入文件成功，点击确认键返回！');
 history.go(-2);
 </script>
 ";
echo $return;
}
?>