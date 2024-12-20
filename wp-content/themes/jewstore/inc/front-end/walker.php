<?php

class Wpdevart_Walker_Nav_Primary extends Walker_Nav_menu {
	
	function start_lvl( &$menu_output, $depth = 0, $args = array() ){
		$indent = str_repeat("\t",$depth);
		$submenu = ($depth > 0) ? ' sub-menu' : '';
		$menu_output .= "<ul\n$indent class=\"dropdown-menu$submenu depth_$depth\">\n";
	}
	 
	function start_el( &$menu_output, $item, $depth = 0, $args = array(), $id = 0 ){
		$indent = ( $depth ) ? str_repeat("\t",$depth) : '';
		$li_attributes = '';
		$class_names = $value = '';
		$classes = empty( $item->classes ) ? array() : (array) $item->classes;
		$classes[] = ($args->walker->has_children) ? 'dropdown' : '';
		$classes[] = ($item->current || $item->current_item_ancestor) ? 'active' : '';
		$classes[] = 'menu-item-' . $item->ID;
		if( $depth && $args->walker->has_children ){
			$classes[] = 'dropdown-submenu';
		}
		$class_names =  join(' ', apply_filters('nav_menu_css_class', array_filter( $classes ), $item, $args ) );
		$class_names = ' class="' . esc_attr($class_names) . '"';
		$id = apply_filters('nav_menu_item_id', 'menu-item-'.$item->ID, $item, $args);
		$id = strlen( $id ) ? ' id="' . esc_attr( $id ) . '"' : '';
		$menu_output .= $indent . '<li' . $id . $value . $class_names . $li_attributes . '>';
		$attributes = ! empty( $item->attr_title ) ? ' title="' . esc_attr($item->attr_title) . '"' : '';
		$attributes .= ! empty( $item->target ) ? ' target="' . esc_attr($item->target) . '"' : '';
		$attributes .= ! empty( $item->xfn ) ? ' rel="' . esc_attr($item->xfn) . '"' : '';
		$attributes .= ! empty( $item->url ) ? ' href="' . esc_attr($item->url) . '"' : '';
		$attributes .= ( $args->walker->has_children ) ? ' class="dropdown-toggle" data-toggle="dropdown"' : '';
		$menu_item_output = $args->before;
		if( $depth<1 ){
			$menu_item_output .= '<a class="wpdevart-menu-items-color"' . $attributes . '>';
		} else {
			$menu_item_output .= '<a class="wpdevart-sub-menu-link-color"' . $attributes . '>';
		};
		$menu_item_output .= $args->link_before . apply_filters( 'the_title', $item->title, $item->ID ) . $args->link_after;
		if( $depth<1 ){
			$menu_item_output .= ( $args->walker->has_children ) ? ' </a><button class="wpdevart-menu-button-icon wpdevart-hide-on-mobile"><i class="fa fa-angle-down"></i></button>' : '</a>';
		} else {
			$menu_item_output .= ( $args->walker->has_children ) ? ' </a><button class="wpdevart-sub-menu-button-icon wpdevart-hide-on-mobile"><i class="fa fa-angle-down"></i></button>' : '</a>';
		};
		$menu_item_output .= $args->after;
		$menu_output .= apply_filters ( 'walker_nav_menu_start_el', $menu_item_output, $item, $depth, $args );
	}
	
}