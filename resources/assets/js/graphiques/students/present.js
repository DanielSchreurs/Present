var ePiechartSeances = $( ".bar-chart-student" );
if ( ePiechartSeances.length ) {
    ePiechartSeances.each(
        function () {
            var that = $( this );
            google.charts.setOnLoadCallback( chartLoader );
            function chartLoader() {
                var aDataTable      = [ [ 'Cours', 'Nombre de séances' ] ],
                    oDataAttributes = that.data();
                for ( key in oDataAttributes ) {
                    if ( oDataAttributes.hasOwnProperty( key ) ) {
                        var aCurentData                = oDataAttributes[ key ].split( "," );
                        aDataTable[ aCurentData[ 0 ] ] = [ aCurentData[ 1 ], parseInt( aCurentData[ 2 ] ) ];
                    }
                }
                var data    = google.visualization.arrayToDataTable( aDataTable );
                var options = {
                    'tooltip': { 'isHtml': true },
                    bars: 'horizontal' // Required for Material Bar Charts.
                };
                var chart   = new google.charts.Bar( that.get( 0 ) );
                chart.draw( data, options );
            }
        }
    );
}