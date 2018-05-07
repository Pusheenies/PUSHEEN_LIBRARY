<?php

class User_Login {
    private $username;
    private $text_password;

    function __construct($username, $text_password) {
        $this->username = $username;
        $this->text_password = $text_password;
    }
    
    function login($pdo) {
        $sql = "SELECT user_id, security_group FROM users WHERE username = :username AND password = PASSWORD(:password);";
        $statement = $pdo->prepare($sql);
        $statement->execute([
            'username' => $this->username,
            'password' => $this->text_password
        ]);
        
        $result = $statement->fetch(PDO::FETCH_ASSOC);
        
        if ($result) {
            session_start();        
            $_SESSION["id"] = $result['user_id'];
            $_SESSION["security"] = $result['security_group'];

            echo "Login Successful";
        } else {
            echo "Login Unsuccessful";
        }
    }
}

class User_Profile {
    protected $id;
    private $username;
    private $forename;
    private $surname;
    private $security;
    private $genres;
    private $address_line1;
    private $address_line2;
    private $address_line3;
    private $city;
    private $postcode;
    private $phone;
    private $email;
    private $email_contact_pref;
    private $phone_contact_pref;

    function __construct($id, $security, $pdo) {
        $this->id = $id;
        $this->security = $security;
        
        $this->set_details($pdo);
    }

    private function set_details($pdo) {
        $sql = "SELECT u.username, ud.forename, ud.surname, 
                ud.address_line1, ud.address_line2, ud.address_line3, ud.city, ud.postcode, 
                ud.phone, ud.email, up.email_contact, up.phone_contact 
                FROM users u 
                LEFT JOIN user_details ud ON ud.user_id = u.user_id 
                LEFT JOIN user_preferences up ON up.user_id = u.user_id 
                WHERE u.user_id = :id 
                LIMIT 1;";
        $statement = $pdo->prepare($sql);
        $statement->execute([
            'id' => $this->id
        ]);
        
        $result = $statement->fetch(PDO::FETCH_ASSOC);
        
        foreach ($result as $key => $data) {
            $this->$key = $data;
        }
    }
    
    function get_title() {
        return 'Welcome back ' . $this->get_forename();
    }
    
    function get_id() {
        return $this->id;
    }

    function get_username() {
        return $this->username;
    }

    function get_forename() {
        return $this->forename;
    }

    function get_surname() {
        return $this->surname;
    }

    function get_security() {
        return $this->security;
    }

    function get_genres() {
        return $this->genres;
    }

    function get_address_line1() {
        return $this->address_line1;
    }

    function get_address_line2() {
        return $this->address_line2;
    }

    function get_address_line3() {
        return $this->address_line3;
    }

    function get_city() {
        return $this->city;
    }

    function get_postcode() {
        return $this->postcode;
    }

    function get_phone() {
        return $this->phone;
    }

    function get_email() {
        return $this->email;
    }

    function get_email_contact_pref() {
        return $this->email_contact_pref;
    }

    function get_phone_contact_pref() {
        return $this->phone_contact_pref;
    }
}

class General_User_Profile extends User_Profile {
    private $borrows;
    private $borrows_data;
    private $recent_books;
    
    function borrows($pdo) {
        $sql = "SELECT bo.borrow_id, b.title, a.author_name, b.image_url,
                bo.borrow_date, bo.return_date, bo.returned_in_time, bo.returned_book
                FROM borrows bo
                JOIN books b ON b.book_id = bo.book_id 
                JOIN authors_books ab ON ab.book_id = b.book_id 
                JOIN authors a ON a.author_id = ab.author_id 
                WHERE bo.user_id = :id
                ORDER BY bo.borrow_id;";
        $statement = $pdo->prepare($sql);
        $statement->execute([
            'id' => $this->id
        ]);
        
        while ($result = $statement->fetch(PDO::FETCH_ASSOC)) {
            $this->borrows_data[] = $result;
        }
        
        $this->set_borrows($pdo);
    }
    
