// jQuery( function ( $ ) {
//
//     $( "#student-list" ).change( function () {
//         handleFiles( this.files );
//     } );
//     var handleFiles = function ( files ) {
//         // Check for the various File API support.
//         if ( window.FileReader ) {
//             // FileReader are supported.
//             getAsText( files[ 0 ] );
//         } else {
//             alert( 'Votre navigateur n’est pas en mesure de supporter ça' );
//         }
//     };
//
//     function getAsText( fileToRead ) {
//         var reader = new FileReader();
//         // Handle errors load
//         reader.onload  = loadHandler;
//         reader.onerror = errorHandler;
//         // Read file into memory as UTF-8
//         reader.readAsText( fileToRead );
//     }
//
//     function loadHandler( event ) {
//         var csv = event.target.result;
//         processData( csv );
//     }
//
//     function processData( csv ) {
//         var allTextLines = csv.split( /\r\n|\n/ );
//         var lines        = [];
//         while ( allTextLines.length ) {
//             lines.push( allTextLines.shift().split( ',' ) );
//         }
//         drawOutput( lines );
//     }
//
//     function errorHandler( evt ) {
//         if ( evt.target.error.name == "NotReadableError" ) {
//             alert( "Canno't read file !" );
//         }
//     }
//
//     function drawOutput( lines ) {
//         //Clear previous data
//         var li     = $( "<li>", { class: "student-item student-item-succes layout__item u-4/12" } );
//         var parent = $( "#student-import-list" ),
//             allElement;
//         parent.empty();
//         for ( var i = 1; i < lines.length; i++ ) {
//             allElement = lines[ i ][ 0 ].split( ";" );
//             li         = $( "<li>", {
//                 text: allElement[ 1 ] +' '+ allElement[ 2 ],
//                 class: "student-item student-item-succes layout__item u-4/12"
//             } );
//             parent.append( li );
//         }
//     }
//
// } );