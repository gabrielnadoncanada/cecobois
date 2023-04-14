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
		function input($name,$js=''){
			global $post;
			if($post->action=="print"){
				echo $post->$name;
			}else{
				echo '<input type="text" name="'.$name.'" value="'.$post->$name.'"'.$js.' class="inputbox" />';
			}
			
		}
		
		function hidden($name){
			global $post;
			echo '<input type="hidden" name="'.$name.'" value="'.$post->$name.'" />';
		}
	}
?>