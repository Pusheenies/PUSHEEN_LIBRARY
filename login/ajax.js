$("#login").submit(function (event) {
    event.preventDefault();
    let data = $("#login").serialize();
    $("#error-msg").html("");
    
    $.post("login.php", data).done(function (response) {
        if (response === "Login Successful") {
            // TODO: redirect to main page
            window.location.replace("../book_search/book_search.php");
        } else {
            $("#error-msg").html("Login unsuccessful. Please try again.");
        }
    });
});