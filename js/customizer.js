/* global wp, jQuery */
/**
 * File customizer.js.
 *
 * Theme Customizer enhancements for a better user experience.
 *
 * Contains handlers to make Theme Customizer preview reload changes asynchronously.
 */

( function( $ ) {
	// Site title and description.
	wp.customize( 'blogname', function( value ) {
		value.bind( function( to ) {
			$( '.site-title a' ).text( to );
		} );
	} );
	wp.customize( 'blogdescription', function( value ) {
		value.bind( function( to ) {
			$( '.site-description' ).text( to );
		} );
	} );

	// Header text color.
	wp.customize( 'header_textcolor', function( value ) {
		value.bind( function( to ) {
			if ( 'blank' === to ) {
				$( '.site-title, .site-description' ).css( {
					clip: 'rect(1px, 1px, 1px, 1px)',
					position: 'absolute',
				} );
			} else {
				$( '.site-title, .site-description' ).css( {
					clip: 'auto',
					position: 'relative',
				} );
				$( '.site-title a, .site-description' ).css( {
					color: to,
				} );
			}
		} );
	} );
	//header links color
	wp.customize('header_links_color', function(value) {
		value.bind(function(to) {
		  $(".site-header a").css({
			'color': to
		  });
		});
	  });
	  //content links color
	  wp.customize('content_links_color', function(value) {
		value.bind(function(to) {
		  $(".content-area a, .widget-area a, .post a, .widget a").css({
			'color': to
		  });
		});
	  });
	  //header color
	  wp.customize('header_bg_color', function(value) {
		value.bind(function(to) {
		  $('.site-header, .main-navigation ul ,.main-navigation li ,.main-navigation a, .menu-bar ul ,.menu-bar li ,.menu-bar a').css({
			'background-color': to
		  });
		});
	  });
	  //footer color
	  wp.customize('footer_bg_color', function(value) {
		value.bind(function(to) {
		  $('.site-footer').css({
			'background-color': to
		  });
		});
	  });
	  //footer text 	  
	  wp.customize('footer_text', function(value) {
		value.bind(function(to) {
		  $('.site-info').text(to)
		});
	  });
}( jQuery ) );
