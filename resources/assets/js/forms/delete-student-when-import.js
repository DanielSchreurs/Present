jQuery( function ( $ ) {
    $( ".btn--delete-user-label" ).on( "click", function ( even ) {
        console.log($(this).parent().toggleClass('student-item-delete'));
    } );
} );