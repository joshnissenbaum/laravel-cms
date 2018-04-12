$( document ).ready(function() {
    $(".article").hover(function(){
    $(this).children(".article-info").fadeTo("fast", 0.7);
},function(){
    $(this).children(".article-info").fadeTo("fast", 0.0);
});
});


