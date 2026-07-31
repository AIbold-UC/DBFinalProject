

-- If tables exist, delete them
DROP TABLE IF EXISTS `purchases`;
DROP TABLE IF EXISTS `products`;
DROP TABLE IF EXISTS `customers`;
DROP TABLE IF EXISTS `staff`;



-- Create customers table
CREATE TABLE customers (
    CID INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(50) NOT NULL,
    password VARCHAR(100) NOT NULL,
    creditcardNum VARCHAR(30)
);
-- creditcardnum is varchar so that it can be stored with dashes; in practice an actual E-commerce site might want it to be numbers only.

-- staff table
CREATE TABLE staff (
    SID INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(50) NOT NULL,
    password VARCHAR(100) NOT NULL
);

-- product table
CREATE TABLE products (
    PID INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(50) NOT NULL,
    type VARCHAR(100) NOT NULL,
    price DOUBLE NOT NULL,
    stock INT NOT NULL
);



-- Create purchases table

CREATE TABLE purchases (
    purchaseNum INT AUTO_INCREMENT PRIMARY KEY,
    quantityBought INT NOT NULL,
    totalPrice DOUBLE NOT NULL,
    purchaseDate TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    CID INT NOT NULL,
    FOREIGN KEY (CID) REFERENCES customers(CID)
        ON DELETE CASCADE,
    PID INT NOT NULL,
    FOREIGN KEY (PID) REFERENCES products(PID)
        ON DELETE CASCADE
);

-- Add test data
INSERT INTO customers (name, password, creditcardNum)
VALUES ('Aidan', MD5('password1'), '1234-5678-9101-1121');

INSERT INTO staff (name, password)
VALUES ('Admin', MD5('password2'));

INSERT INTO products (name, type, price, stock)
VALUES ('TShirt', 'apparel', 34.99, 20);
INSERT INTO products (name, type, price, stock)
VALUES ('Hat', 'apparel', 12.99, 12);
INSERT INTO products (name, type, price, stock)
VALUES ('Rolex watch', 'apparel',154.99,2);
INSERT INTO products (name, type, price, stock)
VALUES ('Soccer Ball', 'Sports',23.99,6);


INSERT INTO purchases ( quantityBought,totalPrice, CID,PID )
VALUES (3,104.97, 1,1);
INSERT INTO purchases ( quantityBought,totalPrice, CID,PID )
VALUES (10,129.90, 1,2);