    private function set_borrows($pdo) {
        $sql = "SELECT count(bo.borrow_id) borrows_count
                FROM borrows bo
                WHERE bo.user_id = :id
                GROUP BY bo.user_id;";
        $statement = $pdo->prepare($sql);
        $statement->execute([
            'id' => $this->id
        ]);
        
        $result = $statement->fetch(PDO::FETCH_ASSOC);
        
        $this->borrows = $result['borrows_count'] ?? 0;
    }
    
    function set_recent_books($pdo) {
        $sql = "SELECT b.title, a.author_name, b.image_url, g.genre_name, avg(r.rating) rating
                FROM books b
                JOIN authors_books ab ON ab.book_id = b.book_id 
                JOIN authors a ON a.author_id = ab.author_id
                JOIN genres g ON g.genre_id = b.genre_id
                LEFT JOIN ratings r ON r.book_id = b.book_id
                GROUP BY b.book_id
                ORDER BY b.date_added DESC
                LIMIT 5;";
        $statement = $pdo->prepare($sql);
        $statement->execute();
        
        while ($result = $statement->fetch(PDO::FETCH_ASSOC)) {
            $this->recent_books[] = $result;
        }
    }

    function get_personal_details_html() {
        return  '<li><span class=\'icon\'>&#x1F464;</span>' .
                    'Username: ' . $this->get_username() .
                '</li>' .
                '<li><span class=\'icon\'>&#x2709;</span>' .
                    'Email: ' . $this->get_email() .
                '</li>' .
                '<li><span class=\'icon\'>&#x1F511;</span>' .
                    'Password: *************' .
                '</li>' .
                '<li><span class=\'icon\'>&#x1F4D6;</span>' .
                    'Borrows: '. $this->get_borrows() .
                    '<a href=\'#\'> ...more</a>' .
                '</li>' . 
                '<a href=\'#\' class=\'button\'>Edit</a>';
    }
    
    function get_past_borrows_html() {
        $html = '<h2>Your Past Borrows</h2>' .
                 '<ul>';
        
        if (!$this->borrows_data) {
            $html .=  '<p>No borrows yet!</p>';
        } else {
            foreach ($this->borrows_data as $borrow) {
                $html .= '<ul>' .
                            '<li><img src=\'' . $borrow['image_url'] . '\'></li>' .
                         '</ul>';                  
            }
        }
        $html .= '</div>';
        
        return $html;
    }
    
    function get_recent_books_html() {
        $html = '<h2>Our latest books</h2>';
        
        foreach ($this->recent_books as $book) {
            $html .= '<div class=\'bookReview\'>' . 
                        '<img src=\'' . $book['image_url'] . '\'>' .
                        '<div class=\'right\'>' .
                            '<span class=\'rating\'>';
            
            for ($i = 0; $i < $book['rating']; $i++) {
                $html .= '&#x22C6;';
            }
            
            $html .=            '</span><br/>' .
                            '<span class=\'review\'>' .
                                '<strong>Title: </strong>' . $book['title'] . '<br/>' . 
                                '<strong>Author: </strong>' . $book['author_name'] . '<br/>' .
                                '<strong>Genre: </strong>' . $book['genre_name'] . '<br/>' .
                            '</span>' .
                        '</div>' .
                     '</div>';                  
        }
        // TODO: link to book search
        $html .= '<a href=\'#\' class=\'button\'>More Books</a>' . '</div>';
        
        return $html;
    }
    
    function get_borrows() {
        return $this->borrows;
    }
}

class Staff_User_Profile extends User_Profile {
    private $overdue_borrows;
    
    function overdue_borrows($pdo) {
        $sql = "SELECT distinct b.image_url
                FROM borrows bo
                JOIN books b ON b.book_id = bo.book_id 
                WHERE bo.return_date < CURRENT_TIMESTAMP AND bo.returned_book = 0;";
        $statement = $pdo->prepare($sql);
        $statement->execute();
        
        while ($result = $statement->fetch(PDO::FETCH_ASSOC)) {
            $this->overdue_borrows[] = $result;
        }
    }
    
