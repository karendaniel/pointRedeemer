<?php
namespace PointRedeemer;

class PR_Setup
{
	public function __construct() {
	
		add_action('admin_menu', array($this, 'adminToolbarmenu'));
		add_shortcode('pointredeemerButton', array($this, 'pointredeemerButton'));
		add_action('wp_enqueue_scripts', array($this, 'PointRedeemerScript'));
		add_action('wp_ajax_getCurrentUserData', array($this, 'getCurrentUserData'));
	}

	public function adminToolbarmenu()
	{
		add_menu_page(
			'Point Redeemer',
			'Point Redeemer',
			'manage_options',
			'pointredeemer',
			array(
				$this,
				'adminToolbarPage'),
			null,
			5
		);
	}

	public function adminToolbarPage()
	{
		do_shortcode('[pointredeemerButton]');
	}

	public function pointredeemerButton()
	{
		?>
			<input type="button" name="pointredeemerButton" value="Redeem Point" id="pointredeemerButton">
		<?php
	}

	public function getCurrentUserID()
	{
		$currentUserID = get_current_user_id();
		return $currentUserID;
	}

	public function getCurrentUserData()
	{

		$currentUserData = $this->outputJSON(wp_get_current_user());
		echo $currentUserData;
		wp_die();
	}

	public function outputJSON($data)
	{

		header("Content-type:application/json");
		return  json_encode($data->data);
	}

	public function PointRedeemerScript()
	{

		wp_enqueue_script('jquery-redeemer', 'https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js', array(), null, true);
		wp_enqueue_script('pointredeemerButton-js', plugin_dir_url(__FILE__).'js/pointredeemerButton-script.js', array('jquery-redeemer'), null, false);
		wp_localize_script(
			'pointredeemerButton-js',
			'pointredeemerButton_ajax',
			 array(
			 	'ajax_url' => admin_url('admin-ajax.php'))
			 );
	}
}