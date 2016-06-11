<?php
/**
 * Extends the WP walker class which displays tree like structures
 * this class makes the walker class output as a select input type
 * Initially from https://github.com/johnbillion/extended-taxos/blob/master/extended-taxos.php#L998
 * @link https://profiles.wordpress.org/johnbillion
 *
 * @since 1.0.0
 * @uses Walker
 */
class Highrise_Walker_Taxonomy_Dropdown_List extends Walker {
	/**
	 * Some member variables you don't need to worry too much about:
	 */
	public $tree_type = 'category';
	public $db_fields = array(
		'parent' => 'parent',
		'id'     => 'term_id',
	);

	public $field = null;

	/**
	 * Class constructor.
	 *
	 * @param array $args Optional arguments.
	 */
	public function __construct( $args = null ) {
		if ( $args && isset( $args['field'] ) ) {
			$this->field = $args['field'];
		}
	}

	/**
	 * Start the element output.
	 *
	 * @param string $output            Passed by reference. Used to append additional content.
	 * @param object $object            Term data object.
	 * @param int    $depth             Depth of term in reference to parents.
	 * @param array  $args              Optional arguments.
	 * @param int    $current_object_id Current object ID.
	 */
	public function start_el( &$output, $object, $depth = 0, $args = array(), $current_object_id = 0 ) {
		
		/* create some padding */
		$pad = str_repeat( '&nbsp;', $depth * 3 );

		/* get this taxonomies object */
		$tax = get_taxonomy( $args['taxonomy'] );
		
		if ( $this->field ) {
			$value = $object->{$this->field};
		} else {
			$value = $tax->hierarchical ? $object->term_id : $object->name;
		}

		if ( empty( $object->term_id ) && ! $tax->hierarchical ) {
			$value = '';
		}

		$cat_name = apply_filters( 'list_cats', $object->name, $object );
		$output .= "\t<option class=\"level-{$depth}\" value=\"" . esc_attr( $value ) . '"';
		if ( isset( $args['selected_cats'] ) && in_array( $value, (array) $args['selected_cats'] ) ) {
			$output .= ' selected="selected"';
		} elseif ( isset( $args['selected'] ) && in_array( $object->term_id, (array) $args['selected'] ) ) {
			$output .= ' selected="selected"';
		}
		$output .= '>';
		$output .= $pad . esc_html( $cat_name );
		if ( $args['show_count'] ) {
			$output .= '&nbsp;&nbsp;(' . esc_html( number_format_i18n( $object->count ) ) . ')';
		}
		$output .= "</option>\n";
	}
}