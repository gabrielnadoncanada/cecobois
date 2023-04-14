<?PHP header("content-type: application/x-javascript");?>
	confirm_cache_form=function(){
		var answer = confirm("Si vous modifiez les données, vous perdrez l'affichage des résultats ci-dessous.");
		if (answer){
			cache_form();
		}
		return true;
	}

	cache_form=function(){
		window.location.href='<?PHP echo $_SERVER['HTTP_REFERER'];?>';
	}



