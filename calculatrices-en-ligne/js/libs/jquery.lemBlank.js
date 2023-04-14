/**
 * lemBlank version 0.2
 * This plugin rewrite the title in externals links to improve accessibility.
 *
 * Copyright 2013 Nebbio
 */
( function ( $ ) {
	$.fn.lemBlank = function( options ) {

		'use strict';

		var settings = $.extend( {
			overwriteTitle: true, //force the overwrite of the title. Default to true
			lang: $( 'html' ).attr( 'lang' ).substring( 0, 2 ), //define the lang of the document. Default to the lang attr.
			titleText:{
				fr:'Ce lien s\'ouvrira dans une nouvelle fenêtre',
				en: 'This link will open in a new window'
			}, //Text to write in the title
		}, options );

		return this.find( "a[ target='_blank' ]" ).each( function(){

			if( settings.overwriteTitle ){
				$( this ).attr( 'title', settings.titleText[ settings.lang ] );
			} else {
				var title = $( this ).attr( 'title' );
				if( title ){
					title += ( ". "+ settings.titleText[ settings.lang ] );
					$( this ).attr( 'title', title );
				} else{
					$( this ).attr( 'title', settings.titleText[ settings.lang ] );
				}
			}
		} );
	}
}( jQuery ) );