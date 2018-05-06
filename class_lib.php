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
class Book {
    private $book_id;
    private $date_added;
    private $title;
    private $isbn;
    private $authors;
    private $genre;
    private $image_url;
    private $book_format;
    private $stock;
    private $book_condition;
    private $publication_year;
    private $book_location;
    private $is_new_release;
    function __construct($book_id, $date_added, $title, $isbn, $authors, $genre, $image_url, $book_format,
            $stock, $book_condition, $publication_year, $book_location, $is_new_release) {
        $this->book_id = $book_id;
        $this->date_added = $date_added;
        $this->title = $title;
        $this->isbn = $isbn;
        $this->authors = $authors;
        $this->genre = $genre;
        $this->image_url = $image_url;
        $this->book_format = $book_format;
        $this->stock = $stock;
        $this->book_condition = $book_condition;
        $this->publication_year = $publication_year;
        $this->book_location = $book_location;
        $this->is_new_release = $is_new_release;
    }
    public function get_title() {
        return $this->title;
    }
    public function get_isbn() {
        return $this->isbn;
    }
    public function get_authors() {
        return $this->authors;
    }
    public function get_genre() {
        return $this->genre;
    }
    public function get_image_url() {
        return $this->image_url;
    }
    public function get_book_format() {
        return $this->book_format;
    }
    public function get_stock() {
        return $this->stock;
    }
    public function get_book_condition() {
        return $this->book_condition;
    }
    public function get_publication_year() {
        return $this->publication_year;
    }
    public function get_book_location() {
        return $this->book_location;
    }
    public function get_is_new_release() {
        return $this->is_new_release;
    }
    public function set_title($title) {
        $this->title = $title;
    }
    public function set_isbn($isbn) {
        $this->isbn = $isbn;
    }
    public function set_authors($authors) {
        $this->authors = $authors;
    }
    public function set_genre($genre) {
        $this->genre = $genre;
    }
    public function set_image_url($image_url) {
        $this->image_url = $image_url;
    }
    public function set_book_format($book_format) {
        $this->book_format = $book_format;
    }
    public function set_stock($stock) {
        $this->stock = $stock;
    }
    public function set_book_condition($book_condition) {
        $this->book_condition = $book_condition;
    }
    public function set_publication_year($publication_year) {
        $this->publication_year = $publication_year;
    }
    public function set_book_location($book_location) {
        $this->book_location = $book_location;
    }
    public function set_is_new_release($is_new_release) {
        $this->is_new_release = $is_new_release;
    }
    public function decrease_stock() {
        $this->stock -= 1;
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
class Book2 {
    var $book_id;
    var $ISBN;
    var $title;
    var $image_url;
    var $genre_id;
    var $book_format;
    var $stock;
    var $book_condition;
    var $publication_year;
    var $book_location;
    var $date_added;
    function __construct($book_id, $ISBN, $title, $image_url, $genre_id, $book_format, $stock, $book_condition, $publication_year, $book_location, $date_added) {
        $this->book_id = $book_id;
        $this->ISBN = $ISBN;
        $this->title = $title;
        $this->image_url = $image_url;
        $this->genre_id = $genre_id;
        $this->book_format = $book_format;
        $this->stock = $stock;
        $this->book_condition = $book_condition;
        $this->publication_year = $publication_year;
        $this->book_location = $book_location;
        $this->date_added = $date_added;
    }
    //getters
    function get_book_id() {
        return $this->book_id;
    }
    function get_ISBN() {
        return $this->ISBN;
    }
    function get_title() {
        return $this->title;
    }
    function get_image_url() {
        return $this->image_url;
    }
    function get_genre_id() {
        return $this->genre_id;
    }
    function get_book_format() {
        return $this->book_format;
    }
    function get_stock() {
        return $this->stock;
    }
    function get_book_condition() {
        return $this->book_condition;
    }
    function get_publication_year() {
        return $this->publication_year;
    }
    function get_book_location() {
        return $this->book_location;
    }
    function get_date_added() {
        return $this->date_added;
    }
    //setters
    function set_book_id($book_id) {
        $this->book_id = $book_id;
    }
    function set_ISBN($ISBN) {
        $this->ISBN = $ISBN;
    }
    function set_title($title) {
        $this->title = $title;
    }
    function set_image_url($image_url) {
        $this->image_url = $image_url;
    }
    function set_genre_id($genre_id) {
        $this->genre_id = $genre_id;
    }
    function set_book_format($book_format) {
        $this->book_format = $book_format;
    }
    function set_stock($stock) {
        $this->stock = $stock;
    }
    function set_book_condition($book_condition) {
        $this->book_condition = $book_condition;
    }
    function set_publication_year($publication_year) {
        $this->publication_year = $publication_year;
    }
    function set_book_location($book_location) {
        $this->book_location = $book_location;
    }
    //not sure we need this setter: would we change the date?
    //function set_date_added($date_added) {
        //$this->date_added = $date_added;
    //}
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