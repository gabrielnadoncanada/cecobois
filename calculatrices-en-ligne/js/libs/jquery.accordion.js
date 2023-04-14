(function($) {
	/*
	$.fn.menuHover	= function(){

		colorTemp		= '#a33e7d';
		vitesse_up		= 600;
		vitesse_down	= 300;

		$(this).hover(function(){
			if($(this).parent().hasClass('parent')){

				$(this).animate({color:'#000'},vitesse_up);
			}
		},function(){
			if($(this).parent().hasClass('parent')){
				$(this).animate({color:colorTemp},vitesse_down);
			}
	 	});
	};
	*/

	$.fn.accordion	= function() {

		var menu	= $(this);
		//console.log($(this).className())//on d̩fini le menu
		//$('ul',menu).hide();					//on cache tous les ul en dessous
		$('li.active',menu).parent().show();	//on affiche tous les ul dont les li sont active

		/* SI LE PREMIER NIVEAU A UN LIEN */
		/**********************************/
		var child_open	= false;
		if($('li#current').hasClass('parent')){
			$('li#current ul').show();
			$('li#current ul ul').hide();

			var old_li_current	= $('li#current');
			child_open	= true;
		}

		//----------------------------------------------------------------------------------------------------------------------------------------

		// lorsqu'on clic sur un lien
		$('a',menu).click(function(){


			a_new	= $(this);												//on assigne le lien choisi
			a_href	= a_new.attr('href');									//on va chercher le lien href

			/* SI IL N'Y A PAS DE LIENS */
			/****************************/
			if(a_href == '' || a_href == '#' || a_href == null){
				if($('li#current').attr('id')=='current'){						//on supprime le current si il y en a un
					//console.log(jQuery.fn.jquery);
					a_new.parentsUntil('.menu').each(function(){				// on v̩rifie que le lien cliqu̩ n'est pas enfant de #current
						if($(this).attr('id') == "current"){					//sinon, on ne veut pas fermer le ul au dessus de nous
							child_open	= false;
						}
					});
					$('li#current').removeClass('active').removeAttr('id');		//et on supprime la classe active
				}

				/* menus actif */
				//-------------
				li_active			= $('li.active',menu);					//on va chercher le niveau de fermeture en fonction du nombre d'active
				depth				= li_active.length;						//profondeur des menus ouverts

				li_active[depth]	= $('li:first',li_active[depth-1]);		//on ajoute un niveau li non actif car on monte dans les niveaux pour rechercher les ul d̩pendants
				depth++;													//on augmente donc la profondeur de 1

				//----------------------------------------------------------------------------------------------------------------------------------------


				/* menus new */
				//-------------
				ul_check_for_depth_new = a_new;								//on assigne le lien clique pour aller chercher les ul au dessus d̩pendants
				depth_new = 0;												//le niveau du nouveau menu est �  0

				for(a=depth;a>0;a--){														//pour chaques niveau active
					if(!ul_check_for_depth_new.hasClass(menu.selector.substr(1))){			//si le ul au dessus n'est pas le moduletable_menu
						ul_check_for_depth_new = ul_check_for_depth_new.parent().parent();	//on remonte d'un niveau d'ul
						depth_new++;														//ce qui permet d'augmenter le niveau du nouveau menu
					}
				}

				//----------------------------------------------------------------------------------------------------------------------------------------

				/* menus a cacher */
				if(child_open){										//si current est encore actif (qu'on a pas encore cliqu̩ sous un autre lien)
					$('ul',old_li_current).slideUp();				//et que le lien cliqu̩ n'est pas enfant de #current
					child_open	= false;							//on ferme le ul ouvert
				}
				for(a=depth; a>=depth_new;a--){
					$(li_active[a]).parent().slideUp();				//ferme le ul parent
					$(li_active[(a-1)]).removeClass('active');		//on enleve la classe active sur les li qui ne sont plus actuel
				}

				/* menus �  ouvrir */
				//------------------
				if(a_new.next().css('display')!='block'){			//si le ul sous le lien cliqu̩ n'est pas affich̩, on ouvre le menu
					$(a_new.next()).slideDown();					//on ouvre le ul suivant le lien
					$(a_new.parent()).addClass('active');			//on affiche la classe active sur le li au dessus du lien cliqu̩
				}

				return false;
			}
		});

	};


})(jQuery);