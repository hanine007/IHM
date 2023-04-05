function rangeSlide(value) {
    document.getElementById('rangeValue').innerHTML = value;
}

if (window.matchMedia("(max-width: 600px)").matches) {
    /* Changes when we reach the min-width  */
    $(".js-filter-form-3").addClass( "active" );
    $(".js-filter-form").removeClass( "active" )
} else {
    /* Reset for CSS changes – Still need a better way to do this! */
    $(".js-filter-form").addClass( "active" );
    $(".js-filter-form-3").removeClass( "active" )
}