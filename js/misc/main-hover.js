$(document).ready(function() {
    
    $(".article").hover(function(){
    $(this).fadeTo("fast", 0.7);
    },function(){
        $(this).fadeTo("fast", 1.0);
    });

    $(".tren-item").hover(function(){
        $(this).fadeTo("fast", 0.7);
    },function(){
        $(this).fadeTo("fast", 1.0);
    });

    $(".main-articles a").hover(function(){
        $(this).fadeTo("fast", 0.7);
    },function(){
        $(this).fadeTo("fast", 1.0);
    });    
    
     $("a .clsfs-item ").hover(function(){
        $(this).fadeTo("fast", 0.7);
    },function(){
        $(this).fadeTo("fast", 1.0);
    }); 
    
    
});