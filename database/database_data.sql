/* 
 * Database test data for the Library Project
 * Run completely to add all the data once you've created the database
 * Part of this sample data was obtained from https://github.com/zygmuntz/goodbooks-10k
 */

INSERT INTO genres
(genre_name)
VALUES
("Science fiction"),
("Drama"),
("Satire"),
("Action and Adventure"),
("Romance"),
("Mystery"),
("Horror"),
("Self help"),
("Health"),
("Guide"),
("Novel"),
("Children's"),
("Religion"),
("Science"),
("History"),
("Math"),
("Poetry"),
("Encyclopedias"),
("Dictionaries"),
("Comics"),
("Art"),
("Cookbooks"),
("Diaries"),
("Journals"),
("Prayer books"),
("Series"),
("Biographies"),
("Autobiographies"),
("Fantasy");

INSERT INTO books
(isbn, title, image_url, genre_id, book_format, stock, book_condition, publication_year, book_location)
VALUES
("439023483", "The Hunger Games (The Hunger Games, #1)", "https://images.gr-assets.com/books/1447303603m/2767052.jpg", 4, "Book", 3, "Good", 2008, "Section 2"),
("439554934", "Harry Potter and the Sorcerer's Stone (Harry Potter, #1)", "https://images.gr-assets.com/books/1474154022m/3.jpg", 29, "Book", 2, "Good", 1997, "Section 1"),
("316015849", "Twilight (Twilight, #1)", "https://images.gr-assets.com/books/1361039443m/41865.jpg", 5, "Book", 4, "New", 2005, "Section 4"),
("61120081", "To Kill a Mockingbird", "https://images.gr-assets.com/books/1361975680m/2657.jpg", 11, "Book", 7, "Broken", 1960, "Section 3"),
("743273567", "The Great Gatsby", "https://images.gr-assets.com/books/1490528560m/4671.jpg", 11, "Book", 2, "Good", 1925, "Section 3"),
("525478817", "The Fault in Our Stars", "https://images.gr-assets.com/books/1360206420m/11870085.jpg", 2, "Audiobook", 4, "New", 2012, "Section 2"),
("618260307", "The Hobbit", "https://images.gr-assets.com/books/1372847500m/5907.jpg", 29, "Book", 2, "Good", 1937, "Section 1"),
("316769177", "The Catcher in the Rye", "https://images.gr-assets.com/books/1398034300m/5107.jpg", 2, "Audiobook", 2, "Good", 1951, "Section 3"),
("1416524797", "Angels & Demons (Robert Langdon, #1)", "https://images.gr-assets.com/books/1303390735m/960.jpg", 4, "Audiobook", 1, "Good", 2000, "Section 4"),
("679783261", "Pride and Prejudice", "https://images.gr-assets.com/books/1320399351m/1885.jpg", 2, "Book", 6, "Broken", 1813, "Section 3");

INSERT INTO security
(security_group)
VALUES
("admin"),
("staff"),
("user");

INSERT INTO users
(username, password, security_group)
VALUES
("Alan", "test", "admin"),
("Maria", "test2", "admin"),
("John", "test3", "staff"),
("Jenna", "test4", "staff"),
("Cath", "test5", "staff"),
("Enid", "test6", "user"),
("Anna", "test7", "user"),
("Jonas", "test8", "user"),
("Ros", "test9", "user"),
("Rossie", "test10", "user"),
("Lenna", "test11", "user"),
("Stan", "test12", "user"),
("Lee", "test13", "user"),
("Pam", "test14", "user");

INSERT INTO authors
(author_name)
VALUES
("Suzanne Collins"),
("J.K. Rowling"),
("Stephenie Meyer"),
("Harper Lee"),
("F. Scott Fitzgerald"),
("John Green"),
("J.R.R. Tolkien"),
("J.D. Salinger"),
("Dan Brown"),
("Jane Austen");

INSERT INTO authors_books
(author_id, book_id)
VALUES
(1, 1),
(2, 2),
(3, 3),
(4, 4),
(5, 5),
(6, 6),
(7, 7),
(8, 8),
(9, 9),
(10, 10);

