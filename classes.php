<?php

class Search {
    public $title;
    public $author;
    public $isbn;
    public $genre;
    public $rating;
    public $book_format;
    
    function __construct($title, $author, $isbn, $genre, $rating, $book_format) {
        $this->title = $title;
        $this->author = $author;
        $this->isbn = $isbn;
        $this->genre = $genre;
        $this->rating = $rating;
        $this->book_format = $book_format;
    }

    function searchByTitle($pdo){
        $search_results= [];
        $sql= "SELECT * FROM books b
                JOIN authors_books ab ON ab.book_id = b.book_id
                JOIN authors a ON a.author_id = ab.author_id
                WHERE b.title LIKE CONCAT('%', :title, '%')";    // :title = placeholder
        $stmt= $pdo->prepare($sql);
        $stmt->execute(array(":title" => $this->title));
        while ($row= $stmt->fetch(PDO::FETCH_ASSOC)){
            array_push($search_results, $row);
        }
        return $search_results;
    }

    function searchByAuthor($pdo){
        $search_results= [];
        $sql= "SELECT * FROM books b
                JOIN authors_books ab ON ab.book_id = b.book_id
                JOIN authors a ON a.author_id = ab.author_id
                WHERE a.author_name LIKE CONCAT('%', :author, '%')";
        $stmt= $pdo->prepare($sql);
        $stmt->execute(array(":author" => $this->author));
        while ($row= $stmt->fetch(PDO::FETCH_ASSOC)){
            array_push($search_results, $row);
        }
        return $search_results;
    }

    function searchByISBN($pdo){
        $search_results= [];
        $sql= "SELECT * FROM books b
                JOIN authors_books ab ON ab.book_id = b.book_id
                JOIN authors a ON a.author_id = ab.author_id
                WHERE isbn = :isbn";
        $stmt= $pdo->prepare($sql);
        $stmt->execute(array(":isbn" => $this->isbn));
        array_push($search_results, $stmt->fetch(PDO::FETCH_ASSOC));  //no need for while loop since ISBN unique
        return $search_results;
    }

    function searchByGenre($pdo){
        $search_results= [];
        $sql= "SELECT * FROM books b
                JOIN authors_books ab ON ab.book_id = b.book_id
                JOIN authors a ON a.author_id = ab.author_id
                WHERE genre_id = :genre";
        $stmt= $pdo->prepare($sql);
        $stmt->execute(array(":genre" => $this->genre));
        while ($row= $stmt->fetch(PDO::FETCH_ASSOC)){
            array_push($search_results, $row);
        }
        return $search_results;
    }

    function searchByRating($pdo){
        $search_results= [];
        $sql= "SELECT *, round(avg(r.rating)) as rounded_avg_rating
                FROM books b
                JOIN authors_books ab ON ab.book_id = b.book_id
                JOIN authors a ON a.author_id = ab.author_id
                JOIN ratings r ON r.book_id = b.book_id
                GROUP BY b.book_id
                HAVING rounded_avg_rating = :rating";
        $stmt= $pdo->prepare($sql);
        $stmt->execute(array(":rating" => $this->rating));
        while ($row= $stmt->fetch(PDO::FETCH_ASSOC)){
            array_push($search_results, $row);
        }
        return $search_results;
    }

    function searchByFormat($pdo){
        $search_results= [];
        $sql= "SELECT * FROM books b
                JOIN authors_books ab ON ab.book_id = b.book_id
                JOIN authors a ON a.author_id = ab.author_id
                WHERE book_format= :book_format";  
        $stmt= $pdo->prepare($sql);
        $stmt->execute(array(":book_format" => $this->book_format));
        while ($row= $stmt->fetch(PDO::FETCH_ASSOC)){
            array_push($search_results, $row);
        }
        return $search_results;
    }


}

