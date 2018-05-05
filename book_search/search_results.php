<?php
session_start();

//////REDIRECT if not logged in

//////get security details: user or staff
$security= "staff";

include "class_book.php";
$results= $_SESSION["search_results"];
//print_r($results);
$book_objects= [];

foreach($results as $book){
    $book_objects[]= new Book($book["book_id"], $book["isbn"], $book["title"], $book["image_url"],
                            $book["genre_id"], $book["book_format"], $book["stock"], $book["book_condition"],
                            $book["publication_year"], $book["book_location"], $book["date_added"],
                            $book["author_id"], $book["author_name"]);
}

?>

<html>
    <head>
    <title>Pusheen Library - Results</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        
        <!-- Bootstrap CSS -->
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" integrity="sha384-WskhaSGFgHYWDcbwN70/dfYBj47jz9qbsMId/iRN3ewGhXQFZCSftd1LZCfmhktB" crossorigin="anonymous">
        <link rel="stylesheet" href="search_results.css">
    </head>
    <body>
        <div class="container">
        <h1 class="text-center">Your results</h1>
        <div class="flex-container">
        <?php
            if (!empty($book_objects)){
                foreach($book_objects as $book){
                    echo "<div class='card'>";
                    echo "<div class='card-body'>";
                    echo "<img src=" . $book->getImage_url() . "><br>";
                    echo "<h5>" . $book->getTitle() . "</h5><br>";
                    echo "By " . $book->getAuthor_name() . " (" . $book->getPublication_year() . ")" . "<br>";
                    echo "<em>" . $book->getBook_format() . "</em><br>";
                    echo "</div>";
                    echo "<div class='card-footer'>";
                    if ($security=="staff"){
                        echo "<a href='edit.php?book_id=".$book->getBook_id()."' class='btn btn-warning' style='margin:5px 5px 5px 5px;'>Edit</a>";
                        echo "<a href='delete.php?book_id=".$book->getBook_id()."' class='btn btn-danger' style='margin:5px 5px 5px 5px;'>Delete</a>";
                    } else {
                        if($book->getStock()>=1){
                            echo "<a href='#' class='btn btn-info' style='margin:5px 5px 5px 5px;'>Borrow</a>";
                        }
                    }
                    echo "</div></div>";
                    
                }
            } else {
                echo "Sorry, no results match your search.";
            }
        ?>
        </div>
            <div class="text-center">
                <a href="book_search.php" class="btn btn-primary search-btn">Search again</a>
            </div>
        </div>
        

        <!-- Bootstrap JS -->
        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js" integrity="sha384-smHYKdLADwkXOn1EmN1qk/HfnUcbVRZyYmZ4qpPea6sjB/pTJ0euyQp0Mk8ck+5T" crossorigin="anonymous"></script>
    </body>
</html>