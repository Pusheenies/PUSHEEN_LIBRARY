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

    function searchByXParams($pdo){
        $search_results= [];
        $wheres= [];
        $params= [];
        if (!empty($this->title)){
            $wheres[]= "b.title LIKE CONCAT('%', :title, '%')";
            $params[":title"]= $this->title;
        }
        if (!empty($this->author)){
            $wheres[]= "a.author_name LIKE CONCAT('%', :author, '%')";
            $params[":author"]= $this->author;
        }
        if (!empty($this->isbn)){
            $wheres[]= "b.isbn = :isbn";
            $params[":isbn"]= $this->isbn;
        }
        if (!empty($this->genre)){
            $wheres[]= "genre_id = :genre";
            $params["genre"]= $this->genre;
        }
        if (!empty($this->book_format)){
            $wheres[]= "b.book_format = :book_format";
            $params["book_format"]= $this->book_format;
        }

        $sql= "SELECT *
                FROM books b
                JOIN authors_books ab ON ab.book_id = b.book_id
                JOIN authors a ON a.author_id = ab.author_id";
        if(!empty($wheres)){
            $sql.= " WHERE " . implode(" AND ", $wheres);
        }

        //////special case for selecting with the rating parameter
        if(!empty($this->rating)){
            $sql= "SELECT *, round(avg(r.rating)) as rounded_avg_rating
                    FROM books b
                    JOIN authors_books ab ON ab.book_id = b.book_id
                    JOIN authors a ON a.author_id = ab.author_id
                    JOIN ratings r ON r.book_id = b.book_id";
            if(!empty($wheres)){
                $sql.= " WHERE " . implode(" AND ", $wheres);
            }
            $params["rating"]= $this->rating;
            $sql.= " GROUP BY b.book_id
                    HAVING rounded_avg_rating = :rating";
        }
        //////end of special case

        $stmt= $pdo->prepare($sql);
        $stmt->execute($params);
        while ($row= $stmt->fetch(PDO::FETCH_ASSOC)){
            array_push($search_results, $row);
        }
        return $search_results;
    }
}

