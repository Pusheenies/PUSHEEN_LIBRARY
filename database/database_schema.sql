/* 
 * Database schema for the Library Project
 * Run completely to create the database from scratch
 */

CREATE DATABASE Pusheen_Library;

-- If in command line, use the command below:
USE Pusheen_Library;

-- The tables are in this order so we don't get error messages due to the foreign keys referenced:
CREATE TABLE genres (
    genre_id INTEGER NOT NULL AUTO_INCREMENT,
    genre_name VARCHAR(30) NOT NULL UNIQUE,
    PRIMARY KEY(genre_id)
);

CREATE TABLE books (
    book_id INTEGER NOT NULL AUTO_INCREMENT,
    isbn VARCHAR(30) NOT NULL UNIQUE,
    title VARCHAR(60) NOT NULL,
    image_url VARCHAR(255) NULL,
    genre_id INTEGER NOT NULL,
    book_format VARCHAR(30) NOT NULL,
    stock INTEGER NULL,
    book_condition VARCHAR(30) NOT NULL,
    publication_year INTEGER NOT NULL,
    book_location VARCHAR(30) NOT NULL,
    date_added TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    PRIMARY KEY(book_id) ,
    FOREIGN KEY (genre_id) REFERENCES genres(genre_id)
);

CREATE TABLE authors (
    author_id INTEGER NOT NULL AUTO_INCREMENT,
    author_name VARCHAR(60) NOT NULL UNIQUE,
    PRIMARY KEY(author_id)
);

CREATE TABLE authors_books (
    author_id INTEGER NOT NULL,
    book_id INTEGER NOT NULL,
    FOREIGN KEY (author_id) REFERENCES authors(author_id),
    FOREIGN KEY (book_id) REFERENCES books(book_id)
);

CREATE TABLE security (
    security_group VARCHAR(20) NOT NULL,
    PRIMARY KEY(security_group)
);

CREATE TABLE users (
    user_id INTEGER NOT NULL AUTO_INCREMENT,
    username VARCHAR(20) NOT NULL UNIQUE,
    password VARCHAR(50) NOT NULL,
    security_group VARCHAR(20) NOT NULL,
    registration_date TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    PRIMARY KEY(user_id),
    FOREIGN KEY (security_group) REFERENCES security(security_group)
);

CREATE TABLE ratings (
    rating_id INT NOT NULL AUTO_INCREMENT,
    book_id INT NOT NULL,
    user_id INT NOT NULL,
    rating TINYINT NOT NULL,
    PRIMARY KEY(rating_id),
    FOREIGN KEY (book_id) REFERENCES books(book_id),
    FOREIGN KEY (user_id) REFERENCES users(user_id)
);

CREATE TABLE user_details (
    user_details_id INTEGER NOT NULL AUTO_INCREMENT,
    user_id INTEGER NOT NULL UNIQUE,
    forename VARCHAR(40) NULL,
    surname VARCHAR(40) NULL,
    address_line1 VARCHAR(60) NULL,
    address_line2 VARCHAR(60) NULL,
    address_line3 VARCHAR(60) NULL,
    city VARCHAR(60) NULL,
    postcode VARCHAR(30) NULL,
    phone VARCHAR(40) NULL,
    email VARCHAR(60) NULL,
    PRIMARY KEY(user_details_id),
    FOREIGN KEY (user_id) REFERENCES users(user_id)
);

CREATE TABLE users_genres (
    user_id INTEGER NOT NULL,
    genre_id INTEGER NOT NULL,
    FOREIGN KEY (user_id) REFERENCES users(user_id),
    FOREIGN KEY (genre_id) REFERENCES genres(genre_id)
);

CREATE TABLE user_preferences (
    preference_id INTEGER NOT NULL AUTO_INCREMENT,
    user_id INTEGER NOT NULL UNIQUE,
    email_contact CHAR(1) NOT NULL,
    email_date TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    phone_contact CHAR(1) NOT NULL,
    phone_date TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    PRIMARY KEY(preference_id),
    FOREIGN KEY (user_id) REFERENCES users(user_id)
);

CREATE TABLE book_requests (
    book_request_id INTEGER NOT NULL AUTO_INCREMENT,
    user_id INTEGER NOT NULL,
    book_name VARCHAR(60) NOT NULL,
    book_author VARCHAR(60) NOT NULL,
    request_date TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    bought BIT(1) NOT NULL DEFAULT 0,
    PRIMARY KEY(book_request_id),
    FOREIGN KEY (user_id) REFERENCES users(user_id)
);

CREATE TABLE borrows (
    borrow_id INTEGER NOT NULL AUTO_INCREMENT,
    book_id INTEGER NOT NULL,
    user_id INTEGER NOT NULL,
    borrow_date TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    return_date TIMESTAMP NULL,
    returned_in_time BIT(1) NOT NULL DEFAULT 0,
    returned_book BIT(1) NOT NULL DEFAULT 0,
    PRIMARY KEY(borrow_id),
    FOREIGN KEY (book_id) REFERENCES books(book_id),
    FOREIGN KEY (user_id) REFERENCES users(user_id)
);

