package main

import (
	"fmt"
	"math/rand"
	"net/http"
	"net/url"
	"os"
	"strconv"
	"strings"
	"time"
)

func main1() {
	http.HandleFunc("/", homeHandler)
	http.HandleFunc("/r4Mkl", oneone)
	http.HandleFunc("/RAvvkto", tototo)
	http.HandleFunc("/r4nK1a3t", lastttt)

	fmt.Println("Server starting on port 9033...")
	if err := http.ListenAndServe(":9033", nil); err != nil {
		fmt.Printf("Error starting server: %s\n", err)
	}

}

// 主页路由的处理函数
func homeHandler(w http.ResponseWriter, r *http.Request) {
	// 设置响应头部的内容类型为HTML
	w.Header().Set("Content-Type", "text/html; charset=utf-8")

	// 向响应体写入文字
	fmt.Fprint(w, "<br>Go开发也需要懂安全哦~~~<br>")
	fmt.Fprint(w, "简单闯个关吧，第一关路由：/r4Mkl")
}

// 第一关
func oneone(w http.ResponseWriter, r *http.Request) {
	w.Header().Set("Content-Type", "text/html; charset=utf-8")

	fmt.Fprintln(w, "长城杯没中的彩票，这次可别错过咯:)")

	// 获取当前时间
	currentTime := time.Now()
	// 输出当前时间的Unix时间戳
	fmt.Fprintln(w, "当前时间戳为:", currentTime.Unix())
	// 使用当前时间的Unix纳秒时间戳初始化随机种子
	rand.Seed(currentTime.Unix())
	// 生成一个随机数
	randomNumber1 := rand.Int()
	randomNumber2 := rand.Int()
	randomNumber3 := rand.Int()
	randomNumber4 := rand.Int()
	randomNumber5 := rand.Int()
	randomNumber6 := rand.Int()
	randomNumber7 := rand.Int() + randomNumber1 - randomNumber1 + randomNumber2 - randomNumber2 + randomNumber3 - randomNumber3 + randomNumber4 - randomNumber4 + randomNumber5 - randomNumber5 + randomNumber6 - randomNumber6

	var result string
	if r.Method == "POST" {
		// 确保解析表单数据
		if err := r.ParseForm(); err != nil {
			http.Error(w, "Error parsing form", http.StatusBadRequest)
			return
		}

		numberStr := r.FormValue("number")

		// 输出生成的随机数
		fmt.Fprintln(w, "中奖号码为:", randomNumber7)
		fmt.Fprintln(w, "你的号码为:", numberStr)

		// 构造显示结果的字符串
		result = fmt.Sprintf("输入彩票号码")

		var rn string = strconv.Itoa(randomNumber7)

		if numberStr != rn {
			fmt.Fprintln(w, "你能不能行？")
		} else {
			fmt.Fprintln(w, "恭喜你中奖啦！奖励是再闯两关~ 下一关：/RAvvkto")
		}
	}

	fmt.Fprintf(w, `<!DOCTYPE html>
<html>
<head>
<style>
body {
   background-color: lightyellow; /* 这里设置背景颜色 */
}
</style>
</head>
<body>
   <!--<div>%s</div> -->
   <!-- 结果显示在这里 -->
   <form action="/r4Mkl" method="post">
       <label for="number">输入彩票号码:</label>
       <input id="number" name="number" required>
       <button type="submit">Submit</button>
   </form>
</body>
</html>`, result) // 将结果字符串作为参数传递给Fprintf
}

