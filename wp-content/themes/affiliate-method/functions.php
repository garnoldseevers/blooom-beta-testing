<?php

// enqueue the child theme stylesheet

function wp_schools_enqueue_scripts() {
	wp_register_style( 'childstyle', get_stylesheet_directory_uri() . '/style.css'  );
	wp_enqueue_style( 'childstyle' );
	wp_register_script( 'bridge-child-functions', get_stylesheet_directory_uri(). '/js/functions.js' );
	wp_enqueue_script( 'bridge-child-functions');
}
add_action( 'wp_enqueue_scripts', 'wp_schools_enqueue_scripts', 11);

//CUSTOM CODE STARTS

/*
 *
 Affiliate Coding
 *
 */
 
add_action( 'affwp_new_affiliate_bottom', 'bl_affwp_new_affiliate_bottom' );
function bl_affwp_new_affiliate_bottom(){
	?>
	
	<table class="form-table">

			<tr class="form-row form-required">

				<th scope="row">
					<label for="user_name"><?php _e( 'Custom Price', 'affiliate-wp' ); ?></label>
				</th>

				<td>
					<span class="affwp-ajax-search-wrap">
						<input type="text" name="custom_price_low" id="custom_price_low" class="" autocomplete="off" placeholder="eg. 5" value="<?php echo $affilaite_extra_data['custom_price_low'] ?>" />
					</span>
					<p class="description"><?php _e( 'Custom price amount which will be shown based on affiliate. Keep this field blank if you want to keep the default amount.', 'affiliate-wp' ); ?></p>
				</td>
				
				<td>
					<span class="affwp-ajax-search-wrap">
						<input type="text" name="custom_price" id="custom_price" class="" autocomplete="off" placeholder="eg. 19" value="<?php echo $affilaite_extra_data['custom_price'] ?>" />
					</span>
					<p class="description"><?php _e( 'Custom price amount which will be shown based on affiliate. Keep this field blank if you want to keep the default amount.', 'affiliate-wp' ); ?></p>
				</td>
				
				<td>
					<span class="affwp-ajax-search-wrap">
						<input type="text" name="custom_price_high" id="custom_price_high" class="" autocomplete="off" placeholder="eg. 99" value="<?php echo $affilaite_extra_data['custom_price_high'] ?>" />
					</span>
					<p class="description"><?php _e( 'Custom price amount which will be shown based on affiliate. Keep this field blank if you want to keep the default amount.', 'affiliate-wp' ); ?></p>
				</td>

			</tr>

			<tr class="form-row">

				<th scope="row">
					<label for="rate_type"><?php _e( 'Signup Button URL', 'affiliate-wp' ); ?></label>
				</th>

				<td colspan="3">
					<input type="text" name="signup_url" id="signup_url" size="150" />
					<p class="description"><?php _e( 'Site Header Signup Button Custom URL. . Keep this field blank if you want to keep the default URL.', 'affiliate-wp' ); ?></p>
				</td>

			</tr>

			<tr class="form-row">

				<th scope="row">
					<label><?php _e( 'Custom Content for Section 2', 'affiliate-wp' ); ?></label>
				</th>

				<td colspan="3">
					<textarea name="custom_content" id="custom_content" style="width:100%"></textarea>
					<p class="description"><?php _e( 'Custom Content for Section 2. . Keep this field blank if you want to hide this area.', 'affiliate-wp' ); ?></p>
				</td>

			</tr>
			
			<tr class="form-row">

				<th scope="row">
					<label><?php _e( 'Affiliate Slider', 'affiliate-wp' ); ?></label>
				</th>

				<td colspan="3">
					<input type="text" name="affiliate_slider" id="affiliate_slider" class="" value="" autocomplete="off" size="150" />
					<p class="description"><?php _e( 'Custom Content for Affiliate Slider. Keep this field blank if you want to hide this area.', 'affiliate-wp' ); ?></p>
				</td>

			</tr>

			<tr class="form-row">

				<th scope="row">
					<label><?php _e( 'Hide Sections', 'affiliate-wp' ); ?></label>
				</th>

				<td colspan="3">
					<input type="checkbox" name="chk_hide_companies" id="chk_hide_companies" class="" value="T" /><label for="chk_hide_companies">&nbsp;&nbsp;Companies</label> 
					<p class="description"><?php _e( 'Hide selected sections of the affiliate page.', 'affiliate-wp' ); ?></p>
				</td>

			</tr>

		</table>
	<?php
	
}

