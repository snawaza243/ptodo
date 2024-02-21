-- Active: 1694423108902@@127.0.0.1@3306@todophp
USE todophp;

show tables;

desc users;
DESC tasks;

SELECT * from users;

SELECT * from tasks ;


SELECT * from tasks WHERE user_id = 1;

SELECT password FROM users WHERE username = 'demo';
SELECT * FROM users WHERE username = 'demo';

SELECT * from users WHERE user_id = 1;