    function get_personal_details_html() {
        return  '<li><span class=\'icon\'>&#x1F464;</span>' .
                    'Username: ' . $this->get_username() .
                '</li>' .
                '<li><span class=\'icon\'>&#x2709;</span>' .
                    'Email: ' . $this->get_email() .
                '</li>' .
                '<li><span class=\'icon\'>&#x1F511;</span>' .
                    'Password: *************' .
                '</li>' .
                '<a href=\'#\' class=\'button\'>Edit</a>';
    }
    
    function get_overdue_borrows_html() {
        $html = '<h2>Overdue Borrows</h2>' .
                 '<ul>';
        
        if (!$this->overdue_borrows) {
            $html .=  '<p>No overdue books</p>';
        } else {
            foreach ($this->overdue_borrows as $borrow) {
                $html .= '<ul>' .
                            '<li><img src=\'' . $borrow['image_url'] . '\'></li>' .
                         '</ul>';                  
            }
        }
        $html .= '</div>';
        
        return $html;
    }
}

class Book {
    private $book_id;
    private $isbn;
    private $title;
    private $image_url;
    private $genre_id;
    private $book_format;
    private $stock;
    private $book_condition;
    private $publication_year;
    private $book_location;
    private $date_added;
    private $author_id;
    private $author_name;
   
    function __construct($book_id, $isbn, $title, $image_url, $genre_id, $book_format, $stock, $book_condition, $publication_year, $book_location, $date_added, $author_id, $author_name) {
        $this->book_id = $book_id;
        $this->isbn = $isbn;
        $this->title = $title;
        $this->image_url = $image_url;
        $this->genre_id = $genre_id;
        $this->book_format = $book_format;
        $this->stock = $stock;
        $this->book_condition = $book_condition;
        $this->publication_year = $publication_year;
        $this->book_location = $book_location;
        $this->date_added = $date_added;
        $this->author_id = $author_id;
        $this->author_name = $author_name;
    }
    
    function add_book($pdo) {
        $sql = "CALL add_book_and_author(:isbn, :title, :author, :image_url, :genre_id, 
                :book_format, :stock, :book_condition, :publication_year, :book_location);";
        $statement = $pdo->prepare($sql);
        $result = $statement->execute([
            'isbn' => $this->isbn,
            'title' => $this->title,
            'author' => $this->author_name,
            'image_url' => $this->image_url,
            'genre_id' => $this->genre_id,
            'book_format' => $this->book_format,
            'stock' => $this->stock,
            'book_condition' => $this->book_condition,
            'publication_year' => $this->publication_year,
            'book_location' => $this->book_location
        ]);
        
        echo $result;
    }
    
    function getBook_id() {
        return $this->book_id;
    }
    function getIsbn() {
        return $this->isbn;
    }
    function getTitle() {
        return $this->title;
    }
    function getImage_url() {
        return $this->image_url;
    }
    function getGenre_id() {
        return $this->genre_id;
    }
    function getBook_format() {
        return $this->book_format;
    }
    function getStock() {
        return $this->stock;
    }
    function getBook_condition() {
        return $this->book_condition;
    }
    function getPublication_year() {
        return $this->publication_year;
    }
    function getBook_location() {
        return $this->book_location;
    }
    function getDate_added() {
        return $this->date_added;
    }
    function getAuthor_id() {
        return $this->author_id;
    }
    function getAuthor_name() {
        return $this->author_name;
    }
}

class User {
    private $user_id;
    private $username;
    private $password;
    private $security_group;
    private $registration_date;
    private $forename;
    private $surname;
    private $address1;
    private $address2;
    private $address3;
    private $city;
    private $postcode;
    private $phone;
    private $phone_contact_preference;
    private $phone_contact_date;
    private $email;
    private $email_contact_preference;
    private $email_contact_date;

