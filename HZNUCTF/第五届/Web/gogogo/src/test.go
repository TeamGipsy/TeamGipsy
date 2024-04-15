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
