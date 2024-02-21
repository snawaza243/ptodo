-- Active: 1694423108902@@127.0.0.1@3306@todophp
CREATE TABLE users (
    user_id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) UNIQUE NOT NULL,
    email VARCHAR(255) UNIQUE NOT NULL,
    password VARCHAR(255) NOT NULL
);

CREATE TABLE tasks (
    task_id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL,
    title VARCHAR(255) NOT NULL,
    description TEXT NULL,
    due_date DATE NULL,
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
    completed TINYINT(1) DEFAULT 0,
    priority VARCHAR(50) NOT NULL DEFAULT 'Medium'
    FOREIGN KEY (user_id) REFERENCES users(user_id) ON DELETE CASCADE
);



SELECT * from users;

SELECT * from tasks;


ALTER TABLE users
ADD COLUMN name VARCHAR(100),
ADD COLUMN phone VARCHAR(20),
ADD COLUMN image VARCHAR(255);