    function __construct($user_id, $username, $password, $security_group, $registration_date,
            $forename, $surname, $address1, $address2, $address3, $city, $postcode,
            $phone, $phone_contact_preference, $phone_contact_date,
            $email, $email_contact_preference, $email_contact_date) {
        $this->user_id = $user_id;
        $this->username = $username;
        $this->password = $password;
        $this->security_group = $security_group;
        $this->registration_date = $registration_date;
        $this->forename = $forename;
        $this->surname = $surname;
        $this->address1 = $address1;
        $this->address2 = $address2;
        $this->address3 = $address3;
        $this->city = $city;
        $this->postcode = $postcode;
        $this->phone = $phone;
        $this->phone_contact_preference = $phone_contact_preference;
        $this->phone_contact_date = $phone_contact_date;
        $this->email = $email;
        $this->email_contact_preference = $email_contact_preference;
        $this->email_contact_date = $email_contact_date;
    }

    function get_user_id() {
        return $this->user_id;
    }

    function get_username() {
        return $this->username;
    }

    function get_password() {
        return $this->password;
    }

    function get_security_group() {
        return $this->security_group;
    }

    function get_registration_date() {
        return $this->registration_date;
    }

    function get_forename() {
        return $this->forename;
    }

    function get_surname() {
        return $this->surname;
    }

    function get_address1() {
        return $this->address1;
    }

    function get_address2() {
        return $this->address2;
    }

    function get_address3() {
        return $this->address3;
    }

    function get_city() {
        return $this->city;
    }

    function get_postcode() {
        return $this->postcode;
    }

    function get_phone() {
        return $this->phone;
    }

    function get_phone_contact_preference() {
        return $this->phone_contact_preference;
    }

    function get_phone_contact_date() {
        return $this->phone_contact_date;
    }

    function get_email() {
        return $this->email;
    }

    function get_email_contact_preference() {
        return $this->email_contact_preference;
    }

    function get_email_contact_date() {
        return $this->email_contact_date;
    }

    function set_user_id($user_id) {
        $this->user_id = $user_id;
    }

    function set_username($username) {
        $this->username = $username;
    }

    function set_password($password) {
        $this->password = $password;
    }

    function set_security_group($security_group) {
        $this->security_group = $security_group;
    }

    function set_registration_date($registration_date) {
        $this->registration_date = $registration_date;
    }

    function set_forename($forename) {
        $this->forename = $forename;
    }

    function set_surname($surname) {
        $this->surname = $surname;
    }

    function set_address1($address1) {
        $this->address1 = $address1;
    }

    function set_address2($address2) {
        $this->address2 = $address2;
    }

    function set_address3($address3) {
        $this->address3 = $address3;
    }

    function set_city($city) {
        $this->city = $city;
    }

    function set_postcode($postcode) {
        $this->postcode = $postcode;
    }

    function set_phone($phone) {
        $this->phone = $phone;
    }

    function set_phone_contact_preference($phone_contact_preference) {
        $this->phone_contact_preference = $phone_contact_preference;
    }

    function set_phone_contact_date($phone_contact_date) {
        $this->phone_contact_date = $phone_contact_date;
    }

    function set_email($email) {
        $this->email = $email;
    }

    function set_email_contact_preference($email_contact_preference) {
        $this->email_contact_preference = $email_contact_preference;
    }

    function set_email_contact_date($email_contact_date) {
        $this->email_contact_date = $email_contact_date;
    }
}

class Borrow {
    private $borrow_id;
    private $book_id;
    private $user_id;
    private $borrow_date;
    private $return_date;
    private $returned_in_time;
    private $returned_book;

    function __construct() {
        $get_arguments = func_get_args();
        $number_of_arguments = func_num_args();

        if (method_exists($this, $method_name = '__construct'.$number_of_arguments)) {
            call_user_func_array(array($this, $method_name), $get_arguments);
        }
    }

    function __construct2($book_id, $user_id) {
        $this->book_id = $book_id;
        $this->user_id = $user_id;
    }

    function __construct7($borrow_id, $book_id, $user_id, $borrow_date, $return_date, $returned_in_time, $returned_book) {
        $this->borrow_id = $borrow_id;
        $this->book_id = $book_id;
        $this->user_id = $user_id;
        $this->borrow_date = $borrow_date;
        $this->return_date = $return_date;
        $this->returned_in_time = $returned_in_time;
        $this->returned_book = $returned_book;
    }

    function get_borrow_id() {
        return $this->borrow_id;
    }

