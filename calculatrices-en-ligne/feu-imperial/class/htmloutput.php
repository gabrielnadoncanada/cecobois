<?PHP
	class HtmlOutput{

		// on affiche des select en fonction des parametres passés
		function select($name_select,$donnees,$donnees_value,$change='',$style=''){
			global $post;

			if($post->action=="print"){


				for($a=0; $a<count($donnees); $a++){
					if($donnees_value[$a]==$post->$name_select){
						$select = $donnees[$a];
					}
				}

			}else{
				$select ="\n";
				$select .= '<select name="'.$name_select.'" id="'.$name_select.'"'.$change.$style.' class="inputbox">';
				$select .="\n";

				for($a=0; $a<count($donnees); $a++){

					$selected="";
					if($donnees_value[$a]==$post->$name_select){
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


		function input($name,$js='',$class){
			global $post;
			if($post->action=="print"){
				echo $post->$name;
			}else{
				echo '<input type="text" name="'.$name.'" value="'.$post->$name.'"'.$js.' class="inputbox'.$class.'" />';
			}

		}

		function radio($name_radio,$donnees,$donnees_value,$change='',$style='',$td_actif=0){
			global $post;

			if($post->action=="print"){
				for($a=0; $a<count($donnees); $a++){
					if($donnees_value[$a]==$post->$name_radio){
						$radio = $donnees[$a];
					}
				}
			}else{
				$radio = "\n";
				for($a=0; $a<count($donnees); $a++){

					$checked="";
					if($donnees_value[$a]==$post->$name_radio){
						$checked=' checked="checked"';
					}

					$phrase	=		'<input type="radio" name="' . $name_radio . '" id="' . $name_radio . $a . '" value="' . $donnees_value[$a] . '"' . $change . $style . ' class="inputradio"' .$checked . ' /><label for="' . $name_radio . $a . '">' . $donnees[$a] . '</label>';

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