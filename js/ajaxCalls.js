$(document).ready(function() {
    $(".formRegister #sendButton").click(function() {
        var usernameValue = $("#us").val();
        var emailValue = $("#em").val();
        var passValue = $("#ps").val();

        $.ajax({
            url: "php/ajaxRegister.php",
            method: "POST",
            data: { username:usernameValue,email:emailValue,password:passValue},
            success: function(response) {
                console.log(response)
                if(response==1){
                    window.location.href = "/Reddit2/?page=login";
                }
                else{
                    alert("This email or username are already being used")
                }
            }
        });
                
    });

    $(".formLogin #sendButton").click(function() {
        var usernameValue = $("#us").val();
        var emailValue = $("#em").val();
        var passValue = $("#ps").val();

        $.ajax({
            url: "php/ajaxLogin.php",
            method: "POST",
            data: { username:usernameValue,email:emailValue,password:passValue},
            success: function(response) {
                console.log(response)
                if(response==1){
                    alert("Sikeres bejelentkezés");
                    window.location.href = "/Reddit2/";
                }
                else{
                    alert("Wrong email or username")
                }
            }
        });
                
    });
});

