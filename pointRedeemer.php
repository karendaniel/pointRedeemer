<?php
/*
Plugin Name: Point Redeemer
Plugin URI: https://
Description: The plugin allows user to redeem points for purchasing item with discount
Author: Karen Daniel
Author URI: https://
*/
use PointRedeemer\PR_Setup as setup;

spl_autoload_register('autoloadFiles');

function autoloadFiles($className)
{
	if (false === strpos($className, 'PR')) {
		return;
	}

	$file_parts = explode('\\', $className);
	$namespace = '';

	for ($i = count($file_parts) - 1; $i > 0; $i--) {

		$current = strtolower($file_parts[$i]);
		$current = str_ireplace('_', '-', $current);
		$current = str_ireplace('PR-', '', $current);

		if (count($file_parts) - 1 === $i) {

			if (strpos(strtolower($file_parts[count($file_parts) - 1]), 'interface')) {
				echo "interface";
			} else {
				$file_name = "class-$current.php";
			}

		} else {
			$namespace = '/'.$current.$namespace;
		}
	}

	$file_path = trailingslashit(dirname(__FILE__).$namespace);
	$file_path .= $file_name;

	require_once($file_path);
}

add_action('plugins_loaded', 'initPlugin');

function initPlugin()
{
	$setup = new Setup;

}