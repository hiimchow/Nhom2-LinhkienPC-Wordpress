<?php
/**
 * Custom wp_nav_menu walker for Category menu.
 *
 * @package    StorePro
 * @author     Theme Junkie
 * @copyright  Copyright (c) 2014, Theme Junkie
 * @license    http://www.gnu.org/licenses/gpl-2.0.html
 * @since      1.0.0
 */
class Storepro_Category_Nav_Walker extends Walker_Nav_Menu {

	function start_lvl( &$output, $depth = 0, $args = array() ) {
		$indent = str_repeat("\t", $depth);
		if ( $depth == 0 ) {
			$output .= "\n$indent\n";
		}
	}

	function end_lvl( &$output, $depth = 0, $args = array() ) {
		$indent = str_repeat("\t", $depth);
		if ( $depth == 0 ) {
			$output .= "$indent\n";
		}
	}

	function start_el( &$output, $item, $depth = 0, $args = array(), $id = 0 ) {
		$indent = ( $depth ) ? str_repeat( "\t", $depth ) : '';
		
		$class_names = $value = $child_icon = '';

		$classes = empty( $item->classes ) ? array() : (array) $item->classes;
		$classes[] = 'menu-item-' . $item->ID;
		
		// If has children.
		if ( $args->has_children && $item->menu_item_parent == 0 ) {
			$classes[] = 'catagory-subdropdown';
		}

		if ( $depth == 1 ) {
			$classes[] = 'link-heading';
		}

		$class_names = join( ' ', apply_filters( 'nav_menu_css_class', array_filter( $classes ), $item, $args ) );
		$class_names = $class_names ? ' class="' . esc_attr( $class_names ) .' '. $depth . '"' : '';

		$id = apply_filters( 'nav_menu_item_id', 'menu-item-'. $item->ID, $item, $args );
		$id = $id ? ' id="' . esc_attr( $id ) . '"' : '';

		if ( $depth == 1 ) {
			$output .= $indent . '<div class="uk-width-1-2"><ul>';
		}

		$output .= $indent . '<li ' . $id . $class_names .'>';

		$attributes  = ! empty( $item->attr_title ) ? ' title="'  . esc_attr( $item->attr_title ) .'"' : '';
		$attributes .= ! empty( $item->target )     ? ' target="' . esc_attr( $item->target     ) .'"' : '';
		$attributes .= ! empty( $item->xfn )        ? ' rel="'    . esc_attr( $item->xfn        ) .'"' : '';
		$attributes .= ! empty( $item->url )        ? ' href="'   . esc_attr( $item->url        ) .'"' : '';

		// Add icon font to the parent-menu.
		if ( $depth == 0 ) {
		    $child_icon .= '<i class="uk-icon-angle-right"></i>';
		}

		// Menu output.
		$item_output = sprintf( '%1$s<a%2$s>%3$s%4$s%5$s%6$s</a>%7$s',
			$args->before,
			$attributes,
			$args->link_before,
			apply_filters( 'the_title', $item->title, $item->ID ),
			$args->link_after,
			$child_icon,
			$args->after
		);

		// Build html
		$output .= apply_filters( 'walker_nav_menu_start_el', $item_output, $item, $depth, $args );

		if ( $depth == 0 && ! count( $item->children ) == 0 ) {
			$output .= '<div class="uk-dropdown uk-dropdown-width-2 subdropdown">';
			$output .= '<div class="uk-grid">';
		}

	}

	function end_el( &$output, $item, $depth = 0, $args = array() ) {
		if ( $depth == 0 && ! count( $item->children ) == 0 ) {
			$output .= '</div></div>';
		}
		$output .= "</li>\n";
		if ( $depth == 1 ) {
			$output .= '</ul></div>';
		}
	}

	function display_element( $element, &$children_elements, $max_depth, $depth=0, $args, &$output ) {
		$id_field = $this->db_fields['id'];
		if ( is_object( $args[0] ) ) {
			$args[0]->has_children = ! empty( $children_elements[$element->$id_field] );
		}
		return parent::display_element( $element, $children_elements, $max_depth, $depth, $args, $output );
	}

}