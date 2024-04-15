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
