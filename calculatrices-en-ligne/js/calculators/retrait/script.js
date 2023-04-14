var names = {
	"hauteur_mur" 			: "La hauteur du mur",
	"hauteur_plancher" 		: "La hauteur du plancher",
	"nb_lisse" 				: "Le nombre de lisse",
	"epaisseur_lisse" 		: "L'\u00E9paisseur des lisses",
	"nb_sabliere" 			: "Le nombre de sabli\u00E8res",
	"epaisseur_sabliere" 	: "L'\u00E9paisseur des sabli\u00E8res",
	"thi_colombage"			: "La teneur en humidit\u00E9 à l'installation des colombages",
	"thi_lisse"				: "La teneur en humidit\u00E9 à l'installation des lisses",
	"thi_sabliere"			: "La teneur en humidit\u00E9 à l'installation des sabli\u00E8res",
	"thi_plancher"			: "La teneur en humidit\u00E9 à l'installation des ",
	"ths_colombage"			: "La teneur en humidit\u00E9 en service des colombages",
	"ths_lisse"				: "La teneur en humidit\u00E9 en service des lisses",
	"ths_sabliere"			: "La teneur en humidit\u00E9 en service des sabli\u00E8res",
	"ths_plancher"			: "La teneur en humidit\u00E9 en service des ",
	"solive"				: "Solives",
	"poutrelle_avec"		: "Solives de rive",
	"poutrelle_sans"		: "Poutrelles"
};

var select_options = {
	"lisse"		: {
		1	:	'',
		2	:	'',
		3	:	'',
		4	:	'',
		5	:	'',
		6	:	''
	},
	"sabliere"	: {
		1	:	'',
		2	:	'',
		3	:	'',
		4	:	'',
		5	:	'',
		6	:	''
	}
	
};

//
//---------------------------------------------------------------------------
//
//pour l'affichage des etages
aff_etages = function(sel){
	//close all etages
	$('#etage2').hide();
	$('#etage3').hide();
	$('#etage4').hide();
	$('#etage5').hide();
	$('#etage6').hide();
	
	$('.etage1 .appliquer_tous').parent().hide();
	$('.etage2 .appliquer_tous').parent().hide();
	$('.etage3 .appliquer_tous').parent().hide();
	$('.etage4 .appliquer_tous').parent().hide();
	$('.etage5 .appliquer_tous').parent().hide();
	$('.etage6 .appliquer_tous').parent().hide();
	
	is_print = $('body').hasClass('print');
	
	if(is_print){
		sel = $('.num_etage').html();	
		$('.etage2').hide();
		$('.etage3').hide();
		$('.etage4').hide();
		$('.etage5').hide();
		$('.etage6').hide();
	}

	switch(sel)
	{
		case "6":
			$('#etage6').show();
			if(is_print){ $('.etage6').show(); }
			$('.etage5 .appliquer_tous').parent().show();
		case "5":
			$('#etage5').show();
			if(is_print){ $('.etage5').show(); }
			$('.etage4 .appliquer_tous').parent().show();
		case "4":
			$('#etage4').show();
			if(is_print){ $('.etage4').show(); }
			$('.etage3 .appliquer_tous').parent().show();
		case "3":
			$('#etage3').show();
			if(is_print){ $('.etage3').show(); }
			$('.etage2 .appliquer_tous').parent().show();
		case "2":
			$('#etage2').show();
			if(is_print){ $('.etage2').show(); }
			$('.etage1 .appliquer_tous').parent().show();
			break;
	}

	//grab the current index of the active pane..
	if(!is_print){
		var pane = $('#accordion').accordion('option', 'active');
		var current = parseFloat(sel.value) - 1;
		//if the selected etage is lower or equal to the total amount of etages displayed, display it, otherwise switch to first etage
		if(current >= pane)
		{
			$("#accordion").accordion("activate",pane);		
		}else{
			//$("#accordion").accordion("activate",0);
		}
	}
	else{
		$("#accordion").addClass('ui-accordion ui-widget ui-helper-reset ui-accordion-icons');
		for(var i = 1; i <= 6; i++){
			$('#etage'+i).addClass('ui-accordion-header ui-helper-reset ui-state-active ui-corner-top');
			$('.etage'+i).addClass('ui-accordion-content ui-helper-reset ui-widget-content ui-corner-bottom ui-accordion-content-active');
		}
	}
	
	iframeHeight();
}

function showHiddenForm()
{
	document.getElementById('absolute').style.display = "block";
}
function hideHiddenForm()
{
	document.getElementById('absolute').style.display = "none";
}

function launchCalculate()
{
	//means user pressed I accept on the hidden form
	hideHiddenForm();
	document.getElementById('action').value = 'calculate';
	//reset all elements to enable..
	msg = ""
	var elem = document.getElementById('calc').elements;
	for(var i = 0; i < elem.length; i++)
	{
		elem[i].disabled = false;
	} 
	document.calcul.submit();
}

