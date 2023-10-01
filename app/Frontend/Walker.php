<?php

namespace AwesomeCoder\School;

if (!class_exists('Walker_Nav_Menu')) {
	require_once(ABSPATH . WPINC . '/class-walker-nav-menu.php');
}

/**
 * Register custom nav Menu
 * of the template.
 *
 * @since    1.0.0
 * @access   private
 */
class SchoolPrimaryMenu extends \Walker_Nav_Menu
{

	/**
	 * Start the levels
	 *
	 * @since    1.0.0
	 */
	// public $start_lvl_class = "relative w-full h-5 max-w-sm shadow z-50 bg-primary-500";
	public $start_lvl_class = "relative";

	/**
	 * Start the levels
	 *
	 * @since    1.0.0
	 */
	public function start_lvl(&$output, $depth = 0, $args = array())
	{
		$indent = str_repeat("\t", $depth);
		// $output .= "\n$indent <div class=\"$this->start_lvl_class\">\n";

		// add contents
		ob_start();
		require SCHOOL_THEME_PATH . "/template/navigation/start_lvl.php";
		$output .= ob_get_contents();
		ob_end_clean();
	}


	/**
	 * End the levels
	 *
	 * @since    1.0.0
	 */
	public function end_lvl(&$output, $depth = 0, $args = array())
	{
		$indent = str_repeat("\t", $depth);
		// add contents
		ob_start();
		require SCHOOL_THEME_PATH . "/template/navigation/end_lvl.php";
		$output .= ob_get_contents();
		ob_end_clean();

		// return nothing
	}

	/**
	 * Start the element
	 *
	 * @since    1.0.0
	 */
	public function start_el(&$output, $item, $depth = 0, $args = null, $id = 0)
	{
		$indent = ($depth) ? str_repeat("\t", $depth) : '';
		$li_attributes = '';
		$class_names = $value = '';

		$classes = empty($item->classes) ? array() : (array) $item->classes;
		$classes[] = ($args->has_children) ? 'dropdown' : '';
		$classes[] = ($item->current || $item->current_item_ancestor) ? 'active' : '';
		$classes[] = 'menu-item-' . $item->ID;
		if ($depth && $args->has_children) {
			$classes[] = 'dropdown-submenu';
		}

		$class_names = implode(' ', apply_filters('nav_menu_css_class', array_filter($classes), $item, $args));
		$class_names = ' class=" text-base font-medium text-gray-500 hover:text-gray-900 ' . esc_attr($class_names) . '"';
		$nav_menu_link_class = implode(' ', apply_filters('nav_menu_link_attributes', array_filter($classes), $item, $args));


		$id = apply_filters('nav_menu_item_id', 'menu-item-' . $item->ID, $item, $args);
		$id = strlen($id) ? ' id="' . esc_attr($id) . '"' : '';

		$output .= $indent . '<li' . $id . $value . $class_names . $li_attributes . '>';

		$attributes = !empty($item->attr_title) ? ' title="' . esc_attr($item->attr_title) . '"' : '';
		$attributes .= !empty($item->target) ? ' target="' . esc_attr($item->target) . '"' : '';
		$attributes .= !empty($item->xfn) ? ' rel="' . esc_attr($item->xfn) . '"' : '';
		$attributes .= !empty($item->url) ? ' href="' . esc_attr($item->url) . '"' : '';

		$item_output = $args->before;
		// $item_output .= '<a' . $attributes . '>';
		// $item_output .= $args->link_before . apply_filters('the_title', $item->title, $item->ID) . $args->link_after;
		// add contents
		ob_start();
		require SCHOOL_THEME_PATH . "/template/navigation/start_el.php";
		$item_output .= ob_get_contents();
		ob_end_clean();

		$output .= apply_filters('walker_nav_menu_start_el', $item_output, $item, $depth, $args);
	}

