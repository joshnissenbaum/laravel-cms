
// Init select JS
$("#location").select2({
    ajax: {
        url: "/search/locations",
        dataType: 'json',
        delay: 250,
        data: function (params) {
            return {
                q: params.term, // search term
            };
        },
        processResults: function (data) {
            return {
                results: data
            };
        },
        cache: true
    },
    escapeMarkup: function (markup) {
        return markup;
    },
    minimumInputLength: 2,
    placeholder: function () {
        $(this).data('placeholder');
    },
    templateResult: locationResultTemplater,
    templateSelection: locationSelectionTemplater
});

function locationResultTemplater(location) {
    if (location.loading) return location.text;
    return location.suburb + " " + location.state + " " + location.postcode;
}

function locationSelectionTemplater(location) {
    if (typeof location.suburb !== "undefined") {
        return locationResultTemplater(location);
    }
    return location.text;
}