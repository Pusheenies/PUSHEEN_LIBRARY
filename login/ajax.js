$("#login").submit(function (event) {
    event.preventDefault();
    let data = $("#login").serialize();
    
    $.post("login.php", data).done(function (response) {
        if (response === "Login Successful") {
            // TODO: redirect to main page
        } else {
            $("#error-msg").html("Login unsuccessful. Please try again.");
        }
    });
});

