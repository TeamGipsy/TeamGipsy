FROM golang:1.11.12
ENV GOPROXY https://goproxy.cn,direct

COPY src /app
WORKDIR /app

CMD ["go","run","main.go"]