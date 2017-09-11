<?php
namespace PointRedeemer;

class PR_Setup
{
	public function __construct() {}

	public function adminToolbarmenu()
	{
		add_menu_page(
			'Point Redeemer',
			'Point Redeemer',
			'manage_options',
			'pointredeemer',
			array(
				$this,
				'createAdminToolbarMenu'),
			null,
			5
		);
	}

	public function createAdminToolbarMenu()
	{
		echo "hello";
	}
}