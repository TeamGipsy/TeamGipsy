use mysql;
SET PASSWORD FOR 'root'@'localhost' = PASSWORD('test');
flush privileges;

CREATE DATABASE ctf;
use ctf;
create table users (id varchar(300),username varchar(300),password varchar(300));
INSERT INTO `users` VALUES (1, 'Jay17', 'jiangshiqi');
INSERT INTO `users` VALUES (2, 'admin', 'sahdjkhjasdjkh');
INSERT INTO `users` VALUES (3, 'jsj', '040811');
