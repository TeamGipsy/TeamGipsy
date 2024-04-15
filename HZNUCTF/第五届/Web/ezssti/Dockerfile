# FROM php:7.4-apache
FROM golang:1.18

COPY ./ezssti /ezssti
WORKDIR /ezssti
RUN go build .
CMD [ "./ezssti" ]
EXPOSE 8080