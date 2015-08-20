<?php
/**
 * @package		Joomla.Site
 * @subpackage	mod_menu
 * @copyright	Copyright (C) 2005 - 2014 Open Source Matters, Inc. All rights reserved.
 * @license		GNU General Public License version 2 or later; see LICENSE.txt
 */

// No direct access.
defined('_JEXEC') or die;

$style = "horizontal";

$doc =& JFactory::getDocument();
$doc->addStyleSheet("modules/mod_simplecss3menu/assets/css/mod_simplecss3menu_$style.css");

$menu_item_width = (empty($menu_item_width) || $menu_item_width == "") ? "240" : $menu_item_width;
$color_menu_text = (empty($color_menu_text) || $color_menu_text == "") ? "ffffff" : $color_menu_text;
$color_menu_over = (empty($color_menu_over) || $color_menu_over == "") ? "525253" : $color_menu_over;
$color_menu_over_text = (empty($color_menu_over_text) || $color_menu_over_text == "") ? "b06e22" : $color_menu_over_text;

$css_style = "
    ul#mod_simplecss3_menu_$style li ul, ul#mod_simplecss3_menu_$style li ul li ul{
        min-width: ".$menu_item_width."px;
    }
    ul#mod_simplecss3_menu_horizontal li ul li, ul#mod_simplecss3_menu_horizontal li ul li ul li{
        background: #$color_submenu !important;
    }
    ul#mod_simplecss3_menu_$style li, ul#mod_simplecss3_menu_$style li ul li a,
    ul#mod_simplecss3_menu_$style li a:link, ul#mod_simplecss3_menu_$style li a:active,
    ul#mod_simplecss3_menu_$style li a:visited {
        color: #$color_menu_text !important;
    }
    ul#mod_simplecss3_menu_$style li:hover, ul#mod_simplecss3_menu_$style li a:hover,s
    ul#mod_simplecss3_menu_$style li ul li a:hover {
        color: #$color_menu_over_text !important;
        background: #$color_menu_over !important;
        text-decoration: none;
    }
    ul#mod_simplecss3_menu_$style li span.mod_simplecss3_menu_subtitle{
        color: #$color_menu_subtitle !important;
    }
    ul#mod_simplecss3_menu_$style li span.mod_simplecss3_menu_subtitle:hover{
        color: #$color_menu_subtitle_over !important;
    }";
$doc->addStyleDeclaration($css_style);

// Note. It is important to remove spaces between elements.
?>

<ul class="" id="mod_simplecss3_menu_<?php echo $style; ?>">
<?php
foreach ($list as $i => &$item) :
//    echo "level_diff: ".$item->level_diff;
	$class = 'item-'.$item->id;
	if ($item->id == $active_id) {
		$class .= ' current';
	}

	if (in_array($item->id, $path)) {
		$class .= ' active';
	}
	elseif ($item->type == 'alias') {
		$aliasToId = $item->params->get('aliasoptions');
		if (count($path) > 0 && $aliasToId == $path[count($path)-1]) {
			$class .= ' active';
		}
		elseif (in_array($aliasToId, $path)) {
			$class .= ' alias-parent-active';
		}
	}

	if ($item->deeper) {
		$class .= ' deeper';
	}

	if ($item->parent) {
		$class .= ' parent';
	}

	if (!empty($class)) {
		$class = ' class="'.trim($class) .'"';
	}

	echo '<li'.$class.'>';

	// Render the menu item.
	switch ($item->type) :
		case 'separator':
		case 'url':
		case 'component':
			require JModuleHelper::getLayoutPath('mod_menu', 'default_'.$item->type);
                        if(in_array($item->id, $id_menu_subtitle)){
                            $posIDArray = array_search($item->id, $id_menu_subtitle);
                            echo '<br/><span class="mod_simplecss3_menu_subtitle">'.$menu_subtitle[$posIDArray].'</span>';
                        }
			break;

		default:
			require JModuleHelper::getLayoutPath('mod_menu', 'default_url');
			break;
	endswitch;

	// The next item is deeper.
	if ($item->deeper) {
		echo '<ul>';
	}
	// The next item is shallower.
	elseif ($item->shallower) {
		echo '</li>';
		echo str_repeat('</ul></li>', $item->level_diff);
	}
	// The next item is on the same level.
	else {
		echo '</li>';
	}
endforeach;
?></ul>