INSERT INTO user_details
(user_id, forename, surname, address_line1, address_line2, address_line3, city, postcode, phone, email)
VALUES
(1, "Alan", "White", "41 Helland Bridge", "", "", "ULWELL", "BH19 9WU", "07912 443783", "alan.white@mailinator.com"),
(2, "Maria", "Grey", "21 Witney Court", "Witney Way", "Knits", "KNITSLEY", "DH8 2QD", "", "maria.grey@mailinator.com"),
(3, "John", "Black", "97 Jedburgh Road", "Morden", "", "LETTERMORAR", "PH40 1SZ", "07928 415328", "john.black@mailinator.com"),
(4, "Jenna", "Green", "3 Horsefair Green", "", "", "ONGAR", "HR6 4SX", "07931 337381", "jenna.green@mailinator.com"),
(5, "Catherine", "Rose", "15 Whitby Road", "", "", "DENNYLOANHEAD", "FK4 0RU", "", "catherine.rose@mailinator.com"),
(6, "Enid", "Brown", "89 Annfield Rd", "", "", "BEACON END", "CO3 0UB", "07840 073562", ""),
(7, "Anna", "Reed", "37 Stroude Court", "Ongar Road", "", "SKEEBY", "SK1 3EU", "", "anna.reed@mailinator.com"),
(8, "Jonas", "Robin", "31 Ilchester Road", "", "", "MYDDLEWOOD", "SY4 9UU", "07969 792239", "jonas.robin@mailinator.com"),
(9, "Rossalyn", "Archer", "83 Maidstone Road", "", "", "WEST BAGBOROUGH", "TA4 6WJ", "", ""),
(10, "Rossalyn", "Smith", "93 Caradon Hill", "Caradon Road", "", "TYN-Y-FFRIDD", "SY10 5HD", "", "rossalyn.smith@mailinator.com"),
(11, "Lenna", "Potter", "18 Cheriton Rd", "", "", "WEST RAINTON", "DH4 2EF", "07819 099405", "lenna.potter@mailinator.com"),
(12, "Stanley", "Tailor", "15 St Maurices Court", "Maurice Road", "Preston", "PRESTON ON STOUR", "CV37 3LD", "", ""),
(13, "Lee", "Barber", "42 Dunmow Road", "", "", "GRISTON", "IP25 7DF", "07971 347933", ""),
(14, "Pamela", "Clark", "53 Dune Road", "", "", "GRIBTHORPE", "DN14 8SX", "07949 312930", "pamela.clark@mailinator.com");

INSERT INTO user_preferences
(user_id, email_contact, phone_contact)
VALUES
(1, "Y", "Y"),
(2, "Y", "Y"),
(3, "Y", "Y"),
(4, "Y", "N"),
(5, "N", "N"),
(6, "Y", "Y"),
(7, "Y", "Y"),
(8, "Y", "N"),
(9, "Y", "Y"),
(10, "N", "Y"),
(11, "Y", "Y"),
(12, "N", "N"),
(13, "N", "Y"),
(14, "Y", "Y");

INSERT INTO users_genres
(user_id, genre_id)
VALUES
(1, 2),
(1, 3),
(1, 29),
(3, 10),
(4, 11),
(4, 2),
(4, 3),
(5, 7),
(6, 8),
(7, 2),
(8, 3),
(8, 5),
(9, 9),
(9, 10),
(9, 29),
(9, 27),
(10, 5),
(11, 3),
(12, 27),
(12, 4),
(13, 22),
(13, 1),
(14, 11);

INSERT INTO ratings
(book_id, user_id, rating)
VALUES
(1, 1, 5),
(1, 3, 3),
(1, 13, 4),
(2, 1, 5),
(2, 6, 5),
(1, 5, 5),
(1, 4, 4),
(1, 7, 4),
(4, 9, 2),
(4, 5, 1),
(3, 9, 1),
(2, 9, 4),
(5, 6, 3),
(4, 5, 4),
(6, 5, 3),
(7, 5, 3),
(8, 3, 3),
(6, 4, 5),
(6, 6, 5),
(6, 8, 4),
(7, 8, 3),
(9, 5, 2),
(10, 5, 2),
(2, 12, 5),
(3, 1, 3),
(3, 12, 2),
(3, 3, 1),
(4, 4, 3),
(7, 5, 4),
(7, 5, 5),
(7, 6, 4),
(6, 6, 5),
(7, 7, 2),
(5, 8, 3),
(5, 10, 3),
(3, 11, 2),
(4, 10, 4),
(4, 1, 4),
(4, 3, 5),
(5, 5, 3),
(6, 5, 4),
(6, 1, 2),
(2, 4, 3),
(1, 7, 2),
(1, 8, 5),
(3, 6, 2),
(4, 6, 3),
(7, 3, 4),
(7, 1, 3);

INSERT INTO book_requests
(user_id, book_name, book_author, bought)
VALUES
(4, "The Catcher in the Rye", "J.D. Salinger", 1),
(4, "Angels & Demons (Robert Langdon, #1)", "Dan Brown", 1),
(10, "Les Misérables", "Victor Hugo", 0),
(12, "Pride and Prejudice", "Jane Austen", 1),
(7, "It", "Stephen King", 0);

INSERT INTO borrows
(book_id, user_id)
VALUES
(1, 1),
(2, 3),
(4, 1),
(5, 8),
(2, 3),
(2, 14),
(4, 1),
(2, 3),
(5, 8),
(1, 4),
(1, 9),
(4, 6),
(5, 3),
(7, 4),
(2, 3),
(7, 3),
(8, 4),
(1, 1),
(9, 1),
(10, 3);
