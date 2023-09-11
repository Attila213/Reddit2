$(document).ready(function() {

    //számolja hogy hányadik képnél van és az alapján vált képet ha még tud
    $(".nextImage").click(function(){

        var images = $(this).parent().attr("images").split(" ")
        images.pop();
        parent = $(this).parent()
        count = parent.attr("count")

        if (parseInt(count)+1 <= images.length-1){
            count++;
        }
        parent.attr("count",count)

        console.log(count)


        img = parent.find("img")        
        img.attr("src",images[count])
    })

    $(".previousImage").click(function(){

        var images = $(this).parent().attr("images").split(" ")
        images.pop();
        parent = $(this).parent()
        count = parent.attr("count")

        if (parseInt(count)-1 >=0){
            count--;
        }
        parent.attr("count",count)

        console.log(count)


        img = parent.find("img")        
        img.attr("src",images[count])
    })
    
});


