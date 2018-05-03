<?php
session_start();
include "class_search.php";

$pdo= new PDO("mysql:host=localhost;dbname=Pusheen_library", "root", "");
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

//creating a new Search instance if one of the fields is not empty
if (!empty($_REQUEST["title"]) || !empty($_REQUEST["author"]) || !empty($_REQUEST["isbn"]) ||
    !empty($_REQUEST["genre"]) || !empty($_REQUEST["rating"]) || !empty($_REQUEST["book_format"])){
    $search= new Search($_REQUEST["title"], $_REQUEST["author"], $_REQUEST["isbn"],
                        $_REQUEST["genre"], $_REQUEST["rating"], $_REQUEST["book_format"]);
}

//searches based on 1 of the fields
if (!empty($_REQUEST["title"])){
    $search_results= $search->searchByTitle($pdo);
    $_SESSION["search_results"]= $search_results;
    header("Location: search_results.php");
    return;
}
if (!empty($_REQUEST["author"])){
    $search_results= $search->searchByAuthor($pdo);
    $_SESSION["search_results"]= $search_results;
    header("Location: search_results.php");
    return;
}
if (!empty($_REQUEST["isbn"])){
    $search_results= $search->searchByISBN($pdo);
    $_SESSION["search_results"]= $search_results;
    header("Location: search_results.php");
    return;
}
if (!empty($_REQUEST["genre"])){
    $search_results= $search->searchByGenre($pdo);
    $_SESSION["search_results"]= $search_results;
    header("Location: search_results.php");
    return;
}
if (!empty($_REQUEST["rating"])){
    $search_results= $search->searchByRating($pdo);
    $_SESSION["search_results"]= $search_results;
    header("Location: search_results.php");
    return;
}
if (!empty($_REQUEST["book_format"])){
    $search_results= $search->searchByFormat($pdo);
    $_SESSION["search_results"]= $search_results;
    header("Location: search_results.php");
    return;
}
?>


<html>
    <head>
        <title>Pusheen Library - Book search</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        
        <!-- Bootstrap CSS -->
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" integrity="sha384-WskhaSGFgHYWDcbwN70/dfYBj47jz9qbsMId/iRN3ewGhXQFZCSftd1LZCfmhktB" crossorigin="anonymous">
    </head>
    <body>
        <div class="container">
            <form action="" method="post" class="col-sm-6">
                <div class="form-group">
                    <label for="title">Title:</label>
                    <input type="text" name="title" id="title" class="form-control" placeholder="The Hobbit" autofocus/>
                </div>
                <div class="form-group">
                    <label for="author">Author:</label>
                    <input type="text" name="author" id="author" class="form-control" placeholder="J. R. R. Tolkien"/>
                </div>
                <div class="form-group">
                    <label for="isbn">ISBN:</label>
                    <input type="text" name="isbn" id="isbn" class="form-control" placeholder="618260307"/>
                </div>
                <div class="form-group">
                    <label>Genre:</label>
                    <select class="form-control" name="genre">
                        <option value="">Select a genre (optional)</option>
                        <option value="4">Action and Adventure</option>
                        <option value="21">Art</option>
                        <option value="28">Autobiographies</option>
                        <option value="27">Biographies</option>
                        <option value="12">Children's</option>
                        <option value="20">Comics</option>
                        <option value="22">Cookbooks</option>
                        <option value="23">Diaries</option>
                        <option value="19">Dictionaries</option>
                        <option value="2">Drama</option>
                        <option value="18">Encyclopedias</option>
                        <option value="29">Fantasy</option>
                        <option value="10">Guide</option>
                        <option value="9">Health</option>
                        <option value="15">History</option>
                        <option value="7">Horror</option>
                        <option value="24">Journals</option>
                        <option value="16">Math</option>
                        <option value="6">Mystery</option>
                        <option value="11">Novel</option>
                        <option value="17">Poetry</option>
                        <option value="25">Prayer books</option>
                        <option value="13">Religion</option>
                        <option value="5">Romance</option>
                        <option value="3">Satire</option>
                        <option value="14">Science</option>
                        <option value="1">Science fiction</option>
                        <option value="8">Self help</option>
                        <option value="26">Series</option>
                    </select>
                </div>
                <div class="form-group">
                    <label>Rating:</label>
                    <select class="form-control" name="rating">
                        <option value="">Select a rating (optional)</option>
                        <option value="5">5</option>
                        <option value="4">4</option>
                        <option value="3">3</option>
                        <option value="2">2</option>
                        <option value="1">1</option>
                    </select>
                </div>
                <div class="form-group">
                    <label>Format:</label><br>
                    <input type="radio" name="book_format" value="Book"> Book<br>
                    <input type="radio" name="book_format" value="Audiobook"> Audiobook<br>
                </div> 
                <input type="submit" value="Search" class="btn btn-primary"/>
            </form>
        </div>




        <!-- Bootstrap JS -->
        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js" integrity="sha384-smHYKdLADwkXOn1EmN1qk/HfnUcbVRZyYmZ4qpPea6sjB/pTJ0euyQp0Mk8ck+5T" crossorigin="anonymous"></script>
    </body>
</html>