<?php
class CustomMenuWalker extends Walker_Nav_Menu
{
    function start_el(&$output, $item, $depth = 0, $args = [], $id = 0)
    {
		// Check if the item should open in a new tab
        $target = !empty($item->target) ? ' target="' . esc_attr($item->target) . '"' : '';

        $output .= "<li class='" .  implode(" ", (array) $item->classes) . "'>";
        $output .= '<a href="' . esc_url($item->url) . '"' . $target . '>';
        $output .= $item->title;
        $output .= '</a>';
        if (in_array('menu-item-has-children', (array) $item->classes)) {
            $output .= '<span class="sub-menu-trigger"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="#00aeef" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-down"><polyline points="6 9 12 15 18 9"></polyline></svg></span>';
        }
    }
}
