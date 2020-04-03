create database portfolio;
drop database portfolio;
use portfolio;
create table user (id bigint auto_increment,username varchar(255),passowrd varchar(255),mobile int,email varchar(255), primary key(id));
CREATE DATABASE IF NOT EXISTS portfolio;
select * from users;
select * from experience;
drop table users;
CREATE TABLE IF NOT EXISTS Users (id INT AUTO_INCREMENT,primary key(id),username VARCHAR(255),password VARCHAR(512),mobile INT,email VARCHAR(255));

UPDATE users SET username='test',password='new_password' WHERE id='1';