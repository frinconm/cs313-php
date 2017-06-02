function scrollToTop(){
    document.body.scrollTop = document.documentElement.scrollTop = 0;
}

$(document).ready(function(){
    $('[data-toggle="popover"]').popover();
});

function popOverOnClick(){
    $('#login').popover('show');
}
