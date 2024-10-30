<?php
if(!current_user_can('manage_options')) wp_die(__('You do not have sufficient permissions to access this page.'));
defined( 'ABSPATH' ) || exit;

use \Kienso\Comarquage\Config;
use \Kienso\Comarquage\Message;
use \Kienso\Comarquage\Helpers;
use \Kienso\Comarquage\Admin\Requires;

?>

<style>
.badgenumber { display: inline-block; background: #bbb; color:#fff; border-radius: 15px; width:23px; height:23px; text-align: center; line-height: 23px; font-size:16px; font-weight: normal; }
.co-block { padding:20px; background: #fff; margin:15px 0; width:auto; border:1px solid #ddd; }
.co-block .title { font-size: 17px; }
</style>

<div class="wrap">

	<h2 style="margin-bottom:20px;">
		Co-marquage de Service-public.fr : R&eacute;glages<br>
	</h2>

	<?php
	if( isset($_POST['action']) && $_POST['action'] == 'comarquage-xml-update') {
		Kienso\Comarquage\Updater\Updater::run();
		Message::add('success', 'Les données de Service-Public sont maintenant à jour.');
	}
	?>

	<?php
		Message::display();
	?>

	<h2 class="nav-tab-wrapper" style="margin:10px 0 30px;">
		<a href="#comarquage-tab-general" class="nav-tab nav-tab-active">Installation</a>
		<a href="#comarquage-tab-options" class="nav-tab">Options</a>
		<a href="#comarquage-tab-debug" class="nav-tab">Support</a>
	</h2>

	<form method="post" action="options.php">

		<?php
		settings_fields('comarquage');
		do_settings_sections( 'comarquage' );

		?>

		<input type="hidden" name="comarquage_update_time[part]" value="<?php echo Config::$categories_update_time['part']; ?>">
		<input type="hidden" name="comarquage_update_time[pro]" value="<?php echo Config::$categories_update_time['pro']; ?>">
		<input type="hidden" name="comarquage_update_time[asso]" value="<?php echo Config::$categories_update_time['asso']; ?>">

		<div class="tab-content" id="comarquage-tab-general">

			<table class="form-table">
				<tr valign="top">
					<th scope="row"><span class="badgenumber">1</span> Pages de sommaire</th>
					<td>
						<p> Pour afficher les informations provenant de service-public.fr, vous devez configurer les pages de sommaire pour chacun des profils</p>
						<div class="co-block">
							<p class="title">Particuliers</p>
							<label>Page de sommaire : </label>
							<select name="comarquage_global_page_part" id="comarquage_global_page_part">
								<?php Helpers::pages_select( Config::$options->comarquage_global_page_part ); ?>
							</select>
							<p>Insérer le code court suivant dans la page choisie : <code>[comarquage category="part"]</code></p>
						</div>

						<div class="co-block">
							<p class="title">Associations</p>
							<label>Page de sommaire : </label>
							<select name="comarquage_global_page_asso" id="comarquage_global_page_asso">
								<?php Helpers::pages_select(Config::$options->comarquage_global_page_asso); ?>
							</select>
							<p>Insérer le code court suivant dans la page choisie : <code>[comarquage category="asso"]</code></p>
						</div>

						<div class="co-block">
							<p class="title">Entreprises</p>
							<label>Page de sommaire : </label>
							<select name="comarquage_global_page_pro" id="comarquage_global_page_pro">
								<?php Helpers::pages_select(Config::$options->comarquage_global_page_pro); ?>
							</select>
							<p>Insérer le code court suivant dans la page choisie : <code>[comarquage category="pro"]</code></p>
						</div>

					</td>
				</tr>

				<tr valign="top">
					<th scope="row"><span class="badgenumber">2</span> Afficher une fiche</th>
					<td>
						<p>Depuis les pages sommaire, vos visiteurs pourront naviguer à travers les informations de service-public.fr</p>
						<p>Si vous souhaitez insérer une fiche en particulier dans une page, vous pouvez utiliser un code court. </p><br>

						<p>Par exemple pour la fiche "Mise à jour du Livret de famille" (qui concerne donc les particuliers), </p>
						<p>que l'on trouve à l'url suivante sur service public : https://www.service-public.fr/particuliers/vosdroits/<span style="color:blue">F18910</span> </p>
						<p>Vous utiliserez le code suivant :
							<code>[comarquage category="part" xml="F18910"]</code>
						</p>
					</td>
				</tr>

				<tr valign="top">
					<th scope="row"><span class="badgenumber">3</span> Etablissements locaux</th>
					<td>
						<fieldset>
							<p>L'activation des informations locales permet d'associer les d&eacute;marches aux &eacute;tablissements locaux (correspondant au code INSEE choisi). </p><p class="description">Mairie, Service des Imp&ocirc;ts, Tribunal de commerce, ... </p>
							<p>&nbsp;</p>
							<p>
								<label for="comarquage_global_pivot_enable"><input name="comarquage_global_pivot_enable" type="checkbox" id="comarquage_global_pivot_enable" value="1" <?php checked( 1, get_option( 'comarquage_global_pivot_enable' ) ); ?>> Activer les informations locales</label>
							</p>

							<div id="info-locale" class="pivot-close co-block">
								<p class="title">Ma commune</p>
								<p>
									<label for="comarquage_global_departement">D&eacute;partement :
										<select name="comarquage_global_departement" id="comarquage_global_departement">
											<?php
											if (empty( Config::$options->comarquage_global_departement ) ) echo '<option value=""> Choisir un d&eacute;partement</option>';
											foreach( Config::$code_departements as $code => $name ) {
												$selected = ($code == Config::$options->comarquage_global_departement) ? 'selected' : '';
												echo '<option value="' . $code . '" ' . $selected . '>' . $code . ' - ' . $name . '</option>';
											} ?>
										</select>
									</label>
								</p>

								<p><label for="comarquage_global_code_insee">
									Code INSEE :
									<input name="comarquage_global_code_insee" type="text" id="comarquage_global_code_insee" value="<?php echo Config::$options->comarquage_global_code_insee; ?>" class="regular-text"> (ex: 77491)
								</label></p>
								<p style="text-align: right; margin-top:10px;"><a href="http://www.insee.fr/fr/methodes/nomenclatures/cog/" target="_blank"> Liste des codes g&eacute;ographiques INSEE </a></p>
							</div>
						</fieldset>
					</td>
				</tr>

				<tr valign="top">
					<th scope="row"><span class="badgenumber">4</span> Vérifier vos coordonnées </th>
					<td>
						<p> Les coordonnées des &eacute;tablissements sont enregistrées sur l'annuaire des services public. </p>
						<p> Vérifier et modifier les coordonnées d'une Mairie en allant sur : <a href="https://lannuaire.service-public.fr/" target="_blank"> Annuaire de l'administration </a></p><p>Une fois sur la page correspondant &agrave; l'&eacute;tablissement, demandez la modification des coordonnées en cliquant sur "Ecrire à la rédaction".</p><br>
					</td>
				</tr>

			</table>
			<?php submit_button(); ?>
		</div>

		<div class="tab-content ui-tabs-hide" id="comarquage-tab-options">
			<table class="form-table">
				<tr valign="top">
					<th scope="row">General</th>
					<td>
						<fieldset>
							<label for="comarquage_global_css_enable"><input name="comarquage_global_css_enable" type="checkbox" id="comarquage_global_css_enable" value="1" <?php checked( 1, get_option( 'comarquage_global_css_enable' ) ); ?>> Charger le CSS du plugin</label><br>

							<label for="comarquage_global_js_leaflet_enable"><input name="comarquage_global_js_leaflet_enable" type="checkbox" id="comarquage_global_js_leaflet_enable" value="1" <?php checked( 1, get_option( 'comarquage_global_js_leaflet_enable' ) ); ?>> Charger leafletJS et son CSS</label>
							<p class="description"> <a href="https://leafletjs.com/">LeafletJS</a> est le système de carte utilisé pour la localisation. Utilisé uniquement si vous activez les informations locales.</p><br>

							<label for="comarquage_global_poweredby"><input name="comarquage_global_poweredby" type="checkbox" id="comarquage_global_poweredby" value="1" <?php checked( 1, get_option( 'comarquage_global_poweredby' ) ); ?>> Afficher le lien "baseo.io" (Ce n'est pas une obligation mais c'est sympa)</label><br>
						</fieldset>
					</td>
				</tr>

				<tr valign="top">
					<th scope="row">Debug</th>
					<td>
						<p>
							<label for="comarquage_debug_enable"><input name="comarquage_debug_enable" type="checkbox" id="comarquage_debug_enable" value="1" <?php checked( 1, get_option( 'comarquage_debug_enable' ) ); ?>> Activer le mode debug</label>
						</p>
					</td>
				</tr>
			</table>
			<?php submit_button(); ?>

		</div>
		</form>


	<div class="tab-content ui-tabs-hide" id="comarquage-tab-debug">
		<table class="form-table">
			<tr valign="top">
				<td style="vertical-align:top;">
					<h3>Donn&eacute;es issues de service-public.fr  </h3>

					<p><u>
						Derni&egrave;re mise à jour des fichiers XML du comarquage :
					</u></p>
					<p>
						particulier : <?= (!empty(Config::$options->comarquage_update_time['part'])) ? date('Y-m-d H:i', Config::$options->comarquage_update_time['part']) : ''; ?>
					</p>
					<p>
						professionnel : <?= (!empty(Config::$options->comarquage_update_time['pro'])) ? date('Y-m-d H:i', Config::$options->comarquage_update_time['pro']) : ''; ?>
					</p>
					<p>
						association : <?= (!empty(Config::$options->comarquage_update_time['asso'])) ? date('Y-m-d H:i', Config::$options->comarquage_update_time['asso']) : ''; ?>
					</p>
					<br>
					<form method="post">
				    	<input type="hidden" name="action" value="comarquage-xml-update">
						<!-- DISABLED -->
				    	<!-- <input type="submit" class="button" value="Mettre à jour les donn&eacute;es provenant de service-public.fr"> -->
				    </form>
					</td>
					<td rowspan="2" style="vertical-align:top;">
						<div style="background:#fff; float:right; border:1px solid #ccc; max-width:350px;">
							<div style="background-color:#fff; padding: 10px 30px;">
								<p><img src="<?php echo KIENSO_COMARQUAGE_URL . '/assets/images/logo.png'; ?>" style="width:200px;"></p>
							</div>
							<div style="background-color:#eee; padding: 20px 30px;">
								<p> Développé par l'équipe de baseo.  </p>
								<p style="margin-top:20px;">
									<a target="_blank" href="<?= $plugin_page_url ?>" class="button-primary">
										Plus d'informations
									</a>
								</p>
							</div>
						</div>
					</td>
				</tr>
				<tr valign="top">
					<td colspan="2">
						<h3>Support </h3>
						<p>Vous rencontrer un problème, un bug ou souhaitez soumettre une idée d'amélioration :</p><br>
						<a href="https://wordpress.org/support/plugin/co-marquage-service-public/" class="button-secondary" target="_blank"> Forum du support </a>
					</td>
				</tr>
				<tr valign="top">
					<td colspan="2">
						<h3>Informations pour le support </h3>
						<p> Dans le cadre d'un support direct (pas sur les forums), copier les informations ci-dessous et nous les envoyer.</p>
						<?php
						Requires::display();
						?>
					</td>
				</tr>
			</table>
		</div>




		<script type="text/javascript">
		// Manage Options tabs
		jQuery(document).ready(function() {

			// Locale info block
			jQuery('#info-locale').hide();

			if(jQuery('#comarquage_global_pivot_enable').is(":checked")) jQuery('#info-locale').slideDown().removeClass('pivot-close').addClass('pivot-open');

			jQuery('#comarquage_global_pivot_enable').click(function(){
				if(jQuery("#info-locale").hasClass('pivot-close')) jQuery("#info-locale").slideDown().removeClass('pivot-close').addClass('pivot-open');
				else jQuery("#info-locale").slideUp().removeClass('pivot-open').addClass('pivot-close');
			});

			//
			jQuery(".nav-tab").click(function(event){
				event.preventDefault();
				jQuery(".tab-content").addClass('ui-tabs-hide');
				var tabname = jQuery(this).attr('href');
				jQuery(tabname).removeClass('ui-tabs-hide');
				jQuery(".nav-tab").removeClass('nav-tab-active');
				jQuery(this).addClass('nav-tab-active');
			});
		});
		</script>

	</div>
