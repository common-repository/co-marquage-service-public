<?php
namespace Kienso\Comarquage\Front;

use Kienso\Comarquage\Config;
use Kienso\Comarquage\Message;
use Kienso\Comarquage\Admin\Options;
use Kienso\Comarquage\Updater\Updater;

use Kienso\Comarquage\Front\Search;

defined( 'ABSPATH' ) || exit;

class Display {

	var $pivot_enable; // Is local pivot mode enable
	var $is_home; // Is the comarquage Home page ?

	var $xml_file_name;
	var $xml_file_path;

	function __construct() {
		add_shortcode('comarquage', [&$this,'shortcode'] );
	}

	function display( $category = 'part', $xml = '' ) {

		Message::display();

		// Get xml page number (from shortcode or from url)
		$xml_name = '';
		if( !empty($xml) ) $xml_name = $xml;
		if( isset($_GET["xml"]) ) $xml_name = sanitize_text_field( $_GET["xml"] );

		$type = ( !empty($xml_name) )? $xml_name[0] : null;
		Message::add_debug('info', Config::$categories_dir[$category]);

		// Define and test the DIR for XML (Part, pro or asso)
		if( !is_dir( Config::$categories_dir[$category]) ) {

			Message::add_debug('info', Config::$categories_dir[$category]);
			Updater::run(); // Launch updater. It download xml if needed

			Message::add('info','Récupération des donn&eacute;es provenant de service-public.fr en cours. Veuillez actualiser la page dans un instant.');
			return;
		}

		// If is comarquage home page
		$this->is_home = empty($xml_name) || in_array($xml_name, ['Associations', 'Particuliers', 'Professionnels']) ? true : false;

		// Search
		if ( (isset($_POST['action']) && $_POST['action'] == 'cosearch') ) {

			new Search($category);

		} else {

			// XML file URI (fiche de service public / accueil local)
			$this->xml_file_name = $this->is_home ? "accueil.xml" : $xml_name . ".xml";
			$this->xml_file_path = $this->is_home ? Config::$categories_dir[$category] . $this->xml_file_name : Config::$categories_dir[$category] . $this->xml_file_name;

			if($this->is_home) $type = 'accueil-'.$category;
			if($xml_name == 'servicesEnLigne') $type = 'servicesEnLigne';
			if($xml_name == 'commentFaireSi') $type = 'commentFaireSi';
			if($xml_name == 'questionsReponses') $type = 'questionsReponses';

			// Test if XML exist
			if( !file_exists( $this->xml_file_path ) ) {
				Message::add('error','Impossible de trouver la fiche : ' . $this->xml_file_name);
				return;
			}

			// Load & Display XML
			$Parser = new Parser( $this->xml_file_path , $type, $category );

		}
		Message::display();
	}

	/**
	* Shortcode for comarquage
	* @param  array $atts shortcode options
	* @return string the html to display
	*/
	public function shortcode( $atts ) {
		extract(shortcode_atts(array(
			'category' 	=> 'part',
			'xml' 	=> '',
		), $atts));
		ob_start();

		// Avoid Cross scripting
		$xml = esc_attr($xml);
		$category = esc_attr($category);

		// Test if category is valid
		if( !in_array($category, ['part', 'pro', 'asso']))  {
			Message::add('info','Catégorie invalide. Utilisez [comarquage category="part/pro/asso"]');
			return;
		}

		// Run comarquage
		?>
		<div id="comarquage" class="comarquage espace-<?php echo $category; ?>">
			<?php
			\Kienso\Comarquage\Front\Display::display($category, $xml)
			?>
		</div>
		<?php
		return ob_get_clean();
	}
}
