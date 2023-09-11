$(document).ready(function() {
    $answer_to = null
    
    //a beírt adatokat beinzertálja az adatbázisba ha még nincs használva
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

    //lefuttat egy php-t ami eldönti hogy sikerült-e a bejelentkezés ezt válaszba el is küldi
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
                    window.location.href = "/Reddit2/";
                }
                else{
                    alert("Wrong email or username")
                }
            }
        });
                
    });

    // sendMessage.php-ban a beírt adatokat feldolgozva beinzerálja őket adatbázisb
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

    //minden lefutásál visszadok egy html tag-et ami tartalmazza a két ember közti beszélgetés tartalmát
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

    //minden lefutásál visszadok egy html tag-et ami tartalmazza az adott post kommentjeit
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

    //kattintásra pirosra változtatja a vote gombot és meghívja az oldalt ahol az adatbázisműveleteket végrehajtom a votePost.php-ban
    $(".vote").click(function() {
        var clickedButton = $(this);
        var postId = clickedButton.siblings(".postID").attr("value");
        var typeV = clickedButton.attr("typeV");
    
        $.ajax({
            url: "php/votePost.php",
            method: "POST",
            data: { postId: postId, voteType: typeV }, 
            success: function(response) {
                clickedButton.css("color", "red");
    
                $(".vote").not(clickedButton).css("color", "white");
            }
        });
    });

    //kattintásra meghívja az oldalt ahol az adatbázisműveleteket végrehajtom a addORremoveFriend.ph-ban (barát hozzáadaása)
    $(".addF").click(function(){
        $(this).fadeOut(300)
        let id = $(this).parent().attr("id");

        $.ajax({
            url: "php/addORremoveFriend.php",
            method: "POST",
            data: {id:id,type:"add"},

        });
        
    });
    
    //uyganazt hívja meg mint az addF csak más kódot adok át így másik résaz fut le (barát törlése)
    $(".removeF").click(function(){
        let id = $(this).parent().attr("id");

        let addF = $(this).parent().children(".addF")
        addF.fadeIn(300)

        $.ajax({
            url: "php/addORremoveFriend.php",
            method: "POST",
            data: {id:id,type:"remove"},
        });
        
    });
    
});

//elkülddi sendComment.php ra az adatokat ahol beinzertálja az adatokat az adatbázisba
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

