(function () {
    "use strict";
    $( '.is_present :radio' ).change( function () {
        $( this ).closest( '.is_present' ).find('.profile-picture').toggleClass( 'profile-picture--absent' );
    } );
})();