	/**
	 * Display the levels
	 *
	 * @since    1.0.0
	 */
	public function display_element($element, &$children_elements, $max_depth, $depth, $args, &$output)
	{
		if (!$element) {
			return;
		}

		$id_field = $this->db_fields['id'];

		//display this element
		if (is_array($args[0])) {
			$args[0]['has_children'] = !empty($children_elements[$element->$id_field]);
		} elseif (is_object($args[0])) {
			$args[0]->has_children = !empty($children_elements[$element->$id_field]);
		}

		$cb_args = array_merge(array(&$output, $element, $depth), $args);
		call_user_func_array(array(&$this, 'start_el'), $cb_args);

		$id = $element->$id_field;

		// descend only when the depth is right and there are childrens for this element
		if (($max_depth == 0 || $max_depth > $depth + 1) && isset($children_elements[$id])) {
			foreach ($children_elements[$id] as $child) {
				if (!isset($newlevel)) {
					$newlevel = true;
					//start the child delimiter
					$cb_args = array_merge(array(&$output, $depth), $args);
					call_user_func_array(array(&$this, 'start_lvl'), $cb_args);
				}
				$this->display_element($child, $children_elements, $max_depth, $depth + 1, $args, $output);
			}
			unset($children_elements[$id]);
		}

		if (isset($newlevel) && $newlevel) {
			//end the child delimiter
			$cb_args = array_merge(array(&$output, $depth), $args);
			call_user_func_array(array(&$this, 'end_lvl'), $cb_args);
		}

		//end this element
		$cb_args = array_merge(array(&$output, $element, $depth), $args);
		call_user_func_array(array(&$this, 'end_el'), $cb_args);
	}
}



// /**
//  * Register custom phone nav Menu
//  * of the template.
//  *
//  * @since    1.0.0
//  * @access   private
//  */
// class Cryptogainers_Mobile_Nav extends Walker_Nav_Menu
// {

// 	public function start_lvl(&$output, $depth = 0, $args = array())
// 	{
// 		$indent = str_repeat("\t", $depth);
// 	}

// 	public function end_lvl(&$output, $depth = 0, $args = array())
// 	{
// 		$indent = str_repeat("\t", $depth);
// 	}

// 	public function start_el(&$output, $item, $depth = 0, $args = null, $id = 0)
// 	{
// 		$indent = ($depth) ? str_repeat("\t", $depth) : '';
// 		$li_attributes = '';
// 		$class_names = $value = '';

// 		$classes = empty($item->classes) ? array() : (array) $item->classes;
// 		$classes[] = ($args->has_children) ? 'dropdown' : '';
// 		$classes[] = ($item->current || $item->current_item_ancestor) ? 'active' : '';
// 		$classes[] = 'menu-item-' . $item->ID;
// 		if ($depth && $args->has_children) {
// 			$classes[] = 'dropdown-submenu';
// 		}

// 		$class_names = implode(' ', apply_filters('nav_menu_css_class', array_filter($classes), $item, $args));

// 		$id = apply_filters('nav_menu_item_id', 'menu-item-' . $item->ID, $item, $args);
// 		$id = strlen($id) ? ' id="' . esc_attr($id) . '"' : '';


// 		$attributes = !empty($item->attr_title) ? ' title="' . esc_attr($item->attr_title) . '"' : '';
// 		$attributes .= !empty($item->target) ? ' target="' . esc_attr($item->target) . '"' : '';
// 		$attributes .= !empty($item->xfn) ? ' rel="' . esc_attr($item->xfn) . '"' : '';
// 		$attributes .= !empty($item->url) ? ' href="' . esc_attr($item->url) . '"' : '';

// 		$item_output = $args->before;


// 		$attributes .= ' class="-m-3 p-3 flex items-start rounded-lg hover:bg-gray-50"';
// 		$item_output = '<a' . $attributes . '>';
// 		$cryptogainers_menu_icon = get_post_meta($item->ID, "cryptogainers_menu_icon", true);
// 		if (isset($cryptogainers_menu_icon)) {
// 			if (isset($cryptogainers_menu_icon) && !empty($cryptogainers_menu_icon)) {
// 				$item_output .= html_entity_decode(get_post_meta($item->ID, "cryptogainers_menu_icon", true));
// 			} else {
// 				$item_output .= "\n$indent <svg class=\"flex-shrink-0 h-6 w-6 text-indigo-600\" x-description=\"Heroicon name: outline/chart-bar\" xmlns=\"http://www.w3.org/2000/svg\" fill=\"none\" viewBox=\"0 0 24 24\" stroke=\"currentColor\" aria-hidden=\"true\"> \n";
// 				$item_output .= "\n$indent <path stroke-linecap=\"round\" stroke-linejoin=\"round\" stroke-width=\"2\" d=\"M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z\"></path> \n";
// 				$item_output .= "\n$indent </svg> \n";
// 			}
// 		} else if (isset($args->cryptogainers_menu_icon)) {
// 			$item_output .= html_entity_decode($args->cryptogainers_menu_icon);
// 		}

