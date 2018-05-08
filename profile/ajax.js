$("#add-book").submit(function (event) {
    event.preventDefault();
    let data = $("#add-book").serialize();
    $("#result").html("");
    
    $.post("addBook.php", data).done(function (response) {
        if (response) {
            $("#result").html("Book added!");
            $(".form-control").val("");
            $(":checkbox, :radio").prop("checked", false);
        } else {
            $("#result").html("Something went wrong. Please try again.");
        }
    });
});