add_action( 'affwp_insert_affiliate', 'bl_affwp_insert_affiliate', 99, 1 );
function bl_affwp_insert_affiliate( $add ){
	
	if ( empty( $add ) ) {
		
		return false;
	} else {
		
		$args = array(
			'custom_price_low'          => ! empty( $_POST['custom_price_low'] ) ? sanitize_text_field( $_POST['custom_price_low'] ) : '',
			'custom_price'          => ! empty( $_POST['custom_price'] ) ? sanitize_text_field( $_POST['custom_price'] ) : '',
			'custom_price_high'          => ! empty( $_POST['custom_price_high'] ) ? sanitize_text_field( $_POST['custom_price_high'] ) : '',
			'custom_content'     => ! empty( $_POST['custom_content' ] ) ?  stripslashes( $_POST['custom_content'] ) : '',
			'signup_url' => ! empty( $_POST['signup_url'] ) ? sanitize_text_field( $_POST['signup_url'] ) : '',
			'affiliate_slider' => ! empty( $_POST['affiliate_slider'] ) ? stripslashes( sanitize_text_field( $_POST['affiliate_slider'] ) ) : '',
			'chk_hide_companies' => isset( $_POST['chk_hide_companies'] ) ? 'T' : ''
		);

		$new_value = maybe_serialize( $args );
		update_option( 'affwp_affiliate_extra_data_'. $add, $new_value );
	}

	
}

add_action( 'affwp_edit_affiliate_bottom', 'bl_affwp_edit_affiliate_bottom', 11, 1 );
function bl_affwp_edit_affiliate_bottom($affiliate){
	
	$affilaite_extra_data = maybe_unserialize( get_option( 'affwp_affiliate_extra_data_'. $affiliate->affiliate_id) );
	?>
	
	<table class="form-table">

			<tr class="form-row form-required">

				<th scope="row">
					<label for="user_name"><?php _e( 'Custom Price', 'affiliate-wp' ); ?></label>
				</th>

				<td>
					<span class="affwp-ajax-search-wrap">
						<input type="text" name="custom_price_low" id="custom_price_low" class="" autocomplete="off" placeholder="eg. 5" value="<?php echo $affilaite_extra_data['custom_price_low'] ?>"/>
					</span>
					<p class="description"><?php _e( 'Customize low amount on affiliate. Keep this field blank if you want to keep the default amount.', 'affiliate-wp' ); ?></p>
				</td>
				
				<td>
					<span class="affwp-ajax-search-wrap">
						<input type="text" name="custom_price" id="custom_price" class="" autocomplete="off" placeholder="eg. 19" value="<?php echo $affilaite_extra_data['custom_price'] ?>"/>
					</span>
					<p class="description"><?php _e( 'Customize mid amount which will be shown based on affiliate. Keep this field blank if you want to keep the default amount.', 'affiliate-wp' ); ?></p>
				</td>
				
				<td>
					<span class="affwp-ajax-search-wrap">
						<input type="text" name="custom_price_high" id="custom_price_high" class="" autocomplete="off" placeholder="eg. 99" value="<?php echo $affilaite_extra_data['custom_price_high'] ?>"/>
					</span>
					<p class="description"><?php _e( 'Customize high amount which will be shown based on affiliate. Keep this field blank if you want to keep the default amount.', 'affiliate-wp' ); ?></p>
				</td>

			</tr>

			<tr class="form-row">

				<th scope="row">
					<label for="signup_url"><?php _e( 'Signup Button URL', 'affiliate-wp' ); ?></label>
				</th>

				<td colspan="3">
					<input type="text" name="signup_url" id="signup_url" value="<?php echo $affilaite_extra_data['signup_url'] ?>" size="150" />
					<p class="description"><?php _e( 'Site Header Signup Button Custom URL. Keep this field blank if you want to keep the default URL.', 'affiliate-wp' ); ?></p>
				</td>

			</tr>

			<tr class="form-row">

				<th scope="row">
					<label for="custom_content"><?php _e( 'Custom Content for Section 2', 'affiliate-wp' ); ?></label>
				</th>

				<td colspan="3">
					<textarea name="custom_content" id="custom_content" style="width:100%"><?php echo $affilaite_extra_data['custom_content'] ?></textarea>
					<p class="description"><?php _e( 'Custom Content for Section 2. Keep this field blank if you want to hide this area.', 'affiliate-wp' ); ?></p>
				</td>

			</tr>
			
			
			<tr class="form-row">

				<th scope="row">
					<label for="affiliate_slider"><?php _e( 'Affiliate Slider', 'affiliate-wp' ); ?></label>
				</th>

				<td colspan="3">
					<input type="text" name="affiliate_slider" id="affiliate_slider" class="" value="<?php echo $affilaite_extra_data['affiliate_slider'] ?>" autocomplete="off" size="150" />
					<p class="description"><?php _e( 'Custom Content for Affiliate Slider. Keep this field blank if you want to hide this area.', 'affiliate-wp' ); ?></p>
				</td>

			</tr>
			
			<tr class="form-row">

				<th scope="row">
					<label><?php _e( 'Hide Sections', 'affiliate-wp' ); ?></label>
				</th>

				<td colspan="3">
					<input type="checkbox" name="chk_hide_companies" id="chk_hide_companies" class="" value="T" <?php echo ($affilaite_extra_data['chk_hide_companies']=='T' ? 'checked' : '');?> /><label for="chk_hide_companies">&nbsp;&nbsp;Companies</label> 
					<p class="description"><?php _e( 'Hide selected sections of the affiliate page.', 'affiliate-wp' ); ?></p>
				</td>

			</tr>

		</table>
	<?php
	
}

