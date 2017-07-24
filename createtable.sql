CREATE TABLE users(
uid int(11) primary key auto_increment,
name varchar(100) not null,
email varchar(100) not null,
password varchar(200) not null,
city varchar(20) not null,
phone int not null,
created_at timestamp default now(),
updated_at timestamp
);