// 第二关
func tototo(w http.ResponseWriter, r *http.Request) {
	w.Header().Set("Content-Type", "text/html; charset=utf-8")

	var result string
	var salary int16 = -20000
	var tax int16 = 1
	var sum int16 = 0

	if r.Method == "POST" {
		// 确保解析表单数据
		if err := r.ParseForm(); err != nil {
			http.Error(w, "Error parsing form", http.StatusBadRequest)
			return
		}

		taxStr := r.FormValue("tax")
		tax64, err := strconv.ParseInt(taxStr, 10, 16)
		if err != nil {
			http.Error(w, "Parameter 'tax' must be an integer", http.StatusBadRequest)
			return
		}
		tax = int16(tax64)

		sum = salary - tax
		// 构造显示结果的字符串
		result = fmt.Sprintf("扣税：%d 当前工资：%d", tax, sum)
	}

	if tax <= 0 {
		fmt.Fprint(w, "必须要扣一点税的哦")
	} else if sum < 0 {
		fmt.Fprint(w, "资本家：你人还怪好的嘞")
	} else if sum < 20000 {
		fmt.Fprint(w, "GO开发工程师一年工资绝不低于20000")
	} else if sum > 20000 {
		fmt.Fprint(w, "资本家：太高了，我最多税后给你20k")
	} else {
		fmt.Fprint(w, "确实不低于20000吧~   最后一关：/r4nK1a3t")
	}

	fmt.Fprintf(w, `<!DOCTYPE html>
<html>
<head>
<style>
body {
   background-color: lightblue; /* 这里设置背景颜色 */
}
</style>
</head>
<body>
   <form action="/RAvvkto" method="post">
       <label for="tax">得扣点税:</label>
       <input type="number" id="tax" name="tax" required>
       <button type="submit">Submit</button>
   </form>
   <div>%s</div> <!-- 结果显示在这里 -->
</body>
</html>`, result) // 将结果字符串作为参数传递给Fprintf
}

// 第三关
func lastttt(w http.ResponseWriter, r *http.Request) {
	w.Header().Set("Content-Type", "text/html; charset=utf-8")

	fmt.Fprintf(w, `<!DOCTYPE html>
<html>
<head>
<style>
body {
   background-color: pink; /* 这里设置背景颜色 */
}
</style>
</head>
<body>
   <form action="/r4nK1a3t" method="post">
       <label for="filepath">开门见山，复现CVE-2019-14809直接给flag，来吧:</label>
       </br>
       <input id="filepath" name="filepath" required>
       </br>
       <button type="submit">Submit</button>
       </br>
       <label for="filepath">记得好好理解一下：https://blog.csdn.net/qq_33850304/article/details/106876454</label>
   </form>
   <!-- <div>%s</div> -->
   <!-- 结果显示在这里 -->
</body>
</html>`, "") // 将结果字符串作为参数传递给Fprintf

	if r.Method == "POST" {
		if err := r.ParseForm(); err != nil {
			http.Error(w, "Error parsing form", http.StatusBadRequest)
			return
		}

		filePath := r.FormValue("filepath")

		// 调用SanCheck函数
		err := SanCheck(filePath)
		if err == nil {
			// 输出FLAG
			fmt.Fprintln(w, os.Getenv("FLAG"))

		} else {
			// 如果有错误，打印错误信息
			fmt.Fprintln(w, err)
		}

	}
}

func SanCheck(input string) error {
	u, err := url.Parse(input)

	if err != nil {
		return err
	}

	if u.Scheme != "http" {
		return fmt.Errorf("err: Invalid Scheme [%s] ", u.Scheme)
	}

	if u.Opaque != "" {
		return fmt.Errorf("err: WHAT AER YOU DOING ?!!! (%s)", u.Opaque)
	}

	if u.Hostname() != "127.0.0.1" {
		return fmt.Errorf("err: Invalid Hostname [%s]", u.Hostname())
	}

	if u.Port() != "" && u.Port() != "9033" {
		return fmt.Errorf("err: Invalid Port [%s]", u.Port())
	}

	if u.User == nil {
		return fmt.Errorf("err: Authorization Required")
	}

	if u.User.Username() != "root" {
		return fmt.Errorf("err: Invalid Username [%s]", u.User.Username())
	}

	if password, set := u.User.Password(); !set || password != "P@ssw0rd!" {
		return fmt.Errorf("err: Invalid Password [%s]", password)
	}

	if u.Fragment != "" {
		return fmt.Errorf("err: Invalid Fragment [%s]", u.Fragment)
	}

	if !strings.Contains(u.String(), "'Pwned!'") {
		fmt.Println(u.String())
		return fmt.Errorf("err: San Check failed" + u.String())
	}

	return nil
}