add_action( 'affwp_update_affiliate', 'bl_affwp_process_update_affiliate', 1, 1 );
function bl_affwp_process_update_affiliate( $data ) {

	if ( empty( $data['affiliate_id'] ) ) {
		return false;
	} else {
		
		$args = array(
			'custom_price_low'          => ! empty( $_POST['custom_price_low'] ) ? sanitize_text_field( $_POST['custom_price_low'] ) : '',
			'custom_price'          => ! empty( $_POST['custom_price'] ) ? sanitize_text_field( $_POST['custom_price'] ) : '',
			'custom_price_high'          => ! empty( $_POST['custom_price_high'] ) ? sanitize_text_field( $_POST['custom_price_high'] ) : '',
			'custom_content'     => ! empty( $_POST['custom_content' ] ) ?  stripslashes( $_POST['custom_content']  ) : '',
			'signup_url' => ! empty( $_POST['signup_url'] ) ? sanitize_text_field( $_POST['signup_url'] ) : '',
			'affiliate_slider' => ! empty( $_POST['affiliate_slider'] ) ? stripslashes( sanitize_text_field( $_POST['affiliate_slider'] ) ) : '',
			'chk_hide_companies' => isset( $_POST['chk_hide_companies'] ) ? 'T' : ''
		);

		$new_value = maybe_serialize( $args );
		update_option( 'affwp_affiliate_extra_data_'. $data['affiliate_id'], $new_value );
	}

}

