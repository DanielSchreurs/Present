$('.visitor-nav__header-link--open').click(function () {
    $(this).toggleClass('hide-close');
    $('.list-item-container').toggleClass('list-item-container--close');
});