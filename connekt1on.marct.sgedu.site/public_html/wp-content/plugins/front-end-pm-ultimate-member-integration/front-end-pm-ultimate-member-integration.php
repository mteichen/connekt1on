<?php
/*
Plugin Name: Front End PM - Ultimate Member Integration
Plugin URI: https://wordpress.org/plugins/front-end-pm-ultimate-member-integration/
Description: Front End PM extension to integrate with Ultimate Member
Version: 1.4
Author: Shamim
Author URI: https://www.shamimsplugins.com/contact-us/
Text Domain: front-end-pm-ultimate-member-integration
License: GPLv2 or later
*/

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

register_activation_hook(__FILE__ , 'fep_um_plugin_activate' );

function fep_um_plugin_activate(){
		if( function_exists( 'um_get_option' )
		&& function_exists( 'fep_update_option' )
		&& um_get_option('core_user') ){
			fep_update_option( 'page_id', um_get_option('core_user') );
		}
}

class Front_End_Pm_UM_Integration {

	private static $instance;

	private function __construct() {
		if( ! function_exists( 'fep_get_option' ) || ! function_exists( 'um_profile_id' ) ) {
			// Display notices to admins
			add_action( 'admin_notices', array( $this, 'notices' ) );
			return;
		}
		//$this->constants();
		//$this->includes();
		$this->actions();
		$this->filters();

	}

	public static function init()
        {
            if(!self::$instance instanceof self) {
                self::$instance = new self;
            }
            return self::$instance;
        }

	private function constants()
    	{
    	}

	private function includes()
    	{
    	}

	private function actions()
    	{
			// SETUP TEXT DOMAIN FOR TRANSLATIONS
			load_plugin_textdomain( 'front-end-pm-ultimate-member-integration', false, dirname( plugin_basename( __FILE__ ) ) . '/languages' );
			
				if( is_user_logged_in() ){
					add_action('um_profile_content_fep-um_default', array( $this, 'content' ) );

					//Account page
					add_action('um_account_tab__fep-um', array( $this, 'account_tab_hook' ) );
				}
    	}

	private function filters()
    	{
    		if( is_user_logged_in() ){
					add_filter( 'um_profile_tabs', array( $this, 'tab' ), 1000 );
					add_filter( 'fep_query_url_without_esc_filter', array( $this, 'url' ), 99, 2 );

					//Account page
					add_filter('um_account_page_default_tabs_hook', array( $this, 'account_tab' ), 100 );
					add_filter('um_account_content_hook_fep-um', array( $this, 'account_content' ) );
				}
			//PRO version message_url and announcement_url change in email
			add_filter( 'fep_eb_email_legends', array( $this, 'email_legends' ), 10, 3 );
    	}

	function content( $args ) {
		if( get_current_user_id() == um_profile_id() ){
			?><style type="text/css">
			input#fep_mr_to, input#blocked_users{display: none !important;}
			</style>
			<?php
			echo do_shortcode('[front-end-pm]');
		} else {
			echo do_shortcode('[fep_shortcode_new_message_form to="{um-current-author}" subject="" heading=""]');
		}
	}

	function url( $url, $args ){
		$args['profiletab'] = 'fep-um';
		um_fetch_user( get_current_user_id() );
		
		return add_query_arg( $args, um_user_profile_url());
	}
	
	function email_legends( $legends, $post, $user_email ){
		if( is_object( $post ) ){
			um_fetch_user( fep_get_userdata( $user_email, 'ID', 'email') );
			
			$legends['message_url']['replace_with'] = ! empty( $post->ID ) ? esc_url_raw( add_query_arg( array( 'profiletab' => 'fep-um', 'fepaction' => 'viewmessage', 'fep_id' => $post->ID ), um_user_profile_url() ) ) : '';
			
			$legends['announcement_url']['replace_with'] = ! empty( $post->ID ) ? esc_url_raw( add_query_arg( array( 'profiletab' => 'fep-um', 'fepaction' => 'view_announcement', 'fep_id' => $post->ID ), um_user_profile_url() ) ) : '';
		}
		
		return $legends;
	}

	function tab( $tabs ) {

		$tabs['fep-um'] = array(
			'name' => __('Message', 'front-end-pm-ultimate-member-integration'),
			'icon' => 'um-icon-email',
		);

		return $tabs;

	}

	//Account page
	function account_tab( $tabs ) {
			$tabs[800]['fep-um']['icon'] = 'um-icon-email';
			$tabs[800]['fep-um']['title'] = __('Message', 'front-end-pm-ultimate-member-integration');
			$tabs[800]['fep-um']['custom'] = true;
			return $tabs;
	}

	function account_tab_hook( $info ) {
			global $ultimatemember;
			extract( $info );

			$output = $ultimatemember->account->get_tab_output('fep-um');
			if ( $output ) {
				echo '<div class="um-account-heading uimob340-hide uimob500-hide"><i class="'. $icon .'"></i>' .$title.'</div>';
				echo $output;
			}
	}

	function account_content( $output ){

			$output = '<div class="um-field">';
			$output .= '<a class="um-button" href="' . esc_url( add_query_arg( 'profiletab', 'fep-um', um_user_profile_url()) ) .'">' . __('Message', 'front-end-pm-ultimate-member-integration') . '</a>';
			$output .= '</div>';

			return $output;
	}

	public function notices() {
		echo '<div class="error"><p>'. __( 'Front End PM and Ultimate Member must be activated to use Front End PM - Ultimate Member Integration.', 'front-end-pm-ultimate-member-integration' ). '</p></div>';
	}

} //END Class

add_action( 'init', array( 'Front_End_Pm_UM_Integration', 'init' ) );
