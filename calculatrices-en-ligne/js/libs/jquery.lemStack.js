(function($) {
    $.fn.lemStack = function(settings) {
    
        var config = {
            
            minHeight:      0,      // Minimal OUTER height of the columns
            perRow:         0,      // Number of elements per row
            em:             false,  //Set to true if you want the height to be set as em instead of pixels
            emBase:         16      //Set the base pixel value of 1em
            
        };
        
        if ( settings ) {

            $.extend( config, settings );
            
        }
        
        var mThis = this;               //This
        var columns;                    //Column elements
        
        /* ------ INIT ------------------------------------------------------------------------ */
        var init = function(){
            
            columns = $( mThis );
            
            heightCheck();
            
        };
        /* --------------------------------------------------------------------------------------- */
        
        /* ------ HEIGHT CHECK ------------------------------------------------------------------- */
        var heightCheck = function(){
            
            var numRow = 0;
            var targetHeight = new Array();
            targetHeight[ numRow ] = config.minHeight;
            
            for ( var i = 0; i < columns.length; i++ ){
                if ( columns.eq( i ).outerHeight() > targetHeight[ numRow ] ) {
                    targetHeight[ numRow ] = columns.eq( i ).outerHeight();
                }
                if ( ( i + 1 ) % config.perRow == 0 ){
                    numRow++;
                    targetHeight[ numRow ] = config.minHeight;
                }
            }
            
            heightChange( targetHeight );
            
        };
        /* --------------------------------------------------------------------------------------- */
        
        /* ------ HEIGHT CHANGE ------------------------------------------------------------------ */
        var heightChange = function( targetHeight ){
            
            var numRow = 0;
            var currentTarget;
            var individualTarget;
            
            for ( var i = 0; i < columns.length; i++ ){
                if( columns.eq( i ).css( 'box-sizing' ) == 'content-box' ){
                    individualTarget = targetHeight[ numRow ] - ( columns.eq( i ).outerHeight() - columns.eq( i ).height() );
                } else {
                    individualTarget = targetHeight[ numRow ];
                }
                
                if( config.em ){
                    columns.eq( i ).css( 'height', ( individualTarget / config.emBase ) + 'em' );
                } else {
                    columns.eq( i ).css( 'height', individualTarget + 'px' );
                }
                
                if ( ( i + 1 ) % config.perRow == 0 ){
                    numRow++;
                }
            }
            
        };
        /* --------------------------------------------------------------------------------------- */
        
        
        init();
        
        return this;
        
    };
    
})(jQuery);