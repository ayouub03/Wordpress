<?php
	function wpdevart_breadcrumbs(){
			$delimiter 	= '';
			$home 		= esc_html( get_theme_mod( 'wpdevart_jewstore_page_breadcrumbs_home_text' ) );
			$showCurrent= esc_html__('1','jewstore');
			$before		= '<li class="active">';
			$after 		= '</li>';
			global $post;
			$homeLink = home_url();
		
			echo '<li><a href="' . esc_url($homeLink) . '">' . esc_html($home) . '</a></li>';
	
			if ( is_single() && !is_attachment() ) {
				if ( get_post_type() != 'post' ) {
					$post_type = get_post_type_object(get_post_type());
					$slug = $post_type->rewrite;
					echo '<li><a href="' . esc_url($homeLink) . '/' . $slug['slug'] . '/">' . $post_type->labels->singular_name . '</a>';
					if ($showCurrent == 1) echo ' ' . esc_attr($delimiter) . $before . esc_html(get_the_title()) . $after;
				} else {
					$cat = get_the_category(); $cat = $cat[0];
					$cats = get_category_parents($cat, TRUE, '' . esc_attr($delimiter) . '');
					if ($showCurrent == 0) $cats = preg_replace("#^(.+)\s$delimiter\s$#", "$1", $cats);
					echo $before . $cats . $after;
					if ($showCurrent == 1) echo $before . esc_html(get_the_title()) . $after;
				}
			} 
			elseif ( is_page() && !$post->post_parent ) {
				if ($showCurrent == 1) echo $before . esc_html(get_the_title()) . $after;
			} 
			elseif ( is_page() && $post->post_parent ) {
				$parent_id  = $post->post_parent;
				$breadcrumbs = array();
				while ($parent_id) {
					$page = get_page($parent_id);
					$breadcrumbs[] = '<a href="' . esc_url(get_permalink($page->ID)) . '">' . esc_html(get_the_title($page->ID)) . '</a>' . '';
					$parent_id  = $page->post_parent;
				}
				$breadcrumbs = array_reverse($breadcrumbs);
				for ($i = 0; $i < count($breadcrumbs); $i++) {
					echo $before . $breadcrumbs[$i] . $after;
					if ($i != count($breadcrumbs)-1) echo ' ' . esc_attr($delimiter) . '';
				}
				if ($showCurrent == 1) echo ' ' . esc_attr($delimiter) . ' ' . $before . esc_html(get_the_title()) . $after;
			} 

			echo '</li>';
	}