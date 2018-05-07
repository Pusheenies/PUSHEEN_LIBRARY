$(document).ready(function () {
    $.post("profile.php").done(function (response) {
        if (response) {
            let html = JSON.parse(response);
            let keys = Object.keys(html);
            
            for (let key of keys) {
                $("#" + key).html(html[key]);
            }
            
        } else {
            window.location = "../login/index.html";
        }
    });
});

