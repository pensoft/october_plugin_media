$(document).ready(function() {
    $('select[name="filter_videos"]').select2({
        templateResult: formatCountry,
        templateSelection: formatCountry
    });
});

function formatCountry(country) {
    if (!country.id) {
        return country.text;
    }

    var countryCode = $(country.element).data('code').toLowerCase();
    var countryText = country.text;
    var $country = $(
        '<span class="flag-icon flag-icon-' + countryCode + '"></span>' +
        '<span class="country-text">' + countryText + '</span>'
    );

    return $country;
}