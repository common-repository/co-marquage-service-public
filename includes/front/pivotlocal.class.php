<?php
namespace Kienso\Comarquage\Front;

use Kienso\Comarquage\Config;
use Kienso\Comarquage\Helpers;

defined( 'ABSPATH' ) || exit;

class Pivotlocal {

	/**
	 * Code du département choisi
	 * @var string
	 */
	public $codeDept = null;

	/**
	 * Code Insee de la ville choisi
	 * @var string
	 */
	public $codeInsee = null;

	/**
	 * Array version of pivotlocal xml
	 * @var array
	 */
	public $pivotLocalArr = [];

	/**
	 * comarquage_pivotlocal constructor
	 */
	function __construct() {
		$this->codeDept = Config::$options->comarquage_global_departement;
		$this->codeInsee = Config::$options->comarquage_global_code_insee;

		$urlXML = Config::SP_PIVOTS . 'communes/' . $this->codeDept . '/' . $this->codeInsee . '.xml';

		$this->pivotLocalArr = $this->xmlParser($urlXML);
	}

	/**
	 *
	 * @param  string	$urlXML		URL of the xml file
	 */
	public function xmlParser($urlXML) {
		$retXmlObj = null;

		$xmlResp = Helpers::download($urlXML);

		if (is_array($xmlResp) && !empty($xmlResp['body']) && $xmlResp['response']['code'] == 200)
			$retXmlObj = simplexml_load_string($xmlResp['body']);

		return $retXmlObj;
	}


	public function getOrganisme($pivotLocal) {
		$retData = [];

		if(isset($this->pivotLocalArr) && !empty($this->pivotLocalArr)) {
			$organismes = $this->pivotLocalArr->xpath('TypeOrganisme[@pivotLocal="'.$pivotLocal.'"]/Organisme');

			foreach ($organismes as $oneOrg) {
				$orgId = $oneOrg['id'];
				$urlXML = Config::SP_PIVOTS . 'organismes/' . $this->codeDept . '/' . $orgId . '.xml';

				$thisXml = $this->xmlParser($urlXML);
				$thisXml['token'] = $this->token();
				array_push($retData, $thisXml);

			}
		} else {
			$retData = null;
		}

		return $retData;
	}

	/**
	 * Generate unique token used for jQuery animation
	 *
	 * @return string
	 **/
	public function token() {
		$token = md5(uniqid(rand(), true));
		return $token;
	}
}
