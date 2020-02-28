<?php
/**
 * Plugin Name: List of PDFs Plugin
 * Plugin URI: http://www.mywebsite.com/list-of-pdfs-plugin
 * Description: This will list downloadable pdf files.
 * Version: 1.0
 * Author: Marvin Tubelleza
 * Author URI: http://www.mywebsite.com
 */

add_shortcode( 'listofpdfs', 'list_of_pdfs_files_shortcode' );

function list_of_pdfs_files_shortcode() {
    $pdf_ids = get_posts(
        array(
            'post_type'      => 'attachment',
            'post_mime_type' => 'application/pdf',
            'post_status'    => 'inherit',
            'posts_per_page' => - 1,
            'fields'         => 'ids',
        )
    );
    
    $pdfs = array_map( "wp_get_attachment_url", $pdf_ids );

    $output .= '<ol class="list-of-pdfs">';
    foreach ($pdfs as $pdf) {
        $output .= '<li><a href='.$pdf.' download>'.basename($pdf).'</a></li>';
    }
    $output .= '</ol>';

    return $output;
}
