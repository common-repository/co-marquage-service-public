<?php
namespace Kienso\Comarquage;

defined( 'ABSPATH' ) || exit;

use WP_Error;

Class Helpers {


    /**
	 * Download from url
	 * @param  string $url url of the content to get
	 * @param boolean $stream_to_file should we store content to a tmp file
	 * @return string path of tmp file / wp_error
	 */
	public static function download( $url = '', $stream_to_file = false ) {

		if(empty($url)) return new WP_Error( 'error', 'Url is empty' );

        //  Load file env
        require_once(ABSPATH . 'wp-admin/includes/file.php');

		$http = new \WP_Http();
		$args = [
			'timeout'  => 600,
			'reject_unsafe_urls' => true,
			'sslverify' => false
		];

        // Store to a temp file
        if($stream_to_file) {
            $url_filename = basename( parse_url( $url, PHP_URL_PATH ) );
            $args['stream'] = true;
            $args['filename'] = wp_tempnam( $url_filename );
        }

		return $http->get( $url, $args );

		// if( is_wp_error($http_result) ) return $http_result;
		// else return $http_result['filename'];
	}

    /**
     * Create a select html tag with pages list
     * @param  int $id of the current page
     * @return string html content
     */
    public static function pages_select($id) {

        $args = array(
            'post_type' => 'page',
            'posts_per_page' => '-1',
            'orderby' => 'title',
            'order'   => 'ASC',
        );

        $pages = new \WP_Query( $args );

        echo '<option value="0"> Aucune </option>';

        // The Loop
        if ( $pages->have_posts() ) {
            while ( $pages->have_posts() ) {
                $pages->the_post();
                $page_id = get_the_id();
                echo '<option value="' . $page_id . '"';
                if ( $page_id == $id ) echo ' selected ';
                echo '>';
                echo get_the_title();
                echo '</option>';
            }
            wp_reset_postdata();
        }
    }

    /**
    * Delete a directory empty or not
    * @param  string $dir path of the directory
    * @return boolean return if success
    */
    public static function delete_directory($dir) {
        if (!file_exists($dir)) return true;
        if (!is_dir($dir)) return unlink($dir);
        foreach (scandir($dir) as $item) {
            if ($item == '.' || $item == '..') continue;
            if (!Helpers::delete_directory($dir . DIRECTORY_SEPARATOR . $item)) return false;
        }
        return rmdir($dir);
    }
}
