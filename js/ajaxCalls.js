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


    $(".chat-input").find("button").click(function () {
        var inputValue = $(this).siblings(".custom-input").val();
        var fID = $(this).siblings(".fid").attr("value");
        $.ajax({
            url: "php/sendMessage.php",
            method: "POST",
            data: { text:inputValue,fid:fID},
            success: function(response) {
                loadMessages();
            }
        });
    });

    function loadMessages() {
        var fID = $(".chat-input").find("button").siblings(".fid").attr("value");
        $.ajax({
            url: "php/getMessages.php",
            method: "POST",
            data: { fid:fID},
            success: function(response) 
            {
                $(".sentMessages").html(response);
            }
        });
    }

    setInterval(function() {
        loadMessages();
    }, 1000);

});

