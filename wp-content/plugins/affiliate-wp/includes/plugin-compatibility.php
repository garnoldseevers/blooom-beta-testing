<?php

/**
 *  Prevents OptimizeMember from intefering with our ajax user search
 *
 *  @since 1.6.2
 *  @return void
 */
function affwp_optimize_member_user_query( $search_term = '' ) {

	remove_action( 'pre_user_query', 'c_ws_plugin__optimizemember_users_list::users_list_query', 10 );

}
add_action( 'affwp_pre_search_users', 'affwp_optimize_member_user_query' );

/**
 *  Prevents OptimizeMember from redirecting affiliates to the
 *  "Members Home Page/Login Welcome Page" when they log in
 *
 *  @since 1.7.16
 *  @return boolean
 */
function affwp_optimize_member_prevent_affiliate_redirect( $return, $vars ) {

	if ( doing_action( 'affwp_user_login' ) ) {
		$return = false;
	}

	return $return;

}
add_filter( 'ws_plugin__optimizemember_login_redirect', 'affwp_optimize_member_prevent_affiliate_redirect', 10, 2 );

/**
 *  Fixes affiliate redirects when "Allow WishList Member To Handle Login Redirect"
 *  and "Allow WishList Member To Handle Logout Redirect" are enabled in WishList Member
 *
 *  @since 1.7.13
 *  @return boolean
 */
function affwp_wishlist_member_redirects( $return ) {

    $user    = wp_get_current_user();
    $user_id = $user->ID;

    if ( affwp_is_affiliate( $user_id ) ) {
        $return = true;
    }

    return $return;

}
add_filter( 'wishlistmember_login_redirect_override', 'affwp_wishlist_member_redirects' );
add_filter( 'wishlistmember_logout_redirect_override', 'affwp_wishlist_member_redirects' );
