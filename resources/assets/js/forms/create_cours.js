jQuery( function ( $ ) {
    var writteStudent = function ( aStudent ) {
        $( '.list-student' ).empty();
        aStudent.forEach( function ( student ) {
            var sFullname = student.first_name + ' ' + student.last_name;
            $( '.list-student' ).append( "<li>" + sFullname + "</li>" );
        } )
    };

    $( ".load-students-from-cour" ).on( "change", function () {
        $.ajax( {
            url: "http://localhost:8888/classe/" + this.value + "/students",

            success: function ( json, statut ) {
                if ( statut == "success" ) {
                    writteStudent( json );
                }
            }
        } );
    } )
} );