//function used to ''reset'' all the elements after the form is loaded
function reset_onload(sent){
	aff_etages($('#etages').val());
	$('.type_lisse select').each(function(){
		changeLisse($(this));
	});
	
	$('.type_sabliere select').each(function(){
		changeSabliere($(this));
	});
}

function appliquer_tous(bouton){
	var current = 1;
	var total = $('#etages :selected').val();
	var classList = $(bouton).parent().parent().attr('class').split(/\s+/);
	
	$(bouton).parent().addClass('clicked');
	
	$.each( classList, function(index, item){
		if (item.indexOf('etage') !== -1) {
		   current = parseInt(item.slice(-1),10);
		}
	});
	
	if(current+1 <= total){
		var inputs = new Object();
		
		$('.etage'+current+' input').each(function(){
			inputs[$(this).attr('id').slice(0,-1)] = $(this).val();
		});
		
		$('.etage'+current+' select').each(function(){
			inputs[$(this).attr('id').slice(0,-1)] = $(this).find(':selected').val();
		});
		
		
		
		for(var i = (current+1); i <= total; i++){
			for(key in inputs){
				$('#'+key+i).val(inputs[key]);	
			}
			changeLisse($('#lisse'+i));
			changeSabliere($('#sabliere'+i));
		}

		if($('.etage'+current+' #plancher'+current).val() != 'dalle_beton'){
			img_html = $('.etage'+current+' .plancher_chosen a').html();
			
			for(var i = (current+1); i <= total; i++){
				$('.etage'+i+' .plancher_chosen a').html(img_html.replace('_f.png','.png'));	
			}	
		}
	}
	
}

function validateForm(isDebug)
{
	//aller chercher le nombre d'etages..
	nEtages = $('#etages').val();
	var valid = true;
	var errMsg = "";
	var errTmp = "";
	var mesure_hidden = checkRadio(document.getElementsByName('systeme'));
	
	for (i=1;i<=nEtages;i++)
	{
		etage = "Erreur pour l'\u00E9tage " + i + " : \n";
		var errTmp = "";
		var valid = true;
		var hauteur_mur = false;
		
		//replace , with .
		$('.etage'+i+' .mesure input').each(function(){
			$(this).val(replaceCommaWithDot($(this).val()));
		});
		
		//Test mesure et int pour plus grand que zero et un chiffre
		$('.etage'+i+' .mesure input, .etage'+i+' .int input').each(function(){
			val = $(this).val();
			name = names[$(this).attr('id').slice(0,-1)];
			
			if($(this).attr('id').slice(0,-1).indexOf('hauteur_mur') == -1){
				if(isNaN(val) || val == ""){
					errTmp += "\t" + name + " n'est pas un nombre\n";
				}
				else{
					if(val < 0)
					{
						errTmp += "\tLa valeur minimale de "+ name.toLowerCase() +" est de 0\n";
					}
				}
			}
			else if(!hauteur_mur){
				if(mesure_hidden == 'met'){
					if(isNaN(val) || val == ""){
						errTmp += "\t" + name + " n'est pas un nombre\n";
					}
					else{
						if(val < 0)
						{
							errTmp += "\tLa valeur minimale de "+ name.toLowerCase() +" est de 0\n";
						}
					}
					
				}
				else{
					val1 = $('#hauteur_mur_po'+i).val();
					val2 = $('#hauteur_mur_pi'+i).val();
					name = names['hauteur_mur'];
					
					if(isNaN(val1) || isNaN(val2) || (val1 == "" && val2 == "")){
						errTmp += "\t" + name + " n'est pas un nombre\n";
					}
					else{
						if(val1 < 0 || val2 < 0)
						{
							errTmp += "\tLa valeur minimale de "+ name.toLowerCase() +" est de 0\n";
						}
					}
				}
				
				hauteur_mur = true;
			}
		});
		
		var mesure_hidden		= checkRadio(document.getElementsByName('systeme'));
		
		if(mesure_hidden == 'met'){
				val = $("hauteur_mur_"+i)	.val();
		}
		
		//pourcent entre 0% et 100% et un chiffre
		$('.etage'+i+' .pourcent input').each(function(){
			ignore = false;
			val = $(this).val();
			if($(this).attr('id').slice(4,-1) == "plancher"){
				type = $('#plancher'+i).val();
				if(type == 'beton'){
					ignore = true;	
				}
				else{
					name = names[$(this).attr('id').slice(0,-1)] + names[type].toLowerCase();
				}
				
			}
			else{
				name = names[$(this).attr('id').slice(0,-1)];
			}
			
			if(!ignore){
				if(isNaN(val) || val == ""){
					errTmp += "\t" + name + " n'est pas un nombre\n";
				}
				else{
					if(val < 0)
					{
						errTmp += "\tLa valeur minimale de "+ name.toLowerCase() +" est de 0%\n";
					}
					else if(val > 100)
					{
						errTmp += "\tLa valeur maximale de "+ name.toLowerCase() +" est de 100%\n";
					}
				}
			}
		});
		
		if(errTmp != ''){
			errMsg += etage + errTmp;
		}	
	}

	//means everything is all right, show hidden form..
	if(errMsg == "")
	{
		showHiddenForm();
		window.location.hash="hidden_form_anchor";
	}else{
		alert(errMsg);
	}
}

