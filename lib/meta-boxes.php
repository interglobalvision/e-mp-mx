<?php

/* Get post objects for select field options */
function get_post_objects( $query_args ) {
$args = wp_parse_args( $query_args, array(
    'post_type' => 'post',
) );
$posts = get_posts( $args );
$post_options = array();
if ( $posts ) {
    foreach ( $posts as $post ) {
        $post_options [ $post->ID ] = $post->post_title;
    }
}
return $post_options;
}


/**
 * Include and setup custom metaboxes and fields.
 *
 * @category YourThemeOrPlugin
 * @package  Metaboxes
 * @license  http://www.opensource.org/licenses/gpl-license.php GPL v2.0 (or later)
 * @link     https://github.com/WebDevStudios/CMB2
 */

/**
 * Hook in and add metaboxes. Can only happen on the 'cmb2_init' hook.
 */
add_action( 'cmb2_init', 'igv_cmb_metaboxes' );
function igv_cmb_metaboxes() {

  // Start with an underscore to hide fields from custom fields list
  $prefix = '_igv_';

  /**
   * Metaboxes declarations here
   * Reference: https://github.com/WebDevStudios/CMB2/blob/master/example-functions.php
   */

  $post_meta = new_cmb2_box( array(
    'id'            => $prefix . 'metabox',
    'title'         => __( 'Post Metabox', 'cmb2' ),
    'object_types'  => array( 'post', ), // Post type
  ) );

  $post_meta->add_field( array(
    'name'       => __( 'Próximo', 'cmb2' ),
    'desc'       => __( 'Si este libro está próximo a salir marca este campo', 'cmb2' ),
    'id'         => $prefix . 'if_forthcoming',
    'type'       => 'checkbox',
  ) );

  $post_meta->add_field( array(
    'name'       => __( 'Fecha de lanzamiento', 'cmb2' ),
    'desc'       => __( 'Fecha de lanzamiento de este libro. Puede ser una fecha futura', 'cmb2' ),
    'id'         => $prefix . 'release_date',
    'type'       => 'text_date',
  ) );

}
?>
