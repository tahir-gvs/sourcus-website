<?php
/**
* Liquid Themes Theme Framework
* The Liquid_Admin_Import class
*/

if( !defined( 'ABSPATH' ) )
	exit; // Exit if accessed directly

class Liquid_Admin_Support extends Liquid_Admin_Page {

	/**
	 * [__construct description]
	 * @method __construct
	 */
	public function __construct() {

		$this->id = 'saasland-support';
		$this->page_title = esc_html__( 'Liquid Support', 'saasland' );
		$this->menu_title = esc_html__( 'Support', 'saasland' );
		$this->parent = 'saasland';
		$this->position = '15';

		parent::__construct();
	}

	/**
	 * [display description]
	 * @method display
	 * @return [type]  [description]
	 */
	public function display() {
		include_once( get_template_directory() . '/liquid/admin/views/liquid-support.php' );
	}

	/**
	 * [ssaasland description]
	 * @method ssaasland
	 * @return [type] [description]
	 */
	public function ssaasland() {

	}
}
new Liquid_Admin_Support;