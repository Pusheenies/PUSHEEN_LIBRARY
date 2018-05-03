<?php
session_start();
$results= $_SESSION["search_results"];

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
        <h1>Your results:</h1>
        <div class="flex-container">
        <?php
            if (!empty($results)){
                foreach($results as $result){
                    echo "<div>";
                    echo "<img src=" . $result["image_url"] . "><br>";
                    echo "<b>" . $result["title"] . "</b><br>";
                    echo $result["author_name"];
                    echo "</div>";
                }
            } else {
                echo "Sorry, no results match your search.";
            }
        ?>
        </div>
        <a href="book_search.php" class="btn btn-primary">Search again</a>
        </div>
        

        <!-- Bootstrap JS -->
        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js" integrity="sha384-smHYKdLADwkXOn1EmN1qk/HfnUcbVRZyYmZ4qpPea6sjB/pTJ0euyQp0Mk8ck+5T" crossorigin="anonymous"></script>
    </body>
</html>