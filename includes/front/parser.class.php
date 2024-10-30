<?php
namespace Kienso\Comarquage\Front;

use Kienso\Comarquage\Config;
use Kienso\Comarquage\Message;

defined('ABSPATH') || exit();

class Parser
{
    public $output;
    public $url;
    public $groupedTags;
    public $groupedTagsPlu;
    public $orderedTags;
    public $tokenedTags;
    public $pivot_enable;
    public $pivotlocal_class = null;

    function __construct($xmlfile, $type, $categorie)
    {
        $this->pivot_enable = Config::$options->comarquage_global_pivot_enable ? 'pivot' : 'web'; // Pivot mode enable ? // local ou generique
        $this->output = '';

        // Get URL sommaire page

        switch ($categorie) {
            case 'part':
                $page_id = Config::$options->comarquage_global_page_part;
                break;
            case 'pro':
                $page_id = Config::$options->comarquage_global_page_pro;
                break;
            case 'asso':
                $page_id = Config::$options->comarquage_global_page_asso;
                break;
            default:
                $page_id = 0;
                break;
        }

        // Get permalink
        $root_url = get_permalink($page_id);

        // if permalink empty refer to current page
        if ($root_url == false) {
            $this->url = '.';
        }

        $this->url = esc_url(add_query_arg('xml', '', $root_url)) . '=';

        // Get pivotlocal Array
        if ($this->pivot_enable == 'pivot') {
            $this->pivotlocal_class = new Pivotlocal();
        }

        // Init array of ordered tags
        $this->orderedTags = [
            'paragraphe',
            'cas',
            'chapitre',
            'texte',
            'souschapitre',
            'asavoir',
            'anoter',
            'liste',
        ];

        // !! Attention à faire correspondre le premier tableau (singulier) et le second (pluriel)
        $this->groupedTags = ['chapitre', 'ousadresser'];
        $this->groupedTagsPlu = ['chapitres', 'ousadressers'];

        $this->tokenedTags = ['situation', 'cas', 'chapitre', 'image', 'ousadresser', 'groupe'];

        // Prepare XML (post traitment for Paragraphe nodes)
        $file_str = $this->prepareXml($xmlfile);

        // Load XML
        $xml = simplexml_load_string($file_str);
        $data = $this->xmlToArray($xml);

        // Header
        include KIENSO_COMARQUAGE_TEMPLATES . 'models/_header.php';

        // Select the page template needed
        switch ($type) {
            case 'N':
                include KIENSO_COMARQUAGE_TEMPLATES . 'models/noeud.php';
                break;
            case 'F':
                include KIENSO_COMARQUAGE_TEMPLATES . 'models/fiche.php';
                break;
            case 'R':
                include KIENSO_COMARQUAGE_TEMPLATES . 'models/r.php';
                break;
            default:
                include KIENSO_COMARQUAGE_TEMPLATES . 'models/' . $type . '.php';
                break;
        }

        // Footer
        include KIENSO_COMARQUAGE_TEMPLATES . 'models/_footer.php';
    }

    /**
     * Include a template
     *
     * @param string $balise_name
     * @param array $data
     *
     * @return string
     **/
    function template($balise_name, $data, $opt = [])
    {
        // Remove accents ! :(
        $balise_name = remove_accents($balise_name);
        $balise_name = str_replace(':', '/', $balise_name);

        // Path and URI
        $file = KIENSO_COMARQUAGE_TEMPLATES . 'balises/' . $balise_name . '.php';
        $url = $this->url;

        if (
            $this->pivot_enable == 'pivot' &&
            $this->pivotlocal_class !== null &&
            in_array($balise_name, ['ousadresser'])
        ) {
            if (
                isset($data[0]['ousadresser']['attributes']['type']) &&
                $data[0]['ousadresser']['attributes']['type'] == 'Local personnalisé sur SP'
            ) {
                $pivotlocal_name = $data[0]['ousadresser']['children']['pivotlocal'][0]['text'];
                $pivotlocal_data = $this->pivotlocal_class->getOrganisme($pivotlocal_name);
            }
        }

        // Check if file exist
        if (!file_exists($file)) {
            if (WP_DEBUG) {
                echo 'not exist : ' . $file . '<br>';
            }
            return '';
        }

        // buffer the output
        ob_start();
        include $file;
        return ob_get_clean();
    }

    /**
     * Generate unique token used for jQuery animation
     *
     * @return string
     **/
    public function token()
    {
        $token = md5(uniqid(rand(), true));
        return $token;
    }

    /**
     * Parse the array and call templates
     **/
    public function parse($data)
    {
        $tmp_output = '';
        $opt = ['context' => 'content'];

        if (!is_array($data)) {
            return;
        }

        if (isset($data['children'])) {
            foreach ($data['children'] as $balise_name => $val) {
                if (
                    !is_numeric($balise_name) &&
                    !in_array($data['name'], $this->orderedTags) &&
                    !in_array($data['name'], $this->groupedTagsPlu)
                ) {
                    $tmp_output .= $this->template($balise_name, $val, $opt);
                } else {
                    $tmp_output .= $this->parse_not_children($balise_name, $val);
                }
            }
        }

        print $tmp_output;
    }

