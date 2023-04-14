(function($) {
    
    // Function called by the iteration
    $.lemLink = function( element, options ) {
        
        var defaults = {
            
            linkTarget:     ''      // The <a> tag that points to the desired url (if not set, the first encountered in the lemLinked element will be used)
            
        }
        
        var plugin = this;
        
        plugin.settings = {}
        
        var $element = $( element );
        var targetURL;                  //The URL to point to
        var targetWindow;               //The link needs to open in which window
        var doubleLinkingFlag;          //Flag to determine if a link was clicked
        
        
        /* ------ INIT --------------------------------------------------------------------------- */
        plugin.init = function() {
            
            plugin.settings = $.extend( {}, defaults, options );
            
            doubleLinkingFlag = false;
            
            $element.find( 'a' ).bind( 'mouseup', preventDoubleLinking );            
            defineTarget();
            
        }
        /* --------------------------------------------------------------------------------------- */
        
        /* ------ PREVENT DOUBLE LINKING --------------------------------------------------------- */
        var preventDoubleLinking = function(){
            
            doubleLinkingFlag = true;
            
        };
        /* --------------------------------------------------------------------------------------- */
        
        /* ------ TARGET CHECK ------------------------------------------------------------------- */
        var defineTarget = function(){
            
            if ( plugin.settings.linkTarget !== '' ) {
                
                targetURL = $( plugin.settings.linkTarget ).attr( 'href' );
                targetWindow = $( plugin.settings.linkTarget ).attr( 'target' );
                
            } else {
                
                var containedLinks;
                
                containedLinks = $element.find( 'a' );
                
                if ( containedLinks.length > 0 ) {
                    
                    targetURL = containedLinks.eq( 0 ).attr( 'href' );
                    targetWindow = containedLinks.eq( 0 ).attr( 'target' );
                    
                }
                
            }
            
            if ( targetURL !== null ) {
                
                setClickAction();
                
            }
            
        };
        /* --------------------------------------------------------------------------------------- */
        
        
        /* ------ SET CLICK ACTION --------------------------------------------------------------- */
        var setClickAction = function(){
            
            if ( $element.css( 'cursor' ) === 'auto' ) {
                
                $element.css( 'cursor', 'pointer' );
                
            }
            
            $element.mouseup( setLink );
            
        };
        /* --------------------------------------------------------------------------------------- */
        
        
        /* ------ SET LINK ----------------------------------------------------------------------- */
        var setLink = function(){
            
            if( !doubleLinkingFlag ){
                
                if ( targetWindow === null || targetWindow === '' || targetWindow === undefined ){
                    
                    window.location = targetURL;
                    
                } else {
                    
                    window.open( targetURL, targetWindow );
                    
                }
                
            } else {
                
                doubleLinkingFlag = false;
                
            }
            
        };
        /* --------------------------------------------------------------------------------------- */
        
        
        plugin.init();
        
        return this;
        
    }
    
    
    // Plugin call that will iterate through the elements that match the call
    $.fn.lemLink = function( options ) {
        
        return this.each( function() {
            
            if ( undefined == $( this ).data( 'lemLink' ) ) {
                
                var plugin = new $.lemLink( this, options );
                $( this ).data( 'lemLink', plugin );
                
            }
            
        });
        
    }
    
})(jQuery);