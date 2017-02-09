(function( $ ) {
    "use strict";
 
    wp.customize( 'course_link_color', function( value ) {
        value.bind( function( to ) {
            $( 'a' ).css( 'color', to );
        } );
    });
 
})( jQuery );
