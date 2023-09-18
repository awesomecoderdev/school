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
	public $start_lvl_class = "relative w-full h-5 max-w-sm shadow z-50 bg-primary-500";


	/**
	 * Start the levels
	 *
	 * @since    1.0.0
	 */
	public function start_lvl(&$output, $depth = 0, $args = array())
	{
		$indent = str_repeat("\t", $depth);
		$output .= "\n$indent <div class=\"$this->start_lvl_class\">\n";

		$output .= "\n$indent <div class=\"relative \"> \n";
		$output .= "\n$indent <div class=\"rounded-lg shadow-lg ring-1 ring-black ring-opacity-5 overflow-hidden\"> \n";
		$output .= "\n$indent <div class=\"relative grid gap-6 bg-white px-2 py-3 sm:gap-8 sm:p-8\"> \n";
	}


	/**
	 * End the levels
	 *
	 * @since    1.0.0
	 */
	public function end_lvl(&$output, $depth = 0, $args = array())
	{
		$indent = str_repeat("\t", $depth);
		$output .= "\n$indent </div> \n";
		$output .= "\n$indent </div> \n";
		$output .= "\n$indent </div> \n";

		$output .= "\n$indent </div> \n";
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

		$id = apply_filters('nav_menu_item_id', 'menu-item-' . $item->ID, $item, $args);
		$id = strlen($id) ? ' id="' . esc_attr($id) . '"' : '';

		$output .= $indent . '<li' . $id . $value . $class_names . $li_attributes . '>';

		$attributes = !empty($item->attr_title) ? ' title="' . esc_attr($item->attr_title) . '"' : '';
		$attributes .= !empty($item->target) ? ' target="' . esc_attr($item->target) . '"' : '';
		$attributes .= !empty($item->xfn) ? ' rel="' . esc_attr($item->xfn) . '"' : '';
		$attributes .= !empty($item->url) ? ' href="' . esc_attr($item->url) . '"' : '';
		$attributes .= ($args->has_children) ? ' class="dropdown_item text-gray-500 group bg-white rounded-md inline-flex items-center text-base font-medium hover:text-gray-900 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" aria-expanded="false"' : '';

		$item_output = $args->before;
		// $item_output .= '<a' . $attributes . '>';
		// $item_output .= $args->link_before . apply_filters('the_title', $item->title, $item->ID) . $args->link_after;

		if ($depth == 0) {
			$attributes .= ' class="relative text-base font-medium text-gray-500 hover:text-gray-900"';
			$item_output = '<a' . $attributes . '>';

			$item_output .= $args->link_before . __(apply_filters('the_title', $item->title, $item->ID), "cryptogainers") . $args->link_after;
		} else {
			$attributes .= ' class="-m-3 p-3 flex items-start rounded-lg hover:bg-gray-50"';
			$item_output = '<a' . $attributes . '>';

			$cryptogainers_menu_icon = get_post_meta($item->ID, "cryptogainers_menu_icon", true);
			if (isset($cryptogainers_menu_icon)) {
				if (isset($cryptogainers_menu_icon) && !empty($cryptogainers_menu_icon)) {
					$item_output .= html_entity_decode(get_post_meta($item->ID, "cryptogainers_menu_icon", true));
				} else {
					$item_output .= "\n$indent <svg class=\"flex-shrink-0 h-6 w-6 text-indigo-600\" x-description=\"Heroicon name: outline/chart-bar\" xmlns=\"http://www.w3.org/2000/svg\" fill=\"none\" viewBox=\"0 0 24 24\" stroke=\"currentColor\" aria-hidden=\"true\"> \n";
					$item_output .= "\n$indent <path stroke-linecap=\"round\" stroke-linejoin=\"round\" stroke-width=\"2\" d=\"M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z\"></path> \n";
					$item_output .= "\n$indent </svg> \n";
				}
			} else if (isset($args->cryptogainers_menu_icon)) {
				$item_output .= html_entity_decode($args->cryptogainers_menu_icon);
			}



			$item_output .= "\n$indent <div class=\"ml-4\">\n";
			$item_output .= "\n$indent <p class=\"text-base font-medium text-gray-900\">\n";
			$item_output .= __(apply_filters('the_title', $item->title, $item->ID), "cryptogainers");
			$item_output .= "\n$indent </p>\n";
			$item_output .= "\n$indent </div>\n";
		}


		$drop_icon = "\n$indent <svg class=\"text-gray-400 ml-2 h-5 w-5 group-hover:text-gray-500\" xmlns=\"http://www.w3.org/2000/svg\" viewBox=\"0 0 20 20\" fill=\"currentColor\" aria-hidden=\"true\">\n";
		$drop_icon .= "\n$indent <path fill-rule=\"evenodd\" d=\"M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z\" clip-rule=\"evenodd\" /> \n";
		$drop_icon .= "\n$indent </svg> \n";

		$item_output .= (($depth == 0 || 1) && $args->has_children) ? "$drop_icon </a>" : '</a>';
		$item_output .= $args->after;

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
				$args[0]->cryptogainers_menu_icon = get_post_meta($child->ID, "cryptogainers_menu_icon", true);
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
