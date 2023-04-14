// AnyTagIntoBtn
// Replace any HTML tag with a button tag. Used in JavaScript files optimized for web accessibility.
// @author Hugo Soucy <hugo@soucy.cc> 2012
// @author Louis-Michel Couture <louim_1@hotmail.com> 2013
// @usage $("a").anyTagIntoBtn();
( function( $ ){
	$.fn.anyTagIntoBtn = function(){
		var tag = this;

		function getAttributes( tag ){
			var $tag = $( tag ),
			attrs = $tag[ 0 ].attributes,
			attrLength = attrs.length,
			attrMap = "";

			for( i = 0;i < attrLength;i++ ){
				attrMap += attrs[ i ].name+'="'+attrs[ i ].value+'" ';
			}

			var regEx_href = /href/gi;

			if( attrMap.match( regEx_href ) ){
				attrMap = attrMap.replace( regEx_href,"data-href" );
			}

			return attrMap;
		}

		function setTheSwitching( tag ){
			var $tag = $( tag );
				$newButtons = $( [] );

			$tag
			.addClass( "btn-anytagintobtn" )
			.each( function(){
				var $that = $( this ),
				attrs = getAttributes( tag ),
				parent = $that.parent(),
				$button = $( "<button "+attrs +">"+ $that.html() +"</button>" );

				$that.replaceWith( $button );
				$newButtons =  $newButtons.add( parent.find( $button ) );
			} );
			return $newButtons;
		}
		return setTheSwitching( tag );
	};
} )( jQuery );