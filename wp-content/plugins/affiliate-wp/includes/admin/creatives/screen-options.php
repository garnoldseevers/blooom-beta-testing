<?php

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) exit;

/**
 * Add per page screen option to the Creatives list table
 *
 * @since 1.7
 */
function affwp_creatives_screen_options() {

	$screen = get_current_screen();

	if ( $screen->id !== 'affiliates_page_affiliate-wp-creatives' ) {
		return;
	}

	add_screen_option(
		'per_page',
		array(
			'label'   => __( 'Number of creatives per page:', 'affiliate-wp' ),
			'option'  => 'affwp_edit_creatives_per_page',
			'default' => 30,
		)
	);

	do_action( 'affwp_creatives_screen_options', $screen );

}
add_action( 'load-affiliates_page_affiliate-wp-creatives', 'affwp_creatives_screen_options' );

/**
 * Per page screen option value for the Creatives list table
 *
 * @since  1.7
 * @param  bool|int $status
 * @param  string   $option
 * @param  mixed    $value
 * @return mixed
 */
function affwp_creatives_set_screen_option( $status, $option, $value ) {

	if ( 'affwp_edit_creatives_per_page' === $option ) {
		return $value;
	}

	return $status;

}
add_filter( 'set-screen-option', 'affwp_creatives_set_screen_option', 10, 3 );