add_action('wp_head', 'bl_get_affiliate_id');
function bl_get_affiliate_id(){
	
	//if(is_front_page()){
		
		global $wp_query, $wpdb;
		
		//$affliliate_ref_username = get_query_var(affiliate_wp()->tracking->get_referral_var());
		
		// $base = root  url + / + (the referral variable from affiliates wordpress) + /
		// get referral variable (eg ref) in our case "a"
 		$base = get_bloginfo('url').'/'.affiliate_wp()->tracking->get_referral_var().'/';
		//replace $base in current page URL with nothing
		$affliliate_ref_username = str_replace( $base, '', curPageURL() );
		// replace all slashes in the previous result with nothing... so we're left with just parameters?
		$affliliate_ref_username = str_replace( '/', '', $affliliate_ref_username );
		
		// okay so now we explode out any arguments or hashes and choose the 0 index of the resulting array to yield.... Maybe the data afer the first slash was left?
		if(strstr($affliliate_ref_username, '#', true)){
			$r = explode('#', $affliliate_ref_username);
			$affliliate_ref_username =  $r[0];
		}elseif(strstr($affliliate_ref_username, '?', true)){
			$r = explode('?', $affliliate_ref_username);
			$affliliate_ref_username =  $r[0];
		} 
		
	    
		
		$affliliate_ref_username =  ( isset( $affliliate_ref_username ) ) ? $affliliate_ref_username : '';
		
		//if(!empty($affliliate_ref_username)){
			
			$ref_var = $wpdb->get_row('SELECT wp_affiliate_wp_affiliates.affiliate_id, wp_affiliate_wp_affiliates.user_id FROM wp_affiliate_wp_affiliates
		LEFT JOIN wp_users ON wp_affiliate_wp_affiliates.user_id=wp_users.ID where wp_users.user_login = "'.$affliliate_ref_username.'";');
				
			$ref_var =  ( !empty( $ref_var->affiliate_id ) ) ? $ref_var->affiliate_id : '';
			
			if ( isset( $ref_var ) && affwp_is_affiliate( affwp_get_affiliate_user_id( $ref_var ) ) ) {
				$affiliate_id = $ref_var;
			} elseif ( affiliate_wp()->tracking->get_affiliate_id() ) {
				$affiliate_id = affiliate_wp()->tracking->get_affiliate_id();
			}else {
				$affiliate_id = '';
			}
		
			if(!empty($affiliate_id)){
				
				$affilaite_data = maybe_unserialize( get_option( 'affwp_affiliate_extra_data_'. $affiliate_id) );
				
				$html = '';
				$html .= "<script type='text/javascript'>\n";
				$html .= 	"/* <![CDATA[ */\n";
				$html .= 	"jQuery(document).ready( function($){ \n";
				
				if(!empty( $affilaite_data['custom_price_low'] )){
					$custom_price_low = str_replace('$', '', $affilaite_data['custom_price_low']);
					$html .= 	"$(\"span.price:contains('5')\").text('". $custom_price_low ."');\n";
				}else{
					$html .= 	"$(\"span.price:contains('5')\").text('1');\n";
				}
				if(!empty( $affilaite_data['custom_price'] )){
					$custom_price = str_replace('$', '', $affilaite_data['custom_price']);
					$html .= 	"$(\"span.price:contains('19')\").text('". $custom_price ."');\n";
				}else{
					$html .= 	"$(\"span.price:contains('19')\").text('15');\n";
				}
				if(!empty( $affilaite_data['custom_price_high'] )){
					$custom_price_high = str_replace('$', '', $affilaite_data['custom_price_high']);
					$html .= 	"$(\"span.price:contains('99')\").text('". $custom_price_high ."');\n";
				}else{
					$html .= 	"$(\"span.price:contains('99')\").parents('.q_price_table').hide();\n";
					$html .= 	"$(\"div.q_price_table\").width('31%');\n";
					$html .= 	"$(\"li.pricing_table_content li:contains('Accounts Between $20,000 to $500,000')\").text('Accounts Greater Than $20,000');\n";
				}
				
				if(!empty( $affilaite_data['signup_url'] )){
					$custom_signup_url = $affilaite_data['signup_url'];
					$html .= 	"$(\"a[href^='https://secure.blooom.com/'], a[href^='https://secure.blooom.com']\").attr( 'href', '". $custom_signup_url ."' );\n";
				}
				
				if(!empty( $affilaite_data['custom_content'] )){
					$custom_content = nl2br( $affilaite_data['custom_content'] );
					$custom_content = str_replace( '"', '&quot;', $affilaite_data['custom_content'] );
					$custom_content = str_replace( "'", '&#039;', $affilaite_data['custom_content'] );
					$html .= 	"$(\"div.below-slider-content\").show();\n";
					$html .= 	"$(\"div#below-slider-content-p\").html( '". $custom_content ."' );\n";
				}

				if(!empty( $affilaite_data['chk_hide_companies'] )){
					$html .= 	"$(\"#companies\").hide();\n";
				}
				
				$html .= 	"});";
				$html .= 	"\n/* ]]> */\n";
				$html .= "</script>\n";
				
				echo $html;
				
				if(!empty( $affilaite_data['affiliate_slider'] )){
					$GLOBALS['bl_is_afffiliate'] = 1;
					$GLOBALS['bl_affiliate_slider'] = $affilaite_data['affiliate_slider'];
				}



			} 
		//}
	//}
}

function curPageURL() {
	$pageURL = 'http';
	if ($_SERVER["HTTPS"] == "on") {$pageURL .= "s";}
	$pageURL .= "://";
	if ($_SERVER["SERVER_PORT"] != "80") {
	$pageURL .= $_SERVER["SERVER_NAME"].":".$_SERVER["SERVER_PORT"].$_SERVER["REQUEST_URI"];
	} else {
	$pageURL .= $_SERVER["SERVER_NAME"].$_SERVER["REQUEST_URI"];
	}
	return $pageURL;
}


//remove_action( 'pre_get_posts', array( affiliate_wp()->tracking, 'unset_query_arg' ) );