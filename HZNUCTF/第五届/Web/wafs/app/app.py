from flask import Flask, request, render_template
import re
from jinja2 import Template

app = Flask(__name__)

@app.route('/', methods=['GET', 'POST'])
def index():
    color = 'green'  # 默认为绿色
    message = "Welcome to HZNUCTF2024: HZNUer"
    if request.method == 'POST':
        payload = request.form.get('payload', '')

        if not re.findall(r"~|\+|%|\\x|\\u|\\[0-9]{3}|set|attr|chr|str\(\)|join|base64|format|:|\'\'|\"\"|\"|os|eval|popen|system|env|exec|shell_exec|passthru|proc_popen|globals|init|import|read|lower|dict|add|cycler|namespace|lipsum|split|safe|escape|urlencode|first|ehflself|mod|replace", payload):
            message = Template("Welcome to HZNUCTF2024: " + payload).render()
        else:
            message = Template("Hacker!!! 阿弥诺斯！！！").render()
            color = 'red'  # 若检测到可能的注入，改为红色

    # 使用color和message变量
    return render_template("index.html", color=color, message=message )

if __name__ == "__main__":
    app.run(host="0.0.0.0", port=8081)
