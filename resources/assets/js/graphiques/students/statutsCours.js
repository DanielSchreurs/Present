var ePiechartSeances = $( ".bar-chart-statuts-cours" );
if ( ePiechartSeances.length ) {
    ePiechartSeances.each(
        function () {
            var that = $( this );
            google.charts.setOnLoadCallback( chartLoader );
            function chartLoader() {
                var aDataTable                                                             = [ [ 'Présences/Cours' ]
                        // ['JSKLJSL',10,30,50],
                        // ['JSKLJSL',10,30,50],
                        // ['JSKLJSL',10,30,50]
                    ],
                    oDataAttributes = that.data( 'graph' ), i, sName = '', ii = 0, aColors = [];
                for ( key in oDataAttributes ) {
                    if ( oDataAttributes.hasOwnProperty( key ) ) {
                        ii++;
                        if ( key !== 'meta' ) {
                            //console.log(key);
                            // on va ['nom du cour',valeur1,valeur2];
                            sName = oDataAttributes[ key ].name;
                            aDataTable.push( [ sName ] );

                            // faire un boucle dans les statit pour récupérer l id;
                            for ( statut in oDataAttributes[ 'meta' ] ) {
                                if ( statut !== 'max-statut' ) {
                                    for ( i = 0; i < oDataAttributes[ 'meta' ][ statut ].length; i++ ) {
                                        //console.log( oDataAttributes[ 'meta'][ statut ][ i ].id );
                                        aDataTable[ ii ].push( typeof oDataAttributes[ key ].statuts[ oDataAttributes[ 'meta' ][ statut ][ i ].id ] === "undefined" ? 0 : oDataAttributes[ key ].statuts[ oDataAttributes[ 'meta' ][ statut ][ i ].id ].nbr );
                                    }
                                }
                            }

                        }
                        else {
                            for ( statut in oDataAttributes[ key ] ) {
                                if ( statut !== 'max-statut' ) {
                                    for ( i = 0; i < oDataAttributes[ key ][ statut ].length; i++ ) {
                                        aDataTable[ 0 ].push( oDataAttributes[ key ][ statut ][ i ].name );
                                        aColors.push( oDataAttributes[ key ][ statut ][ i ].color );
                                    }
                                }
                            }
                        }
                    }
                }
                var data    = google.visualization.arrayToDataTable( aDataTable );
                var options = {
                    'tooltip': { 'isHtml': true },
                    bars: 'horizontal', // Required for Material Bar Charts.
                    colors: aColors
                };
                var chart   = new google.charts.Bar( that.get( 0 ) );
                chart.draw( data, options );
            }
        }
    );
}
