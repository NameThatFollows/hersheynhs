var currentlyOpen = 0;

$(document).ready(function() {
    $('#about-button').click(function() {
        open('#about');
    });

    $('#news-button').click(function() {
        open('#news');
    });

    $('#login-button').click(function() {
        open('#login');
    });

    $('.home-button').click(function() {
        $('#about').removeClass('open');
        $('#news').removeClass('open');
        $('#login').removeClass('open');
        $('#buttons').addClass('open-buttons');
    });
});

function open(panel) {
    $('#about-button').removeClass('open');
    $('#news-button').removeClass('open');
    $('#login-button').removeClass('open');

    $(panel).addClass('open');
    $('#buttons').removeClass('open-buttons');
}