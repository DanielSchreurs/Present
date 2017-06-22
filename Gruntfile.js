'use strict';

module.exports = function ( grunt ) {

    // Project configuration.
    grunt.initConfig( {
        svgstore: {
            options: {
                prefix: 'shape-' // This will prefix each <g> ID
            },
            default: {
                files: {
                    'public/svg/svg/svg-defs.svg': [ './resources/svg/*.svg' ]
                }
            }
        }
    } );

    // These plugins provide necessary tasks.
    grunt.loadNpmTasks( 'grunt-svgstore' );
    // Default task.
    grunt.registerTask( 'default', [ 'svgstore' ] );

};
