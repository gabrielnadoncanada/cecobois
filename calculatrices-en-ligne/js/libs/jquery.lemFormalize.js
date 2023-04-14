(function( jQuery ) {
    jQuery.fn.lemFormalize = function( settings ) {
    
        var config = {
            placeholder:        false,           // Set to true to activate the placeholder functionality
            placeholderClass:   'placeholder',   // Name of the desired placeholder class (no . in front of it!)
            autofocus:          false,           // Set to true to activate the autofocus functionality
            formaction:         false,           // Set to true to activate the formaction functionality
            formenctype:        false,           // Set to true to activate the formenctype functionality
            formmethod:         false,           // Set to true to activate the formmethod functionality
            formtarget:         false            // Set to true to activate the formtarget functionality
        };
        
        if ( settings ) {
            jQuery.extend( config, settings );
        }
        
        var mThis = this;               //This
        var targetForm;                 //The form targeted
        var placeholderTextBoxes;       //Elements with placeholder values
        
        /* ------ INIT ------------------------------------------------------------------------ */
        var init = function(){
            
            targetForm = jQuery( mThis );
            
            //Placeholder
            if( !isSupported( 'input', 'placeholder' ) && config.placeholder ){
                targetForm.unbind( 'submit', commonSubmitCheckup );
                targetForm.bind( 'submit', commonSubmitCheckup );
                targetForm.unbind( 'aftersubmit', placeholderSetValues );
                targetForm.bind( 'aftersubmit', placeholderSetValues );

                placeholderInit();
            }
            
            //Autofocus
            if( !isSupported( 'input', 'autofocus' ) && config.autofocus ){
                autofocusInit();
            }
            
            //FormAction
            if( ( !isSupported( 'input', 'formAction' ) && config.formaction ) || ( !isSupported( 'input', 'formEnctype' ) && config.formenctype ) || ( !isSupported( 'input', 'formMethod' ) && config.formmethod ) || ( !isSupported( 'input', 'formTarget' ) && config.formtarget ) ){
                targetForm.unbind( 'submit', commonSubmitCheckup );
                targetForm.bind( 'submit', commonSubmitCheckup );
                formAlternativesInit();
            }
            
        };
        /* --------------------------------------------------------------------------------------- */
        
        /* ------ COMMON CHECK IF IS SUPPORTED --------------------------------------------------- */
        var isSupported = function( theElement, theAttribute ) {
            var test = document.createElement( theElement );
            return ( theAttribute in test );
        };
        /* --------------------------------------------------------------------------------------- */
        
        /* ------ COMMON SET CARET --------------------------------------------------------------- */
        var commonSetCaret = function( currentElement, position ){
            if ( currentElement[0].createTextRange ) {
                var part = currentElement[0].createTextRange();
                part.collapse( true );
                part.moveEnd( 'character', position );
                part.moveStart( 'character', position );
                part.select();
            } else if ( currentElement[0].setSelectionRange ){
                currentElement[0].setSelectionRange( position, position );
            }
        };
        /* --------------------------------------------------------------------------------------- */
        
        /* ------ COMMON PRESUBMIT CHECKUP ------------------------------------------------------- */
        var commonPresubmitCheckup = function(){
            //Placeholder
            if( !isSupported( 'input', 'placeholder' ) && config.placeholder ){
                placeholderTextBoxes = targetForm.find( '*[placeholder]' );
                placeholderTextBoxes.unbind();

                for ( var i = 0; i < placeholderTextBoxes.length; i++ ){
                    currentTextbox = placeholderTextBoxes.eq(i)
                    
                    if( currentTextbox.val() == currentTextbox.attr( 'placeholder' ) ){
                        currentTextbox.val( '' );
                        currentTextbox.removeClass( config.placeholderClass );
                    }
                }

                placeholderTextBoxes.bind( 'focus click keyup keydown keypress', placeholderCheckFocus );
                placeholderTextBoxes.bind( 'keyup textinput', placeholderCheckValues );
            }
            
            return true;
        };
        /* --------------------------------------------------------------------------------------- */
        
        /* ------ COMMON SUBMIT CHECKUP ---------------------------------------------------------- */
        var commonSubmitCheckup = function(e){
            if ( !targetForm.hasClass( 'ajax' ) ) targetForm.unbind( 'submit', commonSubmitCheckup );
            e.preventDefault();

            if( commonPresubmitCheckup() ){
                if ( !targetForm.hasClass( 'ajax' ) ) {
                    targetForm.trigger( 'submit' ).bind( 'submit', commonSubmitCheckup );
                }
            }
        };
        /* --------------------------------------------------------------------------------------- */
        
        /////////////////////////////////////////////////////////////////////////////////////////////
        /////////////////////////////////////// PLACEHOLDER /////////////////////////////////////////
        /////////////////////////////////////////////////////////////////////////////////////////////
        
        /* ------ PLACEHOLDER INIT --------------------------------------------------------------- */
        var placeholderInit = function() {
            placeholderTextBoxes = targetForm.find( '*[placeholder]' );
            
            placeholderTextBoxes.bind( 'focus click keyup keydown keypress', placeholderCheckFocus );
            placeholderTextBoxes.bind( 'keyup textinput', placeholderCheckValues );

            placeholderSetValues();
        };
        /* --------------------------------------------------------------------------------------- */
        
        /* ------ PLACEHOLDER CHECK FOCUS -------------------------------------------------------- */
        var placeholderCheckFocus = function(e){
            var currentElement = jQuery( this );
            
            if( currentElement.hasClass( config.placeholderClass ) ){
                commonSetCaret( currentElement, 0 );
            }
        };
        /* --------------------------------------------------------------------------------------- */
        
        /* ------ PLACEHOLDER CHECK VALUES ------------------------------------------------------- */
        var placeholderCheckValues = function(){
            var currentElement = jQuery( this );
            
            if( currentElement.val() === '' ){
                currentElement.addClass( config.placeholderClass );
                currentElement.val( currentElement.attr( 'placeholder' ) );
                if( currentElement.attr( 'type' ) === 'password' ){
                    currentElement = placeholderReplaceWithType( currentElement, 'text' );
                    currentElement.focus();
                }
                commonSetCaret( currentElement, 0 );
            } else {
                if( currentElement.hasClass( config.placeholderClass ) && currentElement.val() !== currentElement.attr( 'placeholder' ) ){
                    currentElement.removeClass( config.placeholderClass );
                    if( currentElement.hasClass( 'lemPlaceholder' ) ){
                        currentElement = placeholderReplaceWithType( currentElement, 'password' );
                        commonSetCaret( currentElement, 99999 );
                        currentElement.focus();
                    }
                    if( currentElement.index( currentElement.attr( 'placeholder' ) ) ){
                        currentElement.val( currentElement.val().replace( currentElement.attr( 'placeholder' ), '' ) );
                    }
                }
            }
        };
        /* --------------------------------------------------------------------------------------- */
        
        /* ------ PLACEHOLDER SET VALUES --------------------------------------------------------- */
        var placeholderSetValues = function(){
            var currentTextbox;

            for ( var i = 0; i < placeholderTextBoxes.length; i++ ){
                currentTextbox = placeholderTextBoxes.eq( i );

                if( currentTextbox.val() === '' || currentTextbox.val() === currentTextbox.attr( 'placeholder' ) ){
                    currentTextbox.val( currentTextbox.attr( 'placeholder' ) );
                    currentTextbox.addClass( config.placeholderClass );
                    
                    if( currentTextbox.attr( 'type' ) === 'password' ){
                        currentTextbox.addClass( 'lemPlaceholder' );
                        currentTextbox = placeholderReplaceWithType( currentTextbox, 'text' );
                    }
                }
            }
        };
        /* --------------------------------------------------------------------------------------- */
        
        /* ------ PLACEHOLDER REPLACE WITH TYPE -------------------------------------------------- */
        var placeholderReplaceWithType = function( currentTextbox, newType ){
            
            var eThis = currentTextbox.get(0);
            var oldAttributes = eThis.attributes
            var newAttributes = {};
            
            for( var i = 0; i < oldAttributes.length; i++ ){
                if( oldAttributes[i].specified === true ){
                    newAttributes[ oldAttributes[i].name ] = oldAttributes[i].value;
                }
            }
            newAttributes[ 'type' ] = newType;
            
            var newTextbox = jQuery( document.createElement( 'input' ) );
            
            for( x in newAttributes ){
                newTextbox.attr( x, newAttributes[x] );
            }
            
            newTextbox.val( currentTextbox.val() );
            newTextbox.bind( 'focus click keyup', placeholderCheckFocus );
            newTextbox.bind( 'keyup', placeholderCheckValues );
            
            currentTextbox.replaceWith( newTextbox );
            
            return newTextbox;
        };
        /* --------------------------------------------------------------------------------------- */
        
        
        /////////////////////////////////////////////////////////////////////////////////////////////
        //////////////////////////////////////// AUTOFOCUS //////////////////////////////////////////
        /////////////////////////////////////////////////////////////////////////////////////////////
        
        /* ------ AUTOFOCUS INIT ----------------------------------------------------------------- */
        var autofocusInit = function() {
            var autofocusElement = targetForm.find( '*[autofocus]' );
            commonSetCaret( autofocusElement.eq( 0 ), 0 );
        };
        /* --------------------------------------------------------------------------------------- */
        
        
        /////////////////////////////////////////////////////////////////////////////////////////////
        /////////////////////////////////////// FORMALTERNATIVES ////////////////////////////////////
        /////////////////////////////////////////////////////////////////////////////////////////////
        
        /* ------ FORMACTION INIT ---------------------------------------------------------------- */
        var formAlternativesInit = function() {
            if( !isSupported( 'input', 'formAction' ) && config.formaction ){
                var formactionElements = targetForm.find( '*[formaction]' );
                for( var i = 0; i < formactionElements.length; i++ ){
                    formactionElements.eq( i ).bind( 'click', formAlternativesChangeAttribute );
                }
            }
            if( !isSupported( 'input', 'formEnctype' ) && config.formenctype ){
                var formenctypeElements = targetForm.find( '*[formenctype]' );
                for( var j = 0; j < formenctypeElements.length; j++ ){
                    formenctypeElements.eq( j ).unbind( 'click' );
                    formenctypeElements.eq( j ).bind( 'click', formAlternativesChangeAttribute );
                }
            }
            if( !isSupported( 'input', 'formMethod' ) && config.formmethod ){
                var formmethodElements = targetForm.find( '*[formmethod]' );
                for( var k = 0; k < formmethodElements.length; k++ ){
                    formmethodElements.eq( k ).unbind( 'click' );
                    formmethodElements.eq( k ).bind( 'click', formAlternativesChangeAttribute );
                }
            }
            if( !isSupported( 'input', 'formTarget' ) && config.formtarget ){
                var formtargetElements = targetForm.find( '*[formtarget]' );
                for( var l = 0; l < formtargetElements.length; l++ ){
                    formtargetElements.eq( l ).unbind( 'click' );
                    formtargetElements.eq( l ).bind( 'click', formAlternativesChangeAttribute );
                }
            }
        };
        /* --------------------------------------------------------------------------------------- */
        
        /* ------ FORMACTION CHANGE ACTION ------------------------------------------------------- */
        var formAlternativesChangeAttribute = function(e) {
            targetForm.unbind( 'submit', commonSubmitCheckup );
            e.preventDefault();
            
            var clickedButton = jQuery( this );
            
            if( clickedButton.attr( 'formaction' ) != '' && !isSupported( 'input', 'formAction' ) && config.formaction ){
                targetForm.attr( 'action', clickedButton.attr( 'formaction' ) );
            }
            
            if( clickedButton.attr( 'formenctype' ) != '' && !isSupported( 'input', 'formEnctype' ) && config.formenctype ){
                targetForm.attr( 'enctype', clickedButton.attr( 'formenctype' ) );
            }
            
            if( clickedButton.attr( 'formmethod' ) != '' && !isSupported( 'input', 'formMethod' ) && config.formmethod ){
                targetForm.attr( 'method', clickedButton.attr( 'formmethod' ) );
            }
            
            if( clickedButton.attr( 'formtarget' ) != '' && !isSupported( 'input', 'formTarget' ) && config.formtarget ){
                targetForm.attr( 'target', clickedButton.attr( 'formtarget' ) );
            }
            
            if( commonPresubmitCheckup() ){
                targetForm.trigger( 'submit' );
            }
        }
        /* --------------------------------------------------------------------------------------- */
        
        
        init();
        
        return this;
        
    };
})(jQuery);