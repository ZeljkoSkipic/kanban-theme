<?php
/**
 * Registration logic for the new ACF field type.
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

add_action( 'init', 'acf_field_s_tier_icons' );
/**
 * Registers the ACF field type.
 */
function acf_field_s_tier_icons() {
	if ( ! function_exists( 'acf_register_field_type' ) ) {
		return;
	}

	require_once __DIR__ . '/acf-field-s-tier-icons.php';

	acf_register_field_type( 'acf_field_s_tier_icons' );
}
