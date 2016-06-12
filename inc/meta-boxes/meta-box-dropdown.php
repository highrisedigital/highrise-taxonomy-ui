<?php
/**
 * outputs the contents for the radio meta box
 *
 * @since 1.0.0
 *
 * @param WP_Post $post The current post object
 * @param array   $box  the meta box args
 */
function hdtui_taxonomy_dropdown_meta_box( $post, $box ) {

	/* set some default arguments */
	$defaults = array( 'taxonomy' => 'category' );

	/* if the box args is not set or it is not an array */
	if ( ! isset( $box[ 'args' ] ) || ! is_array( $box[ 'args' ] ) ) {
		$args = array();
	} else {
		$args = $box[ 'args' ];
	}

	/* parse the defaults with the sent args */
	$args = wp_parse_args( $args, $defaults );

	/* get this taxonomies name */
	$tax_name = esc_attr( $args[ 'taxonomy' ] );

	/* lets check whether this taxonomy is hierarchical */
	if ( is_taxonomy_hierarchical( $tax_name ) ) {

		/* set the div class to hierarchical */
		$wrapper_class = 'categorydiv';

	/* not hierarchical */
	} else {

		/* set non hierarchical class */
		$wrapper_class = 'tagsdiv';

	}

	?>

	<div id="taxonomy-<?php echo $tax_name; ?>" class="<?php echo esc_attr( $wrapper_class ); ?>">

		<style type="text/css">
			/* Style for the 'none' item: */
			.hdtui-dropdown {
				width: 100%;
			}
		</style>

		<?php

			/**
			 * Execute code before the taxonomy meta box content outputs to the page.
			 *
			 * @since 1.0.0
			 *
			 * @param stdClass $tax  The current taxonomy object.
			 * @param WP_Post  $post The current post object.
			 */
			do_action( 'hdtui_radio_meta_box_before', $taxonomy, $post );

			/* get the current terms for this object e.g. post */
	    	$selected = wp_get_object_terms( $post->ID, $tax_name, array( 'fields' => 'ids' ) );

	    	/* get the list of terms - this spits out the select input buttons! */
	    	wp_dropdown_categories(
	    		array(
	    			'taxonomy'			=> $tax_name,
	    			'selected'			=> reset( $selected ),
	    			'option_none_value'	=> 0,
	    			'show_option_none'	=> '-- Select --',
	    			'hide_empty'		=> false,
	    			'name'              => 'tax_input[' . $tax_name . ']',
	    			'id'                => $tax_name . '-dropdown',
	    			'class'				=> 'hdtui-dropdown'
	    		)
	    	);

			/**
			 * Execute code after the taxonomy meta box content outputs to the page.
			 *
			 * @since 1.0.0
			 *
			 * @param stdClass $tax  The current taxonomy object.
			 * @param WP_Post  $post The current post object.
			 */
			do_action( 'hdtui_radio_meta_box_after', $taxonomy, $post );

		?>

	</div>

	<?php

}