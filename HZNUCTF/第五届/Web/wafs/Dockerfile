FROM python:3.9

COPY app /app
WORKDIR /app

RUN pip install --upgrade pip -i https://pypi.tuna.tsinghua.edu.cn/simple && \
    pip install -r requirements.txt -i https://pypi.tuna.tsinghua.edu.cn/simple

CMD [ "python", "-u","app.py" ]
EXPOSE 8081