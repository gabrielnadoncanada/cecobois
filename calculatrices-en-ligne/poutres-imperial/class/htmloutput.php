<?PHP
	class HtmlOutput{

		// on affiche des select en fonction des parametres passés
		function select($name_select,$donnees,$donnees_value,$change='',$style='',$id_select='',$class=''){
			global $post;

			if($id_select!=''){
				$id_select = ' id="'.$name_select.'"';
			}

			if($post->action=="print"){

				if($class!=""){
					$class = ' class="'.substr($class,1).'"';
				}
				for($a=0; $a<count($donnees); $a++){

					if($donnees_value[$a]==$post->$name_select){
						//echo $donnees_value[$a].'=='.$post->$name_select.'<br />';
						//$select = $post->$name_select.'<br />';
						$select = '<span'.$class.$style.'>'.$donnees[$a].'</span>';
					}
				}

			} else{
				$select ="\n";
				$select .= '<select name="'.$name_select.'"'.$id_select.''.$change.$style.' class="inputbox'.$class.'">';
				$select .="\n";

				for($a=0; $a<count($donnees); $a++){

					$selected="";
					if($donnees_value[$a] == $post->$name_select){
						$selected=' selected="selected"';
					}
					$select .= '<option value="'.$donnees_value[$a].'"'.$selected.'>'.$donnees[$a].'</option>';
					$select .="\n";
				}
				$select .= '</select>';
			}

			if(isset($select)){
				echo $select;
			}
		}


		function input($name,$js=''){
			global $post;
			if($post->action=="print"){
				echo $post->$name;
			}else{
				echo '<input type="text" name="'.$name.'" value="'.$post->$name.'"'.$js.' class="inputbox" />';
			}

		}

		function radio($name_radio,$donnees,$donnees_value,$change='',$style='',$td_actif=0,$id_radio='',$class=''){
			global $post;

			if($class!=''){
				$class	= ' class="'.$class.'"';
			}


			if($post->action=="print"){

				for($a=0; $a<count($donnees); $a++){

					//echo $post->$name_radio.' - '.$donnees[$a].'<br />';
					//if($post->$name_radio){
					if($post->$name_radio == $donnees_value[$a]){
						if($td_actif){
							$radio = '<td><span'.$class.'>'.$donnees[$a].'</span></td>';
						}else{
							$radio = '<span'.$class.'>'.$donnees[$a].'</span>';
						}
					}
				}

			}else{
				$radio = "\n";

				if($id_radio!=''){
					$id_radio	= ' id="'.$name_radio.'"';
				}

				for($a=0; $a<count($donnees); $a++){

					$checked="";
					if($donnees_value[$a]==$post->$name_radio){
						$checked=' checked="checked"';
					}

					$phrase	=		'<input type="radio" name="'.$name_radio . '" id="' . $name_radio . '_' . $donnees_value[$a] . '" value="'.$donnees_value[$a].'"'.$change.$style.' class="inputradio"'.$checked.' /><label for="' . $name_radio . '_' . $donnees_value[$a] . '">' . $donnees[$a] . '</label>';

					if($td_actif){
						$radio	.=	'<td>'.$phrase.'</td>';
					}else{
						$radio .=	'<div class="btn_radio">'.$phrase.'</div>';
					}
					$radio	.=	"\n";
				}

			}
			if(isset($radio)){
				echo $radio;
			}
		}

		function hidden($name){
			global $post;
			echo '<input type="hidden" name="'.$name.'" value="'.$post->$name.'" />';
		}
	}
?>