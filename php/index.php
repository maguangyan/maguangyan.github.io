<?php
$pin="7407840";//设置密码
$form1="<form action='index.php' method='post'>";
$form2="密码:<input type='password' name='pin'>";
$form3="登录到:<input type='radio' name='to' value='read' checked/>读取界面"." "."<input type='radio' name='to' value='write'/>写入界面";
$form4="<input type='submit' value='提交'>"."</form>";//设置登录密码框
$action="passwithoutpin";//设置参数:跳过密码进入系统
if ($_POST['pin']===$pin || $_GET['action']===$action)
{
 if ($_REQUEST['to']==="read")
 {echo "<script>alert('已登录到读取界面')</script>";
  /*
  以下为读取界面主要代码
  */
  echo "<br/>";
  $datafile=fopen("datafile.xml","r");
$filedata=fread($datafile,4096);
   if (!$datafile)
   {
    echo "错误:无法打开文件！"."<br/>"."联系站长！";
    die();
   }//以"read"模式打开文件
  $parser=xml_parser_create();//开始解析xml文件
  if (!xml_parse_into_struct($parser,$filedata,$data))
  {
   echo "错误:".xml_error_string(xml_error_code($parser))."<br/>";
   echo "当前行:".xml_get_current_line_number($parser)."<br/>";
   echo "当前列:".xml_get_current_column_number($parser);
   die();
  }
  else
  {
   xml_parser_free($parser);
  }
  echo "<h3>留言条目</h3>";
  echo "<br/>".$data[0]['tag'];
  echo "<br/>".$data[1]['tag'].":".$data[1]['value'];
  echo "<br/>".$data[3]['tag'].":".$data[3]['value'];
  echo "<br/>".$data[5]['tag'].":".$data[5]['value'];
  echo "<br/>".$data[7]['tag'].":".$data[7]['value'];
  fclose($datafile);
 }
 elseif ($_REQUEST['to']==="write")
 {
  echo "<script>alert('已登录到写入界面')</script>";
  /*以下为写入界面主要代码
  */
  echo "<br/>";
  echo "<h3>新建新留言</h3>";
  echo "<form action='write.php' method='post'>";
  echo "留言类型:<input type='radio' name='type' value='任务'>任务";
  echo "<input type='radio' name='type' value='提醒'>提醒";
  echo "<input type='radio' name='type' value='信息'>信息"."<br/>";
  echo "日期:<input type='text' name='date'/>"."<br/>";
  echo "任务:<input type='text' name='todo'/>"."<br/>";
  echo "位置:<input type='text' name='loc'/>"."<br/>";
  echo "标签:<input type='text' name='lab'/>"."<br/>";
  echo "<input type='submit' value='提交'>";
  echo "</form>";
 }
}
elseif ($_POST['password'] != $pin && isset($_POST['password']))
{
echo "密码错误！";
}
else
{
echo $form1."<br/>".$form2."<br/>".$form3."<br/>".$form4;
echo "请输入密码！";
}
?>