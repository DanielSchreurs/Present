$('.nav-tabs a').click(function ( event ) {
    event.preventDefault();
    $('.one-tab-container--active').removeClass('one-tab-container--active');
    $('.nav-tabs__item--active').removeClass('nav-tabs__item--active');
    $(this).addClass('nav-tabs__item--active');
    $($(this).attr('href')).addClass('one-tab-container--active');
});