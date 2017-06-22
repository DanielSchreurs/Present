jQuery( function ( $ ) {
    $( '.link-for-input-action' ).click( function () {
        var infoName = $( this ).attr( 'data-date-begin' );
        if ( user[ 0 ][ infoName ] ) {
            $( this ).next().attr( 'value', user[ 0 ][ infoName ] );
        }
    } )
} );