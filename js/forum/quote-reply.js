$(document).ready(function() {
    
  $(".quote-reply").click(function(e){
    e.preventDefault();
    var commentBody = $(this).closest('.forum-post-rep-wrapper').find('.forum-post-desc');
    var author = $(this).closest('.forum-post-rep-wrapper').find('.forum-post-name');
    $("#summernote").bbcode('[quote][b]Originally posted by ' + author.html() + '[/b][p]' + commentBody.html() + '[/quote]');
    $("html, body").animate({ scrollTop: $("#summernote").offset().top }, 500);  
  });  
});