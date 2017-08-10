<?php
/*
Plugin Name: Woobizz Hook 16
Plugin URI: http://woobizz.com
Description: Add widget content before proceed to checkout button on cart page
Author: Woobizz
Author URI: http://woobizz.com
Version: 1.0.0
Text Domain: woobizzhook16
Domain Path: /lang/
*/
//Prevent direct acces
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly
//Load translation
add_action( 'plugins_loaded', 'woobizzhook16_load_textdomain' );
function woobizzhook16_load_textdomain() {
  load_plugin_textdomain( 'woobizzhook16', false, basename( dirname( __FILE__ ) ) . '/lang' ); 
}
//Check if WooCommerce is active
if ( in_array( 'woocommerce/woocommerce.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) ) ) {
	//echo "woocommerce is active";
	//Hook(s) 16
	add_action( 'widgets_init', 'woobizzhook16_widget',116);
}else{
	//Show message on admin
	//echo "woocommerce is not active";
	add_action( 'admin_notices', 'woobizzhook16_admin_notice' );
}
//Add Hook 16
function woobizzhook16_widget() {
	$args = array(
				'id'            => 'woobizzhook16_id',
				'name'          => __( 'Woobizz Hook 16', 'woobizzhook16' ),
				'description'   => __( 'Add widget content before proceed to checkout button on cart page','woobizzhook16' ),
				'before_title'  => '<h2 class="widgettitle">',
				'before_title'   => '</h2>',
				'before_widget' => '<li id="%1$s" class="widget %2$s">',
				'before_widget'  => '</li>',
	);
	register_sidebar( $args );
	add_action( 'woocommerce_proceed_to_checkout', 'woobizzhook16_display',1);
	function woobizzhook16_display(){
		?>
		<div class="woobizzhook16-widget-div">
			<div class="woobizzhook16-widget-content">
				<?php dynamic_sidebar( 'Woobizz Hook 16' ); ?>
			</div>
		</div>
		<?php
	}
}
//Hook16 Notice
function woobizzhook16_admin_notice() {
    ?>
    <div class="notice notice-error is-dismissible">
        <p><?php _e( 'Woobizz Hook 16 needs WooCommerce to work properly, If you do not use this plugin you can disable it!', 'woobizzhook16' ); ?></p>
    </div>
    <?php
}