function replaceCommaWithDot(val)
{
	return val.replace(",",".");
}

function modalPlancher( index ){
	val = $('#plancher'+index).val();
	
	$('.modal_plancher').data('etage', index);
	$('.modal_plancher div').removeClass('selected');
	$('.modal_plancher #'+val).parent().addClass('selected');
	
	if(index == 1){
		$('.modal_plancher img').each(function(){
			var src = $(this).attr('src')
			if(src.indexOf('_f.png') == -1){
				$(this).attr('src', src.replace('.png','_f.png'));
			}
		});	
		
		$('.modal_plancher #dalle_beton').parent().show();
	}
	else{
		$('.modal_plancher img').each(function(){
			$(this).attr('src', $(this).attr('src').replace('_f.png','.png'));
		});	
		
		$('.modal_plancher #dalle_beton').parent().hide();
	}
	
	$.colorbox({inline:true, href:".modal_plancher"});
}

$(function() {
	$('body').delegate(".modal_plancher div", "click", function(){
		$('#plancher'+$(this).parent().data('etage')).val($('img', this).attr('id'));
		$('.etage'+$(this).parent().data('etage')+' .plancher_chosen a div').html($(this).html());
		$('#cboxClose').click();
		$('.etage'+$(this).parent().data('etage')+' .clicked').removeClass('clicked');
		$('.etage'+$(this).parent().data('etage')).prevAll().find('.clicked').removeClass('clicked');	
	})
	
	$('input, select').bind('change', function(){
		$(this).closest('.ui-accordion-content').find('.clicked').removeClass('clicked');
		$(this).closest('.ui-accordion-content').prevAll().find('.clicked').removeClass('clicked');									
	});
});

function resetAll(){
	$('select').each(function(){ 
		if($(this).attr('id') == 'humidite'){
			this.selectedIndex = 2; 
		}
		else{
			this.selectedIndex = 0; 	
		}
	});
	
	$('input[type=text]').val('');
	
	$text = $('.modal_plancher > div:first').html();	
	$text_2 = $text.replace('_f.png','.png');
	$text_1 = $text_2.replace('.png','_f.png');
	
	for(var i=1; i<=6;i++){
		if( i == 1){ $('.etage'+i+' .plancher_chosen a div').html($text_1); }
		else{ $('.etage'+i+' .plancher_chosen a div').html($text_2); }
	}
	
	aff_etages($('#etages').val());
}

function changeLisse(lisse){
	etage = $(lisse).attr('id').slice(-1);
	selected = $('#epaisseur_lisse'+etage).get(0).selectedIndex;
	if(selected == -1){ selected = 0; }
		
	if(select_options['lisse'][etage] == ''){
		select_options['lisse'][etage] = $('#epaisseur_lisse'+etage+' option').detach();
	}
	
	if($(lisse).val().indexOf('bois_sciage') == -1){
		$('#epaisseur_lisse'+etage+' option').remove();	
		$('#epaisseur_lisse'+etage).append(select_options['lisse'][etage]);
		$('#epaisseur_lisse'+etage).get(0).selectedIndex = selected;
	}
	else{
		
		$('#epaisseur_lisse'+etage+' option').remove();	
		$('#epaisseur_lisse'+etage).append(select_options['lisse'][etage][0]);
		$('#epaisseur_lisse'+etage).get(0).selectedIndex = 0;
	}
}

function changeSabliere(sabliere){
	etage = $(sabliere).attr('id').slice(-1);
	selected = $('#epaisseur_sabliere'+etage).get(0).selectedIndex;
	if(selected == -1){ selected = 0; }
	
	if(select_options['sabliere'][etage] == ''){
		select_options['sabliere'][etage] = $('#epaisseur_sabliere'+etage+' option').detach();
	}
	
	if($(sabliere).val().indexOf('bois_sciage') == -1){
		$('#epaisseur_sabliere'+etage+' option').remove();	
		$('#epaisseur_sabliere'+etage).append(select_options['sabliere'][etage]);
		$('#epaisseur_sabliere'+etage).get(0).selectedIndex = selected;
	}
	else{
		
		$('#epaisseur_sabliere'+etage+' option').remove();	
		$('#epaisseur_sabliere'+etage).append(select_options['sabliere'][etage][0]);
		$('#epaisseur_sabliere'+etage).get(0).selectedIndex = 0;
	}
}