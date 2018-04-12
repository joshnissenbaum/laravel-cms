$(document).ready(function() {

$('.typeahead').typeahead([
    {
        name: 'users'
        , remote: '/users/search/%QUERY'
        }
    ]);
    
});