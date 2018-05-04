$("#login").submit(function (event) {
    event.preventDefault();
    let data = $("#login").serialize();
    $("#error-msg").html("");
    
    $.post("login.php", data).done(function (response) {
        console.log(response);
        if (response === "Login Successful") {
            // TODO: redirect to main page
        } else {
            $("#error-msg").html("Login unsuccessful. Please try again.");
        }
    });
});

