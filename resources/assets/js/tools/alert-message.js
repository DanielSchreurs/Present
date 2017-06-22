jQuery( function ( $ ) {
    $( ".close" ).on( 'click', function () {
        $( this ).parent().remove()
    } );
} );