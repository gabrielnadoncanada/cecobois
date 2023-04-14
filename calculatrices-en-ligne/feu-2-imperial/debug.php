<?PHP
	$debug_sortie = '';
	
	$debug_sortie .= '<div id="debug">';

		$debug_sortie .= '<table border="1">';
			$debug_sortie .= '<tr>';
				$debug_sortie .= '<td class="titre">D</td>';
				$debug_sortie .= " \n";
				$debug_sortie .= '<td class="titre">B</td>';
				$debug_sortie .= " \n";
				$debug_sortie .= '<td class="titre">KL_B</td>';
				$debug_sortie .= " \n";
				$debug_sortie .= '<td class="titre">f</td>';
				$debug_sortie .= " \n";
				$debug_sortie .= '<td class="titre">drf</td>';
				$debug_sortie .= " \n";
			$debug_sortie .= '</tr>';
			
			$debug_sortie .= '<tr>';
				$debug_sortie .= '<td>'.$D.'</td>';
				$debug_sortie .= " \n";
				$debug_sortie .= '<td>'.$B.'</td>';
				$debug_sortie .= " \n";
				$debug_sortie .= '<td>'.$KL_B.'</td>';
				$debug_sortie .= " \n";
				$debug_sortie .= '<td>'.$f.'</td>';
				$debug_sortie .= " \n";
				$debug_sortie .= '<td>'.$output->drf.'</td>';
				$debug_sortie .= " \n";
			$debug_sortie .= '</tr>';
			
		$debug_sortie .= '</table>';
	

	//-------------------------------------------------------------------------------------------
	
	
	$debug_sortie .= '<div class="clr"></div>';
	
	$debug_sortie .= '</div>';
	
	echo $debug_sortie;

?>