/* Triggers */

CREATE TRIGGER return_date BEFORE INSERT ON borrows
FOR EACH ROW SET NEW.return_date = NOW() + INTERVAL 7 DAY;

CREATE TRIGGER hash_password BEFORE INSERT ON users
FOR EACH ROW SET NEW.password = PASSWORD(NEW.password);

/* Stored Procedures */

DELIMITER $$
CREATE PROCEDURE find_broken_books()
BEGIN
    SELECT title, isbn,book_condition, book_format, stock
    FROM books 
    WHERE book_format = 'Book' AND book_condition = 'Broken';
END $$
DELIMITER ;

DELIMITER $$
CREATE PROCEDURE find_book_stock()
BEGIN
    SELECT title, book_id, isbn,book_condition, book_format, stock
    FROM books
    ORDER BY stock ASC;
END $$
DELIMITER ;

DELIMITER $$
CREATE PROCEDURE add_request (user INTEGER, name VARCHAR(60), author VARCHAR(60))
BEGIN
  INSERT INTO book_requests
  (user_id, book_name, book_author)
  VALUES
  (user, name, author);
END $$
DELIMITER ;

DELIMITER $$
CREATE PROCEDURE add_book_and_author (isbn VARCHAR(30), title VARCHAR(60), author VARCHAR(60),
image_url VARCHAR(255), genre_id INTEGER, book_format VARCHAR(30), stock INTEGER,
book_condition VARCHAR(30), publication_year INTEGER, book_location VARCHAR(30))
BEGIN
  INSERT IGNORE INTO books
  (isbn, title, image_url, genre_id, book_format, stock, book_condition, publication_year, book_location)
  VALUES
  (isbn, title, image_url, genre_id, book_format, stock, book_condition, publication_year, book_location);

  INSERT IGNORE INTO authors
  (author_name)
  VALUES
  (author);

  SET @author_id = (SELECT author_id FROM authors WHERE author_name = author LIMIT 1);
  SET @book_id = (SELECT DISTINCT book_id FROM books WHERE `books`.`isbn` = isbn LIMIT 1);
  
  INSERT INTO authors_books
  (author_id, book_id)
  VALUES
  (@author_id, @book_id);
END $$
DELIMITER ;

DELIMITER $$
CREATE PROCEDURE add_user (
  IN USRNAME VARCHAR(20),
  IN PASS VARCHAR(50),
  IN SECGROUP VARCHAR(20),
  IN FNAME VARCHAR(40),
  IN SNAME VARCHAR(40),
  IN ADD1 VARCHAR(60),
  IN ADD2 VARCHAR(60),
  IN ADD3 VARCHAR(60),
  IN CITY VARCHAR(60),
  IN PCODE VARCHAR(30),
  PHONE VARCHAR(40),
  EMAIL VARCHAR(60),
  EPREFERENCE CHAR(1),
  PPREFERENCE CHAR(1)
)
BEGIN
    INSERT INTO users
    (username, password, security_group)
    VALUES
    (USRNAME, PASS, SECGROUP);
 
    INSERT INTO user_details
    (user_id, forename, surname ,address_line1, address_line2, address_line3, city, postcode, phone, email)
    VALUES
    ((SELECT user_id FROM users WHERE username=USRNAME ORDER BY user_id DESC limit 1),
    FNAME,SNAME,ADD1,ADD2,ADD3,CITY,PCODE,PHONE,EMAIL);
 
    INSERT INTO user_preferences
    (user_id, email_contact, phone_contact)
    VALUES
    ((SELECT user_id FROM users WHERE username = USRNAME ORDER BY user_id DESC limit 1),
    EPREFERENCE, PPREFERENCE);
END $$
DELIMITER ;

DELIMITER $$
CREATE DEFINER=`root`@`localhost` PROCEDURE `deleteBook`(IN `bookid` INT)
    NO SQL
BEGIN
DELETE FROM authors_books WHERE book_id = bookid;
DELETE FROM ratings WHERE book_id = bookid;
DELETE FROM borrows WHERE book_id = bookid;
DELETE FROM books WHERE book_id = bookid;
END$$
DELIMITER ;


DELIMITER $$
CREATE PROCEDURE return_book (borrow_id INTEGER)
BEGIN
  UPDATE borrows
  SET returned_book = 1
  WHERE `borrows`.`borrow_id` = borrow_id;
  
  UPDATE borrows
  SET returned_in_time = 1
  WHERE `borrows`.`borrow_id` = borrow_id
  AND return_date > CURRENT_TIMESTAMP;
END $$
DELIMITER ;