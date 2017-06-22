// - - - - - - - - - - - - - - - - - - - - - - - - -

jQuery.fn.clickoutside = function ( callback ) {
    var outside = 1, self = $( this );
    self.cb     = callback;
    this.click( function () {
        outside = 0;
    } );
    $( document ).click( function () {
        outside && self.cb();
        outside = 1;
    } );
    return $( this );
};

// - - - - - - - - - - - - - - - - - - - - - - - - -

var fmask = {

    'select': {

        'scroll': {

            'status': true,
            'mod': { 'small': 90, 'medium': 120, 'large': 170 }
        }
    },

    'total': $( '.mask' ).length,
    'count': 1
};

$( '.mask' ).each( function ( index ) {

    e = this;

    // @ mask element : select

    if ( $( e ).attr( 'data-type' ) == 'select' ) {

        option = '';

        i = 0;
        $( e ).children( 'option' ).each( function ( index ) {

            selected = $( this ).attr( 'selected' ) ? 'data-selected="on"' : '';

            info         = 'data-info-select="' + $( this ).attr( 'data-info-select' ) + '"';
            name         = 'data-info-name="' + $( this ).attr( 'data-info-name' ) + '"';
            color        = 'data-info-color="' + $( this ).attr( 'data-info-color' ) + '"';
            dataSelector = 'data-info-selector="' + $( this ).attr( 'data-info-selector' ) + '"';
            label        = (i == 0) ? $( this ).html() : label;

            label = selected != '' ? $( this ).html() : label;
            colorBcg=$( this ).attr( 'value' ).charAt(0)=="#"?$( this ).attr( 'value' ):''; 
            option = option + '<li ' + selected + info + name + color + dataSelector + ' data-value="' + $( this ).attr( 'value' ) + '">'+'<span style=\"background:'+$( this ).attr( 'value' )+';\"></span>'+ $( this ).html() + '</li>';
            i++;

        } );

        // @ data width

        width = '';

        if ( $( e ).attr( 'data-width' ) ) {
            width = Number( $( e ).attr( 'data-width' ) ) ? $( e ).attr( 'data-width' ) : false;
            width = (width) ? 'style="width:' + width + 'px"' : 'data-width="' + $( e ).attr( 'data-width' ) + '"';
        }

        // @ data scroll

        scroll = '';

        fmask.select.scroll.status = $( e ).attr( 'data-scroll' ) == 'false' ? false : true;

        scroll = $( e ).attr( 'data-scroll' ) ? 'data-scroll="' + $( e ).attr( 'data-scroll' ) + '"' : '';

        if ( fmask.select.scroll.status ) {

            j = $( e ).attr( 'data-scroll' ) ? $( e ).attr( 'data-scroll' ) : fmask.select.scroll.mod.medium;

            if ( !Number( j ) ) {
                switch ( j ) {
                    case 'medium'  :
                        j = fmask.select.scroll.mod.medium;
                        break;
                    case 'small'   :
                        j = fmask.select.scroll.mod.small;
                        break;
                    case 'large'   :
                        j = fmask.select.scroll.mod.large;
                        break;
                }
            }

        }

        // @ select dom html

        data = '<div class="fmask select" id="select-' + $( e ).attr( 'id' ) + '" ' + width + ' ' + scroll + '>'
            + '<div class="h">'
            + '<i></i>'
            + '<i data-icon="arrow"></i>'
            + '<label>' + label + '</label>'
            + '</div>'
            + '<div class="b"><div class="s"><ol>' + option + '</ol></div></div>'
            + '</div>';

        $( e ).addClass( 'hidden' ).after( data );

        // @ scroll status

        if ( fmask.select.scroll.status ) {
            $( '#select-' + $( e ).attr( 'id' ) + ' .s' ).slimScroll( { height: j + 'px' } );
        }

    }

    // @ dongu sonrası tetikle

    if ( fmask.total == fmask.count ) {
        formmask();
    }

    fmask.count++;

} );

// form mask after function

function formmask() {

    $( '.select .h' ).click( function ( event ) {

        s      = $( this ).parent();
        b      = $( this ).next();
        label  = $( this ).children( 'label' );
        option = $( b ).find( 'li' );
        select = $( '#' + $( s ).attr( 'id' ).replace( 'select-', '' ) );

        if ( !$( b ).hasClass( 'on' ) ) {
            $( '.select' ).removeClass( 'on' );
            $( '.select .b' ).removeClass( 'on' ).slideUp( 'fast' );
            $( b ).addClass( 'on' ).slideDown( 'fast' );
            $( s ).addClass( 'on' );

        }
        else {
            $( b ).removeClass( 'on' ).slideUp( 'fast' );
            $( s ).removeClass( 'on' );
        }

        $( option ).click( function () {
            $( b ).removeClass( 'on' ).slideUp( 'fast' );
            $( label ).html( $( this ).html() );
            $( option ).removeAttr( 'data-selected' );
            $( this ).attr( 'data-selected', 'on' );
            $( select ).val( $( this ).attr( 'data-value' ) );
            $( s ).removeClass( 'on' );
            updateStatut( $( this ).data() );
        } );

    } );

    $( '.fmask.select' ).clickoutside( function () {

        fmask_select_close();

    } );

    $( document ).keydown( function ( e ) {

        if ( e.keyCode == 27 ) {

            fmask_select_close();
        }

    } );

}

function fmask_select_close() {
    $( '.fmask.select .b' ).removeClass( 'on' ).slideUp( 'fast' );
    $( '.fmask.select' ).removeClass( 'on' );
}
function updateStatut( objet ) {
    /* infoColor:"#0933FF"
     infoName:"Retard justifiés"
     infoSelect:"undefined"
     infoSelector:"statut-661"
     selected:"on"
     value:3*/
    if ( objet.infoSelector !== "undefined" ) {
        document.querySelectorAll( objet.infoSelector + '>span' )[0].style.background=objet.infoColor;
        document.querySelectorAll( objet.infoSelector + '>span' )[1].innerHTML=objet.infoName;
        document.querySelectorAll( objet.infoSelector + '>img' )[0].style.borderColor=objet.infoColor;
    }
}