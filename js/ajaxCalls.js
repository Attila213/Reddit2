$(document).ready(function() {
    $answer_to = null
    
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
            data: { fid:fID,type:"msg"},
            success: function(response) 
            {
                $(".sentMessages").html(response);
            }
        });
    }

    function loadComments() {
        postID = $(".vote").siblings(".postID").attr("value")

        $.ajax({
            url: "php/getMessages.php",
            method: "POST",
            data: {type:"cmt",postID:postID},
            success: function(response) 
            {
                $(".commentUpdate").html(response);
            }
        });
    }

    setInterval(function() {
        loadMessages();
        loadComments()
    }, 1000);

    $(".vote").click(function() {
        var clickedButton = $(this);
        var postId = clickedButton.siblings(".postID").attr("value");
        var typeV = clickedButton.attr("typeV");
    
        $.ajax({
            url: "php/votePost.php",
            method: "POST",
            data: { postId: postId, voteType: typeV }, 
            success: function(response) {
                // Állítsuk be a kattintott elem színét pirosra
                clickedButton.css("color", "red");
    
                // Állítsuk be a többi elem színét fehérre
                $(".vote").not(clickedButton).css("color", "white");
            }
        });
    });

    
});
function answerClick(id){
    alert(id)
}

function sendComment(ID) {
    post_id = ID
    text = $(".commentsContainer .inputContainer textarea").val()

    $(".commentsContainer .inputContainer textarea").val("")
    if(text !== ""){
        $.ajax({
            url: "php/sendComment.php",
            method: "POST",
            data: { content:text,postID:post_id},
            success: function(response) {
                console.log(response)
            }
        });
    }


}

