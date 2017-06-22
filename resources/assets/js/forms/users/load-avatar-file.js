jQuery( function ( $ ) {
    var fReadURL = function ( input ) {
        if ( input.files && input.files[ 0 ] ) {
            var reader = new FileReader();

            reader.onload = function ( e ) {
                $(input).parent().find('.profile-avatar__placeholder img').attr( {
                    'src': e.target.result
                } );
            };
            reader.readAsDataURL( input.files[ 0 ] );
        }
    };
    $( ".avatar-loader-input" ).each(
        function ( index ) {
            $(this).change( function () {
                fReadURL( this );
                $(this).parent().find('.profile-avatar__placeholder img').removeClass("animate-avatar").delay(10).queue(function(){
                    $(this).addClass("animate-avatar").dequeue();
                });
                $(this).parent().find('.profile-avatar__placeholder').attr( "class", "profile-avatar__placeholder avatar--success" );
            } );
        }
    );
} );
