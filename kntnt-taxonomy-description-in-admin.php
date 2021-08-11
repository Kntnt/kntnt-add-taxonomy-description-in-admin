<?php

/**
 * @wordpress-plugin
 * Plugin Name:       Kntnt Taxonomy Description In Admin
 * Plugin URI:        https://www.kntnt.com/
 * Description:       Adds taxonomy description (if available) to wp-admin/edit-tags.php.
 * Version:           1.0.0
 * Author:            Thomas Barregren
 * Author URI:        https://www.kntnt.com/
 * License:           GPL-3.0+
 * License URI:       http://www.gnu.org/licenses/gpl-3.0.txt
 */


namespace Kntnt\Site_Specific_Code;

defined( 'ABSPATH' ) || die;

add_action( 'admin_init', function () {
	global $pagenow;
	if ( 'edit-tags.php' == $pagenow ) {
		$taxonomies = get_taxonomies( [ 'show_ui' => true ], 'objects' );
		foreach ( $taxonomies as $taxonomy ) {
			add_action( "{$taxonomy->name}_pre_add_form", function ( $taxonomy_name ) use ( $taxonomy ) {
				if ( $description = sanitize_text_field( $taxonomy->description ) ) {
					echo "<p>$description</p>";
				}
			} );
		}
	}
} );
