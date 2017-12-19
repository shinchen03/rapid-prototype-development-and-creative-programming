create database petdb;

mysql> create table users (
    -> username varchar(50) not null,
    -> password varchar(255) not null,
    -> primary key (username)
    -> ) engine = INNODB DEFAULT character SET = utf8 COLLATE = utf8_general_ci;
Query OK, 0 rows affected (0.01 sec)

mysql> create table pets(
    -> id smallint unsigned not null auto_increment,
    -> username varchar(50) not null,
    -> species enum('cat','dog','chinchilla','snake','rabbit') not null,
    -> primary key(id, username),
    -> name varchar(50) not null,
    -> filename varchar(150) not null,
    -> weight decimal(4,2) not null,
    -> description tinytext,
    -> foreign key (username) references users (username)
    -> )engine = INNODB DEFAULT character SET = utf8 COLLATE = utf8_general_ci;
Query OK, 0 rows affected (0.03 sec)