// 		$item_output .= "\n$indent <div class=\"ml-4\">\n";
// 		$item_output .= "\n$indent <p class=\"text-base font-medium text-gray-900\">\n";
// 		$item_output .= __(apply_filters('the_title', $item->title, $item->ID), "cryptogainers");
// 		$item_output .= "\n$indent </p>\n";
// 		$item_output .= "\n$indent </div>\n";

// 		$item_output .= '</a>';
// 		$item_output .= $args->after;

// 		$output .= apply_filters('walker_nav_menu_start_el', $item_output, $item, $depth, $args);
// 	}

// 	public function display_element($element, &$children_elements, $max_depth, $depth, $args, &$output)
// 	{
// 		if (!$element) {
// 			return;
// 		}

// 		$id_field = $this->db_fields['id'];

// 		//display this element
// 		if (is_array($args[0])) {
// 			$args[0]['has_children'] = !empty($children_elements[$element->$id_field]);
// 		} elseif (is_object($args[0])) {
// 			$args[0]->has_children = !empty($children_elements[$element->$id_field]);
// 		}

// 		$cb_args = array_merge(array(&$output, $element, $depth), $args);
// 		call_user_func_array(array(&$this, 'start_el'), $cb_args);

// 		$id = $element->$id_field;

// 		// descend only when the depth is right and there are childrens for this element
// 		if (($max_depth == 0 || $max_depth > $depth + 1) && isset($children_elements[$id])) {
// 			foreach ($children_elements[$id] as $child) {
// 				$args[0]->cryptogainers_menu_icon = get_post_meta($child->ID, "cryptogainers_menu_icon", true);
// 				if (!isset($newlevel)) {
// 					$newlevel = true;
// 					//start the child delimiter
// 					$cb_args = array_merge(array(&$output, $depth), $args);
// 					call_user_func_array(array(&$this, 'start_lvl'), $cb_args);
// 				}
// 				$this->display_element($child, $children_elements, $max_depth, $depth + 1, $args, $output);
// 			}
// 			unset($children_elements[$id]);
// 		}

// 		if (isset($newlevel) && $newlevel) {
// 			//end the child delimiter
// 			$cb_args = array_merge(array(&$output, $depth), $args);
// 			call_user_func_array(array(&$this, 'end_lvl'), $cb_args);
// 		}

// 		//end this element
// 		$cb_args = array_merge(array(&$output, $element, $depth), $args);
// 		call_user_func_array(array(&$this, 'end_el'), $cb_args);
// 	}
// }





// /**
//  * Register custom footer nav Menu
//  * of the template.
//  *
//  * @since    1.0.0
//  * @access   private
//  */
// class Cryptogainers_Footer_Nav extends Walker_Nav_Menu
// {

// 	public function start_lvl(&$output, $depth = 0, $args = array())
// 	{
// 		$indent = str_repeat("\t", $depth);
// 	}

// 	public function end_lvl(&$output, $depth = 0, $args = array())
// 	{
// 		$indent = str_repeat("\t", $depth);
// 	}

// 	public function start_el(&$output, $item, $depth = 0, $args = null, $id = 0)
// 	{
// 		$indent = ($depth) ? str_repeat("\t", $depth) : '';
// 		$li_attributes = '';
// 		$class_names = $value = '';

// 		$classes = empty($item->classes) ? array() : (array) $item->classes;
// 		$classes[] = ($args->has_children) ? 'dropdown' : '';
// 		$classes[] = ($item->current || $item->current_item_ancestor) ? 'active' : '';
// 		$classes[] = 'menu-item-' . $item->ID;
// 		if ($depth && $args->has_children) {
// 			$classes[] = 'dropdown-submenu';
// 		}

// 		$class_names = implode(' ', apply_filters('nav_menu_css_class', array_filter($classes), $item, $args));

// 		$id = apply_filters('nav_menu_item_id', 'menu-item-' . $item->ID, $item, $args);
// 		$id = strlen($id) ? ' id="' . esc_attr($id) . '"' : '';


// 		$attributes = !empty($item->attr_title) ? ' title="' . esc_attr($item->attr_title) . '"' : '';
// 		$attributes .= !empty($item->target) ? ' target="' . esc_attr($item->target) . '"' : '';
// 		$attributes .= !empty($item->xfn) ? ' rel="' . esc_attr($item->xfn) . '"' : '';
// 		$attributes .= !empty($item->url) ? ' href="' . esc_attr($item->url) . '"' : '';

