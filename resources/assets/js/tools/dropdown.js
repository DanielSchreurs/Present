$('.main-header .dropdown-menu__item a').on('focus',function ( event ) {
   $menu=$('.dropdown-menu');
   if($menu.position().top!==40){
         $menu.css({ top: '40px' });
   }
});
$('.main-header .dropdown-menu__item:last-child a').focusout(function ( event ) {
   $('.dropdown-menu').css({ top: '-999999999px' });
});