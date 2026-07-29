-- this version was from an old project, makes it easier to remember formatting.

-- If tables exist, delete them
DROP TABLE IF EXISTS `posts`;
DROP TABLE IF EXISTS `users`;

-- Create users table
CREATE TABLE users (
    username VARCHAR(50) PRIMARY KEY,
    password VARCHAR(100) NOT NULL,
    name VARCHAR(100) NOT NULL,
    additionalemail VARCHAR(100),
    phonenumber VARCHAR(20)
);

-- Create posts table
CREATE TABLE posts (
    postID INT AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(100) NOT NULL,
    content TEXT NOT NULL,
    `date` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    owner VARCHAR(50) NOT NULL,
    FOREIGN KEY (owner) REFERENCES users(username)
        ON DELETE CASCADE
);

-- Add test data
INSERT INTO users (username, password, name)
VALUES ('waphteam12', MD5('team12'), 'Test User');

INSERT INTO posts (title, content, owner)
VALUES ('Test Post', 'This is a test message.', 'waphteam12');