// 		$item_output = $args->before;


// 		$attributes .= ' class="block w-full h-full px-3 py-2 hover:text-gray-900 transition-colors duration-200"';
// 		$item_output .= '<li class="cursor-pointer rounded-lg hover:bg-gray-100 text-base font-medium text-gray-500 hover:text-gray-900" >';
// 		// $item_output = '<li>';
// 		$item_output .= '<a' . $attributes . '>';
// 		$item_output .= __(apply_filters('the_title', $item->title, $item->ID), "cryptogainers");
// 		$item_output .= '</a>';
// 		$item_output .= '</li>';
// 		$item_output .= $args->after;

// 		$output .= apply_filters('walker_nav_menu_start_el', $item_output, $item, $depth, $args);
// 	}

// 	public function display_element($element, &$children_elements, $max_depth, $depth, $args, &$output)
// 	{
// 		if (!$element) {
// 			return;
// 		}

// 		$id_field = $this->db_fields['id'];

// 		//display this element
// 		if (is_array($args[0])) {
// 			$args[0]['has_children'] = !empty($children_elements[$element->$id_field]);
// 		} elseif (is_object($args[0])) {
// 			$args[0]->has_children = !empty($children_elements[$element->$id_field]);
// 		}

// 		$cb_args = array_merge(array(&$output, $element, $depth), $args);
// 		call_user_func_array(array(&$this, 'start_el'), $cb_args);

// 		$id = $element->$id_field;

// 		// descend only when the depth is right and there are childrens for this element
// 		if (($max_depth == 0 || $max_depth > $depth + 1) && isset($children_elements[$id])) {
// 			foreach ($children_elements[$id] as $child) {
// 				$args[0]->cryptogainers_menu_icon = get_post_meta($child->ID, "cryptogainers_menu_icon", true);
// 				if (!isset($newlevel)) {
// 					$newlevel = true;
// 					//start the child delimiter
// 					$cb_args = array_merge(array(&$output, $depth), $args);
// 					call_user_func_array(array(&$this, 'start_lvl'), $cb_args);
// 				}
// 				$this->display_element($child, $children_elements, $max_depth, $depth + 1, $args, $output);
// 			}
// 			unset($children_elements[$id]);
// 		}

// 		if (isset($newlevel) && $newlevel) {
// 			//end the child delimiter
// 			$cb_args = array_merge(array(&$output, $depth), $args);
// 			call_user_func_array(array(&$this, 'end_lvl'), $cb_args);
// 		}

// 		//end this element
// 		$cb_args = array_merge(array(&$output, $element, $depth), $args);
// 		call_user_func_array(array(&$this, 'end_el'), $cb_args);
// 	}
// }




// /**
//  * Register custom social nav Menu
//  * of the template.
//  *
//  * @since    1.0.0
//  * @access   private
//  */
// class Cryptogainers_Social_Nav extends Walker_Nav_Menu
// {
// 	public function start_lvl(&$output, $depth = 0, $args = array())
// 	{
// 		$indent = str_repeat("\t", $depth);
// 	}

// 	public function end_lvl(&$output, $depth = 0, $args = array())
// 	{
// 		$indent = str_repeat("\t", $depth);
// 	}

// 	public function start_el(&$output, $item, $depth = 0, $args = null, $id = 0)
// 	{
// 		$indent = ($depth) ? str_repeat("\t", $depth) : '';
// 		$li_attributes = '';
// 		$class_names = $value = '';

// 		$classes = empty($item->classes) ? array() : (array) $item->classes;
// 		$classes[] = ($args->has_children) ? 'dropdown' : '';
// 		$classes[] = ($item->current || $item->current_item_ancestor) ? 'active' : '';
// 		$classes[] = 'menu-item-' . $item->ID;
// 		if ($depth && $args->has_children) {
// 			$classes[] = 'dropdown-submenu';
// 		}

// 		$class_names = implode(' ', apply_filters('nav_menu_css_class', array_filter($classes), $item, $args));

// 		$id = apply_filters('nav_menu_item_id', 'menu-item-' . $item->ID, $item, $args);
// 		$id = strlen($id) ? ' id="' . esc_attr($id) . '"' : '';


