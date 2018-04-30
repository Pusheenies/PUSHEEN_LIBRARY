<?php
//Sample Admin connect user account statement
$new_user_admin = "CREATE USER 'admin'@'localhost' IDENTIFIED BY 'adminpassword';
                   GRANT ALL
                   ON pusheen_library.*
                   TO 'admin'@'localhost' WITH GRANT OPTION;
                   FLUSH PRIVILEGES;";

//Sample Staff connect account statement
$new_user_staff = "CREATE USER 'staff'@'localhost' IDENTIFIED BY 'staffpassword';
                   GRANT SELECT, INSERT, UPDATE, DELETE
                   ON pusheen_library.*
                   TO 'staff'@'localhost';
                   FLUSH PRIVILEGES;";

//Sample User connect user account statement
$new_user_general = "CREATE USER 'user'@'localhost' IDENTIFIED BY 'userpassword';
                     GRANT SELECT, INSERT, UPDATE
                     ON pusheen_library.*
                     TO 'user'@'localhost';
                     FLUSH PRIVILEGES;";

/* Query to add genres to the database */
$add_genre = "INSERT INTO genres
              (genre_name)
              VALUES
              ('Thriller');";

/* Query to add books to the database */
$add_book = "INSERT INTO books
             (isbn, title, image_url, genre_id, book_format, stock, book_condition, publication_year, book_location)
             VALUES
             ('439785960', 'Harry Potter and the Half-Blood Prince (Harry Potter, #6)', 'https://images.gr-assets.com/books/1361039191m/1.jpg', 29, 'Book', 2, 'Good', 2005, 'Section 2');";

/* Query to add authors to the database */
$add_author = "INSERT INTO authors
               (author_name)
               VALUES
               ('C. S. Lewis');";

/* Query to add the books and authors relationships */
$add_book_author = "INSERT INTO authors_books
                    (author_id, book_id)
                    VALUES
                    (1, 2);";

/* Sample query to update book information */
$update_book = "UPDATE books SET stock = 4 WHERE isbn = '439023483';";


/* Sample query to delete books from the database */
$delete_book = "DELETE FROM authors_books WHERE book_id = 4;
                DELETE FROM ratings WHERE book_id = 4;
                DELETE FROM borrows WHERE book_id = 4;
                DELETE FROM books WHERE book_id = 4;";

/* Sample query to add/remove the genre preferences for a user */
$add_user_genre = "INSERT INTO users_genres (user_id, genre_id) VALUES (1, 2);";

$delete_user_genre = "DELETE FROM users_genres WHERE user_id = 1 AND genre_id = 5;";

/* Query to see number of times a book is borrowed */
$select_borrow = "SELECT count(book_id) FROM borrows WHERE book_id = 5;";

/* Query to retrieve ratings of a specific book */
$select_rating = "SELECT * from ratings WHERE book_id = 5;";

/* Query to retrieve ratings from a specific user */
$select_ratings2 = "SELECT * from ratings WHERE user_id = 8;";

/* Query to see days remaining for a book to be returned */
$days_remaining = "SELECT TIMESTAMPDIFF(DAY, CURRENT_TIMESTAMP, return_date)
                   FROM borrows WHERE borrow_id = 1;";

/* Should we get rid of this query? I don’t think we should update existing ratings, only add new ones */
/* Sample query to update book rating to new rating */
$update_rating = "UPDATE ratings SET rating = 5 WHERE book_id = 5;";


/* Should we get rid of this query? I don’t think we should remove past borrows from the table */
/* Sample query to delete books from borrows list when returned on time */
$delete_borrow = "DELETE FROM borrows WHERE returned_in_time = 1;";

/* Sample query to borrow a book*/
$borrow_book = "UPDATE books SET stock = 4 WHERE isbn = '439023483';
                INSERT INTO borrows (book_id, user_id) VALUES (1, 6);";

/* Sample query for password recovery: creating a new password */
$update_password = "UPDATE users SET password = PASSWORD('NewExamplePassword') WHERE user_id = 1;";

/* Sample query to find a book by availability, or by rating, or by title, or by genre, or by author, or by ISBN, or by type (audio/paper) */

/* By availability */
$find_book_by_availability = "SELECT * FROM books WHERE availability > 0;";

/* By rating: i.e. only show books with a rating greater than 3 */
$find_book_by_rating = "SELECT b.isbn, b.title, a.author_name, b.stock, avg(rating) as average_rating
                        FROM books b
                        JOIN ratings r on r.book_id = b.book_id
                        JOIN authors_books ab on ab.book_id = b.book_id
                        JOIN authors a on a.author_id = ab.author_id
                        WHERE r.rating > 3
                        GROUP BY b.book_id;";

/* By title */
$find_book_by_title = "SELECT * FROM books WHERE title LIKE '%potter%';";

/* By genre */
$find_book_by_genre = "SELECT b.isbn, b.title, a.author_name, g.genre_name, b.stock
                       FROM books b
                       JOIN genres g on g.genre_id = b.genre_id
                       JOIN authors_books ab on ab.book_id = b.book_id
                       JOIN authors a on a.author_id = ab.author_id
                       WHERE g.genre_name = 'drama';";

/* By author */
$find_book_by_author = "SELECT b.isbn, b.title, a.author_name, b.stock
                        FROM books b
                        JOIN authors_books ab on ab.book_id = b.book_id
                        JOIN authors a on a.author_id = ab.author_id
                        WHERE a.author_name LIKE '%rowling%';";

/* By isbn */
$find_book_by_isbn = "SELECT b.isbn, b.title, a.author_name, b.stock
                      FROM books b
                      JOIN authors_books ab on ab.book_id = b.book_id
                      JOIN authors a on a.author_id = ab.author_id
                      WHERE b.isbn = '1416524797';";

/* By type (audio/book) */
$find_book_by_type = "SELECT b.isbn, b.title, a.author_name, b.book_format, b.stock
                      FROM books b
                      JOIN authors_books ab on ab.book_id = b.book_id
                      JOIN authors a on a.author_id = ab.author_id
                      WHERE b.book_format = 'audiobook';";


/* Query to retrieve new books added (past month) */
$books_added_last_month = "SELECT * FROM books
                           WHERE date_added > CURRENT_DATE - INTERVAL '1' MONTH;";

/*Query to add a new suggested book be bought*/
$add_book_suggestion = "SELECT b.user_id, u.username, ud.forename, ud.surname, b.book_name, b.book_author, b.request_date FROM book_requests b LEFT JOIN users u on u.user_id=b.user_id
                        LEFT JOIN user_details ud on ud.user_id = u.user_id WHERE b.bought ='0';";

/*Query to see book history (users/dates where books were borrowed)*/
$select_borrows = "SELECT user_id FROM borrows WHERE book_id = 5; - sees all people who borrowed this story";

$select_borrows2 = "SELECT borrow_date FROM borrows WHERE book_id = 5; - sees all dates this story was borrowed";

/*Query to see users that have overdue book borrows*/
$select_overdue_books = "SELECT user_id FROM borrows WHERE borrow_date < CURRENT_DATE - INTERVAL '3' MONTH;";

/* Sample query to grant privileges of adding books to database to staff */
$grant_pivileges_staff = "GRANT INSERT INTO books FROM users WHERE security_group = staff;";

/* Sample query to check username and password exist in the db*/
$check_login = "SELECT user_id FROM users WHERE username = 'username' AND password = PASSWORD('password');";

/* Sample query to check privileges before we run a query */
/* Not sure if we actually need to do this, cannot find people using this in any examples */
$show_privileges = "SHOW GRANTS FOR 'admin'@'localhost';";

?>
