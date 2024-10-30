<?php
foreach ($data as $bloc_key => $bloc_anoter) {
	echo '<div class="bloc-anoter">';

	foreach($bloc_anoter['children'] as $key => $bloc_anoter_child ) {
		foreach ($bloc_anoter_child as $balise_name => $balise_value) {
			switch ($balise_name) {
				case 'titre':
					echo '<p class="bloc-anoter-title">';
					include(KIENSO_COMARQUAGE_DIR_ASSETS . "icons/pencil.svg");
					echo '&nbsp;' .$balise_value[0]['text'].'</p>';
					break;
				case 'paragraphe':
					echo '<p class="bloc-paragraphe bloc-anoter-content">'.$balise_value[0]['text'].'</p>';
					break;
				default:
					if(isset($balise_value[0]['text'])) echo '<p>'.$balise_value[0]['text'].'</p>';
					break;
			}
		}
	}
	echo '</div>';
}