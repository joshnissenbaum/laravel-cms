$( document ).ready(function() {
    
    $(".fpost").bind('mouseenter',function(){
   $(this).children(".fpost-info").stop().css({
        opacity: 0.8
    });
}).bind('mouseleave',function(){
    $(this).children(".fpost-info").stop().css({
        opacity: 0
    });
        
    });
    

});