// 		$attributes = !empty($item->attr_title) ? ' title="' . esc_attr($item->attr_title) . '"' : '';
// 		$attributes .= !empty($item->target) ? ' target="' . esc_attr($item->target) . '"' : '';
// 		$attributes .= !empty($item->xfn) ? ' rel="' . esc_attr($item->xfn) . '"' : '';
// 		$attributes .= !empty($item->url) ? ' href="' . esc_attr($item->url) . '"' : '';

// 		$item_output = $args->before;


// 		$attributes .= ' class="mr-3 rounded-lg hover:bg-gray-50" target="_blank" ';
// 		$item_output = '<a' . $attributes . '>';
// 		$cryptogainers_menu_icon = get_post_meta($item->ID, "cryptogainers_menu_icon", true);
// 		if (isset($cryptogainers_menu_icon)) {
// 			if (isset($cryptogainers_menu_icon) && !empty($cryptogainers_menu_icon)) {
// 				$item_output .= html_entity_decode(get_post_meta($item->ID, "cryptogainers_menu_icon", true));
// 			} else {
// 				$item_output .= "\n$indent <svg class=\"flex-shrink-0 h-6 w-6 text-indigo-600\" x-description=\"Heroicon name: outline/chart-bar\" xmlns=\"http://www.w3.org/2000/svg\" fill=\"none\" viewBox=\"0 0 24 24\" stroke=\"currentColor\" aria-hidden=\"true\"> \n";
// 				$item_output .= "\n$indent <path stroke-linecap=\"round\" stroke-linejoin=\"round\" stroke-width=\"2\" d=\"M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z\"></path> \n";
// 				$item_output .= "\n$indent </svg> \n";
// 			}
// 		} else if (isset($args->cryptogainers_menu_icon)) {
// 			$item_output .= html_entity_decode($args->cryptogainers_menu_icon);
// 		}

// 		// $item_output .= "\n$indent <div class=\"ml-4\">\n";
// 		// $item_output .= "\n$indent <p class=\"text-base font-medium text-gray-900\">\n";
// 		// $item_output .= __(apply_filters('the_title', $item->title, $item->ID), "cryptogainers");
// 		// $item_output .= "\n$indent </p>\n";
// 		// $item_output .= "\n$indent </div>\n";

// 		$item_output .= '</a>';
// 		$item_output .= $args->after;

// 		$output .= apply_filters('walker_nav_menu_start_el', $item_output, $item, $depth, $args);
// 	}

// 	public function display_element($element, &$children_elements, $max_depth, $depth, $args, &$output)
// 	{
// 		if (!$element) {
// 			return;
// 		}

// 		$id_field = $this->db_fields['id'];

// 		//display this element
// 		if (is_array($args[0])) {
// 			$args[0]['has_children'] = !empty($children_elements[$element->$id_field]);
// 		} elseif (is_object($args[0])) {
// 			$args[0]->has_children = !empty($children_elements[$element->$id_field]);
// 		}

// 		$cb_args = array_merge(array(&$output, $element, $depth), $args);
// 		call_user_func_array(array(&$this, 'start_el'), $cb_args);

// 		$id = $element->$id_field;

// 		// descend only when the depth is right and there are childrens for this element
// 		if (($max_depth == 0 || $max_depth > $depth + 1) && isset($children_elements[$id])) {
// 			foreach ($children_elements[$id] as $child) {
// 				$args[0]->cryptogainers_menu_icon = get_post_meta($child->ID, "cryptogainers_menu_icon", true);
// 				if (!isset($newlevel)) {
// 					$newlevel = true;
// 					//start the child delimiter
// 					$cb_args = array_merge(array(&$output, $depth), $args);
// 					call_user_func_array(array(&$this, 'start_lvl'), $cb_args);
// 				}
// 				$this->display_element($child, $children_elements, $max_depth, $depth + 1, $args, $output);
// 			}
// 			unset($children_elements[$id]);
// 		}

// 		if (isset($newlevel) && $newlevel) {
// 			//end the child delimiter
// 			$cb_args = array_merge(array(&$output, $depth), $args);
// 			call_user_func_array(array(&$this, 'end_lvl'), $cb_args);
// 		}

// 		//end this element
// 		$cb_args = array_merge(array(&$output, $element, $depth), $args);
// 		call_user_func_array(array(&$this, 'end_el'), $cb_args);
// 	}
// }