    /**
     * Parse the array and call templates
     **/
    public function parse_not_children($balise_name, $data_direct)
    {
        $opt = ['context' => 'content'];
        $tmp_output = '';

        if (!is_array($data_direct)) {
            return;
        }

        if (is_numeric($balise_name)) {
            foreach ($data_direct as $b_key => $b_val) {
                $this->parse_not_children($b_key, $b_val);
            }
        } elseif (in_array($balise_name, $this->groupedTagsPlu)) {
            $arr_key = array_keys($this->groupedTagsPlu, $balise_name, 1);
            $b_key = $this->groupedTags[$arr_key[0]];

            $tmp_output .= $this->template($b_key, $data_direct, $opt);
        } else {
            $tmp_output .= $this->template($balise_name, $data_direct, $opt);
        }

        print $tmp_output;
    }

    /**
     * Directly call a template (Use for node call in page template)
     *
     * @param array $data
     * @param string $template_name
     *
     * @return print output
     **/
    public function callRoot($data, $model_name)
    {
        $tmp_output = '';
        $opt = ['context' => 'root'];

        if (isset($data['children'][$model_name])) {
            $tmp_output .= $this->template($model_name, $data['children'][$model_name], $opt);
        }

        print $tmp_output;
    }

    /**
     * Clean <Paragraphe> Elements in XML
     *
     * @param string $file - File path
     *
     * @return string
     **/
    public function prepareXml($file)
    {
        $file_str = file_get_contents($file);

        $search = [
            '/<Paragraphe>([\s\S]*?)<\/Paragraphe>/',
            '/<MiseEnEvidence>([\s\S]*?)<\/MiseEnEvidence>/',
            '/<Valeur>([\s\S]*?)<\/Valeur>/',
            '/<Expression>([\s\S]*?)<\/Expression>/',
            '/<LienInterne LienPublication="([\s\S]*?)" [\s\S]*?>([\s\S]*?)<\/LienInterne>/',
            '/<LienExterne URL="([\s\S]*?)">([\s\S]*?)<\/LienExterne>/',
            '/<LienIntra LienID="([\s\S]*?)" [\s\S]*?>([\s\S]*?)<\/LienIntra>/',
        ];
        $replace = [
            '<Paragraphe><![CDATA[$1]]></Paragraphe>',
            '<span class="miseenevidence">$1</span>',
            '<span class="valeur">$1</span>',
            '<span class="expression">$1</span>',
            '<a href="' . $this->url . '$1">$2</a>',
            '<a href="' . '$1" target="_blank">$2</a>',
            '<a href="' . $this->url . '$1">$2</a>',
        ];

        // Replace element in <Paragraphe> with html tags
        $file_str = preg_replace($search, $replace, $file_str);

        return $file_str;
    }

    /**
     * Reprise de la fonction "fluxXmlObjToArr" du plugin de comarquage SPIP
     * https://github.com/ipeos-and-co/spip_comarquagev3/blob/master/comarquage_fonctions.php
     *
     * @param object $obj
     * @param bool or array $utiliser_namespace
     *
     * @return array
     **/
    public function xmlToArray($obj, $level = 0, $parentName = '')
    {
        $tableau = [];

        if (is_object($obj)) {
            $name = strtolower((string) $obj->getName());
            $text = trim((string) $obj);

            $children = [];
            $attributes = [];

            /* Attributes
             ---------------------------------------------------------------- */
            $objAttributes = $obj->attributes();
            foreach ($objAttributes as $attributeName => $attributeValue) {
                $attribName = strtolower(trim((string) $attributeName));
                $attribVal = trim((string) $attributeValue);
                $attributes[$attribName] = $attribVal;
            }

            /* Childrens
             ---------------------------------------------------------------- */
            $level++; // Incremente level before next call

            // DC Namespace at Root
            if ($level == 1) {
                $objChildren = $obj->children('dc', true);
                foreach ($objChildren as $childName => $child) {
                    $childName = 'dc:' . strtolower((string) $childName);
                    $children[$childName][] = $this->xmlToArray($child, $level, $childName);
                }
            }

            // Global Namespace
            $objChildren = $obj->children();
            $prev_childName = null;
            foreach ($objChildren as $childName => $child) {
                $childName = strtolower((string) $childName);

                if (in_array($childName, $this->groupedTags)) {
                    if ($prev_childName != $childName) {
                        $arr_key = array_keys($this->groupedTags, $childName, 1);
                        $b_key = $this->groupedTagsPlu[$arr_key[0]];
                        $prev_group = &$children[][$b_key];
                    }

                    $prev_group[][$childName] = $this->xmlToArray($child, $level, $childName);
                } else {
                    // Call next level
                    if (in_array($parentName, $this->orderedTags)) {
                        $children[][$childName][] = $this->xmlToArray($child, $level, $childName);
                    } else {
                        $children[$childName][] = $this->xmlToArray($child, $level, $childName);
                    }
                }
                $prev_childName = $childName;
            }

            // To search : 'En France'

            $tableau = [
                'name' => $name,
            ];
            if (in_array($name, $this->tokenedTags)) {
                $tableau['token'] = $this->token();
            }
            if (strlen($text) > 0) {
                $tableau['text'] = $text;
            }
            if ($attributes) {
                $tableau['attributes'] = $attributes;
            }
            if ($children) {
                $tableau['children'] = $children;
            }
        }

        return $tableau;
    }
}