    function get_book_id() {
        return $this->book_id;
    }

    function get_user_id() {
        return $this->user_id;
    }

    function get_borrow_date() {
        return $this->borrow_date;
    }

    function get_return_date() {
        return $this->return_date;
    }

    function get_returned_in_time() {
        return $this->returned_in_time;
    }

    function get_returned_book() {
        return $this->returned_book;
    }

    function set_borrow_id($borrow_id) {
        $this->borrow_id = $borrow_id;
    }

    function set_book_id($book_id) {
        $this->book_id = $book_id;
    }

    function set_user_id($user_id) {
        $this->user_id = $user_id;
    }

    function set_borrow_date($borrow_date) {
        $this->borrow_date = $borrow_date;
    }

    function set_return_date($return_date) {
        $this->return_date = $return_date;
    }

    function set_returned_in_time($returned_in_time) {
        $this->returned_in_time = $returned_in_time;
    }

    function set_returned_book($returned_book) {
        $this->returned_book = $returned_book;
    }
}

class User2 {
    var $user_id;
    var $forename;
    var $surname;
    var $address_line1;
    var $address_line2;
    var $address_line3;
    var $city;
    var $postcode;
    var $phone;
    var $email;

    function __construct($user_id, $forename, $surname, $address_line1, $address_line2, $address_line3, $city, $postcode, $phone, $email) {
        $this->user_id = $user_id;
        $this->forename = $forename;
        $this->surname = $surname;
        $this->address_line1 = $address_line1;
        $this->address_line2 = $address_line2;
        $this->address_line3 = $address_line3;
        $this->city = $city;
        $this->postcode = $postcode;
        $this->phone = $phone;
        $this->email = $email;
    }

    //getters
    function getUser_id() {
        return $this->user_id;
    }
    function getForename() {
        return $this->forename;
    }
    function getSurname() {
        return $this->surname;
    }
    function getAddress_line1() {
        return $this->address_line1;
    }
    function getAddress_line2() {
        return $this->address_line2;
    }
    function getAddress_line3() {
        return $this->address_line3;
    }
    function getCity() {
        return $this->city;
    }
    function getPostcode() {
        return $this->postcode;
    }
    function getPhone() {
        return $this->phone;
    }
    function getEmail() {
        return $this->email;
    }

    //setters
    function setUser_id($user_id) {
        $this->user_id = $user_id;
    }
    function setForename($forename) {
        $this->forename = $forename;
    }
    function setSurname($surname) {
        $this->surname = $surname;
    }
    function setAddress_line1($address_line1) {
        $this->address_line1 = $address_line1;
    }
    function setAddress_line2($address_line2) {
        $this->address_line2 = $address_line2;
    }
    function setAddress_line3($address_line3) {
        $this->address_line3 = $address_line3;
    }
    function setCity($city) {
        $this->city = $city;
    }
    function setPostcode($postcode) {
        $this->postcode = $postcode;
    }
    function setPhone($phone) {
        $this->phone = $phone;
    }
    function setEmail($email) {
        $this->email = $email;
    }
}

class user3 {
    var $user_id;
    var $user_name;
    var $security_group;
    var $forename;
    var $surname;
    var $address_line1;
    var $address_line2;
    var $address_line3;
    var $city;
    var $postcode;
    var $phone;
    var $email;
    var $phone_contact;
    var $email_contact;

    function __construct($user_id, $user_name, $security_group, $forename, $surname,
    $address_line1, $address_line2, $address_line3, $city, $postcode,
    $phone, $email, $phone_contact, $email_contact) {
         $this->user_id = $user_id;
        $this->user_name = $user_name;
        $this->security_group = $security_group;
        $this->forename = $forename;
        $this->surname = $surname;
        $this->addressline1 = $address_line1;
        $this->addressline2 = $address_line2;
        $this->addressline3 = $address_line3;
        $this->city = $city;
        $this->postcode = $postcode;
        $this->phone = $phone;
        $this->email = $email;
        $this->phone_contact = $phone_contact;
        $this->email_contact = $email_contact;
    }

