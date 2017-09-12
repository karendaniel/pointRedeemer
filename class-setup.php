<?php
namespace PointRedeemer;

class PR_Setup
{
	public function __construct() {
	
		add_action('admin_menu', array($this, 'adminToolbarmenu'));
		add_shortcode('pointredeemerButton', array($this, 'pointredeemerButton'));
		add_action('wp_enqueue_scripts', array($this, 'PointRedeemerScript'));
		add_action('wp_ajax_getCurrentUserData', array($this, 'getCurrentUserData'));
		add_action('wp_ajax_getUserPoints', array($this, 'getUserPoints'));
		add_action('wp_ajax_redeemUserPoints', array($this, 'redeemUserPoints'));


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

	public function getUserPoints() {

		$url = $_POST['data']['url'];
		$user = $_POST['data']['userData'];
		$token = $_POST['data']['token'];
		$users = array('currency'=> 'MYR','users' => $user);

		$opts = array(
        CURLOPT_CONNECTTIMEOUT => 10,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_TIMEOUT => 60,
        CURLOPT_USERAGENT => 'My-Wordpress-Observer',
        CURLOPT_SSL_VERIFYPEER => False,
        CURLOPT_HTTPHEADER => array('Accept: application/json'),
        CURLOPT_URL => $url,
        CURLOPT_POSTFIELDS => array('token' => $token, 'users' => json_encode($users)),
	    );

	    $ch = curl_init();
	    curl_setopt_array($ch, $opts);
	    $result = curl_exec($ch);

		echo $result;
		wp_die();
	}

	public function redeemUserPoints() {

		$url = $_POST['data']['url'];
		$user = $_POST['data']['userData'];
		$token = $_POST['data']['token'];
		$users = array('currency'=> 'MYR','users' => $user);

		$opts = array(
        CURLOPT_CONNECTTIMEOUT => 10,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_TIMEOUT => 60,
        CURLOPT_USERAGENT => 'My-Wordpress-Observer',
        CURLOPT_SSL_VERIFYPEER => False,
        CURLOPT_HTTPHEADER => array('Accept: application/json'),
        CURLOPT_URL => $url,
        CURLOPT_POSTFIELDS => array('token' => $token, 'users' => json_encode($users), 'redeem' => 15),
	    );

	    $ch = curl_init();
	    curl_setopt_array($ch, $opts);
	    $result = curl_exec($ch);

		echo $result;
		wp_die();
	}

	public function outputJSON($data)
	{

		header("Content-type:application/json");
		return  json_encode($data->data);
	}
	public function outputJSON2($data)
	{

		header("Content-type:application/json");
		return  json_encode($data);
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