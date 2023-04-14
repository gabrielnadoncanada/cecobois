// Dependency: anyTagIntoBtn()
// @author Hugo Soucy <hugo@soucy.cc>, Louis-Michel Couture <louim_1@hotmail.com> 2012
// @option targetElements (string): Determining the content block selector. Default null.
// @option showFirst (boolean): Show the first tab. Default true.
// @option focusableElementsSelector (string): Element that shouldn't focus when page tab is not active
// @option backToContentSelector (string): Used to scope the position of the 'back to content' link.
// @option activationText (object): object containing the different translations.
// @option backToContentVisible (boolean): determine if the back to content will show on screen of not.
// @option backToContentText (object): object containing the different translations for the bakc to tabs button.
// @option lang (string): page current language attribute.
//
// @usage $("ul").FacileTabs();
( function( $ ) {

    $.fn.FacileTabs = function( params ) {

        params = $.extend( {
            targetElements: null,
            showFirst: true,
            focusableElementsSelector: 'a, button, input, select, textarea',
            backToContentSelector: null,
            activationText: {
                fr: '. Appuyez sur entrée pour activer',
                en: '. Press enter to activate'
            },
            backToContentVisible: false,
            backToContentText: {
                fr: 'Retourner aux onglets',
                en: 'Back to tabs'
            },
            lang: $( 'html' ).attr( 'lang' )
        }, params );

        this.addClass( "FacileTabs" ).attr( 'aria-live', 'polite' ).find( 'a' ).each( function() {
            $( this ).anyTagIntoBtn();
        } );

        var $tabs = this.find( "button" ),
            $focusStorage;

        $tabs.each( function() {
            var $tab = $( this ),
                $tabContent = $( $tab.data( "href" ) );

            $tab.addClass( "tabButton" ).append( '<span class="visuallyhidden">' + params.activationText[ params.lang ] + '</span>' );
            $tabContent.hide().addClass( "tabContent" ).find( params.focusableElementsSelector ).attr( 'tabindex', '-1' );

            $tab.on( 'keydown', function( e ) {
                if ( e.which == 13 ) {
                    $( this ).trigger( "click", true );
                    e.preventDefault();
                }
            } ).on( "click", function( e, wasEnterKey ) {
                if ( wasEnterKey == null ) {
                    wasEnterKey = false;
                }
                e.preventDefault();

                $focusStorage = $( this );

                $tabs.removeClass( "selected" );
                $tab.addClass( "selected" );

                if ( params.targetElements == null ) {
                    var buttonContent = '<button type="button" class="ft-btn-guard visuallyhidden">&nbsp;</button>';

                    if ( params.backToContentVisible ) {
                        buttonContent = '<button type="button" class="ft-btn-guard-visible visuallyhidden jump">' + params.backToContentText[ params.lang ] + '</button>';
                    }

                    $( ".tabContent" ).hide().children( ".ft-btn-guard" ).remove();

                    if ( params.backToContentSelector != null ) {
                        $tabContent.find( params.backToContentSelector ).append( buttonContent );
                    } else {
                        $tabContent.append( buttonContent );
                    }
                    $tabContent.prepend( '<button type="button" class="ft-btn-guard visuallyhidden">&nbsp;</button>' ).fadeIn().find( params.focusableElementsSelector ).removeAttr( 'tabindex' );

                    //if(wasEnterKey){
                    $tabContent.children( ":first-child" ).next().attr( "tabindex", "-1" ).focus().removeAttr( "tabindex" );
                    //}
                    $tabContent.on( "focusin", function() {
                        $tabContent.on( "focusout", function() {
                            $( ' .ft-btn-guard' ).remove();
                            $( ' .ft-btn-guard-visible' ).remove();
                        } );
                    } );

                } else if ( params.targetElements != null ) {

                    var $targetElements = $( params.targetElements ),
                        activeIndex = $tabs.index( this ),
                        buttonContent = '<button type="button" class="ft-btn-guard visuallyhidden">&nbsp;</button>';

                    if ( params.backToContentVisible ) {
                        buttonContent = '<button type="button" class="ft-btn-guard-visible visuallyhidden jump">' + params.backToContentText[ params.lang ] + '</button>';
                    };

                    $targetElements.hide().children( ".ft-btn-guard" ).remove();

                    if ( params.backToContentSelector != null ) {
                        $targetElements.find( params.backToContentSelector ).append( buttonContent );
                    } else {
                        $targetElements.append( buttonContent );
                    }

                    $targetElements.eq( activeIndex ).prepend( '<button type="button" class="ft-btn-guard visuallyhidden">&nbsp;</button>' ).append( buttonContent ).fadeIn().find( params.focusableElementsSelector ).removeAttr( 'tabindex' );

                    //if(wasEnterKey){
                    $tabContent.children( ":first-child" ).next().attr( "tabindex", "-1" ).focus().removeAttr( "tabindex" );
                    //}
                }
            } );
        } );

        if ( params.showFirst == true ) {
            $tabs.eq( 0 ).addClass( "selected" );
            $( ".tabContent" ).eq( 0 ).fadeIn();
        }

        //Focus gestion
        $( document ).on( 'focus', '.ft-btn-guard', {}, function() {
            //Restore focus
            $focusStorage.focus();
            $( '.tabContent' ).find( params.focusableElementsSelector ).attr( 'tabindex', '-1' );
            $( '.ft-btn-guard' ).remove();
        } );

        if ( params.backToContentVisible ) {
            $( document ).on( 'focus', '.ft-btn-guard-visible', {}, function() {
                $( '.ft-btn-guard-visible' ).removeClass( 'visuallyhidden' );
            } );
            $( document ).on( 'click', '.ft-btn-guard-visible', {}, function() {
                $focusStorage.focus();
                $( '.tabContent' ).find( params.focusableElementsSelector ).attr( 'tabindex', '-1' );
                $( '.ft-btn-guard' ).remove();
                $( '.ft-btn-guard-visible' ).remove();
            } );
        }
        //prevent normally focusable content from being inaccessible if the content is accessed by other mean than the content tabs.
        // $( document ).on( 'focusin','.tabContent', {}, function(){
        // 	$( this ).find( params.focusableElementsSelector ).removeAttr( 'tabindex' );
        // } );
    };
} )( jQuery );