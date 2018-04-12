$(document).ready(function () {
    $(".grid-item").hover(
        function () {
            $(this).find( ".grid-info" ).css( "display", "block" );        
        },
        function () {
            $(this).find( ".grid-info" ).css( "display", "none" );
        }
    );
});