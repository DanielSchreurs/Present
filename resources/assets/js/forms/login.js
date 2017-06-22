jQuery( function ( $ ) {
    var toggled = false;
    $( "#oLinkPassword" ).click( function ( even ) {
        even.preventDefault();
        toggled = !toggled;
        $( "#password" ).attr( 'type', toggled ? "text" : "password" );
        $( "#oLinkPassword svg use" ).attr( 'xlink:href', toggled ? "#shape-iris" : "#shape-iris_close" );
    } );
} );