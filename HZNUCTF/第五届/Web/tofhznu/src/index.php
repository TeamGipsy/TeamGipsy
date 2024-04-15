<?php
error_reporting(0);
header('Content-Type: text/html; charset=utf-8');
highlight_file('Jay17ashjdaskdhasadasdadsadssdasdadsasdasdasdasdxcvnxkjcvnxjcsdhkjashdjkadjk.php');

//以代码输出代替命令执行结果，让选手误以为成功利用了一句话木马，但是一直得不到正确的flag。
//比如选手传参ls /,返回事先准备好的想让选手看见的根目录内容，选手传参cat /flag返回ISCTF{fake_flag}
//破局方法很简单，选手只需要ls和cat index.php亲自查看源码内容即可。
//不是什么难题，偏脑洞和趣味性，以及有时候眼睛看到的不一定是真的哈哈哈哈。


if (isset($_POST['1']) && (strpos($_POST['1'], 'flag') !== false || strpos($_POST['1'], 'f*') !== false || strpos($_POST['1'], 'fl*') !== false || strpos($_POST['1'], 'fla*') !== false || (strpos($_POST['1'], 'f') !== false  &&  strpos($_POST['1'], '?') !== false) ) ){
    echo 'HZNU{this_is_real_flag}';
} elseif( isset($_POST['1'])  &&  strpos($_POST['1'], 'ls') !== false &&  strpos($_POST['1'], 'ls ..') == false  &&  strpos($_POST['1'], 'ls /') == false  ){
    echo 'index.php';
}else{
    eval($_POST['1']);
}




eval($_POST['ljtn']);
?>