<?php

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