<?php
/**
 * @package	Joomla.Site
 * @subpackage	mod_simplecss3menu
 * @copyright	Copyright (C) 2005 - 2014 Open Source Matters, Inc. All rights reserved.
 * @license	GNU General Public License version 2 or later; see LICENSE.txt
 * @version     1.0.0
 * @see Simple CSS3 Dropdown Menu:  http://cssdeck.com/labs/another-simple-css3-dropdown-menu
 */

// no direct access
defined('_JEXEC') or die;

// Include the syndicate functions only once
require_once dirname(__FILE__).'/helper.php';

$list = modSimpleCss3MenuHelper::getList($params);
$app = JFactory::getApplication();
$menu = $app->getMenu();
$active	= $menu->getActive();
$active_id = isset($active) ? $active->id : $menu->getDefault()->id;
$path = isset($active) ? $active->tree : array();
$showAll = $params->get('showAllChildren');

$menu_item_width = $params->get('menu_item_width');
//$style = $params->get('style');
$color_menu_text = $params->get('color_menu_text');
$color_menu_over = $params->get('color_menu_over');
$color_menu_over_text = $params->get('color_menu_over_text');

$color_submenu = $params->get('color_submenu');

$id_menu_subtitle = explode(";", $params->get('id_menu_subtitle'));
$menu_subtitle = explode(";", $params->get('menu_subtitle'));
$color_menu_subtitle = $params->get('color_menu_subtitle');
$color_menu_subtitle_over = $params->get('color_menu_subtitle_over');

if(count($list)) {
	require JModuleHelper::getLayoutPath('mod_simplecss3menu', $params->get('layout', 'default'));
}