    function getUser_id() {
        return $this->user_id;
    }
    function setUser_id($user_id) {
        $this->user_id = $user_id;
    }
    function getUser_name() {
        return $this->user_name;
    }
    function setUser_name($user_name) {
        $this->user_name = $user_name;
    }
    function getSecurity_group() {
        return $this->security_group;
    }
    function setSecurity_group($security_group) {
        $this->security_group = $security_group;
    }
    function getForename() {
        return $this->forename;
    }
    function setForename($forename) {
        $this->forename = $forename;
    }
    function getSurname() {
        return $this->surname;
    }
    function setSurname($surname) {
        $this->surname = $surname;
    }
    function getAddress_line1() {
        return $this->address_line1;
    }
    function setAddress_line1($address_line1) {
        $this->address_line1 = $address_line1;
    }
    function getAddress_line2() {
        return $this->address_line2;
    }
    function setAddress_line2($address_line2) {
        $this->address_line2 = $address_line2;
    }
    function getAddress_line3() {
        return $this->address_line3;
    }
    function setAddress_line3($address_line3) {
        $this->address_line3 = $address_line3;
    }
    function getCity() {
        return $this->city;
    }
    function setCity($city) {
        $this->city = $city;
    }
    function getPostcode() {
        return $this->postcode;
    }
    function setPostcode($postcode) {
        $this->postcode = $postcode;
    }
    function getPhone() {
        return $this->phone;
    }
    function setPhone($phone) {
        $this->phone = $phone;
    }
    function getEmail() {
        return $this->email;
    }
    function setEmail($email) {
        $this->email = $email;
    }
    function getPhone_contact() {
        return $this->phone_contact;
    }
    function setPhone_contact ($phone_contact) {
        $this->phone_contact = $phone_contact;
    }

    function getEmail_contact() {
        return $this->email_contact;
    }
    function setEmail_contact ($email_contact) {
        $this->email_contact = $email_contact;
    }

}
/* 
 * I have commented the code below because it causes errors when including this file
 */

/*
//Created this connection to the db just for testing purposes
$hostname = "localhost";
$username = "user";
$password = "password";
$dbname = "pusheen_library";

//Created an array for the connection
$conn = new mysqli($hostname, $username, $password, $dbname);

// If statement to check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
/* Instantiating the class > Used LEFT JOIN because I want everything
 * from the user_details table using foreign key user_id to fetch required data
 * required username & password from the users table.  Used a LEFT JOIN to fetch
 * everything from the user_preferences table using foreign key user_id to fetch
 * required data phone_contact & email_contact*/
/*
$sql = "SELECT u.user_id, u.username, u.security_group, ud.forename, ud.surname, ud.address_line1,
ud.address_line2, ud.address_line3, ud.city, ud.postcode, ud.phone, ud.email, up.email_contact, up.phone_contact,
up.phone_date from users u LEFT JOIN user_details ud on ud.user_id=u.user_id LEFT JOIN user_preferences up
on up.user_id=u.user_id;";

$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
    $user = new user($row["user_id"], $row["username"], $row["security_group"],
    $row["forename"], $row["surname"], $row["address_line1"], $row["address_line2"],
    $row["address_line3"], $row["city"], $row["postcode"], $row["phone"], $row["email"],
    $row["phone_contact"], $row["email_contact"]);

    //Created objects
    echo "USERNAME: ".$user->getUser_name()."<br>"."<br>";
    echo "NAME: ".$user->getForename(). $user->getSurname()."<br>"."<br>";
    echo "ADDRESS: ".$user->getAddress_line1().$user->getAddress_line2().$user->getAddress_line3() ."<br>";
    echo $user->getCity()."<br>";
    echo $user->getPostcode()."<br>"."<br>";
    echo "PHONE: ".$user->getPhone()."<br>"."<br>";
    echo "EMAIL: ".$user->getEmail()."<br>";
    echo "CONTACT PREFERENCE: ". "Phone:" . $user->getPhone_contact(). "  or  " . "Email:" . $user->getEmail_contact()."<br>";

        }
} else {
    echo "0 results";
}
*/
?>
