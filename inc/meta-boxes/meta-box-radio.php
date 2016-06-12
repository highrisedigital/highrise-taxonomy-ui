<?php
/**
 * outputs the contents for the radio meta box
 *
 * @since 1.0.0
 *
 * @param WP_Post $post The current post object
 * @param array   $box  the meta box args
 */
function hdtui_taxonomy_radio_meta_box( $post, $box ) {

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

	/* get this taxonomies object */
	$taxonomy = get_taxonomy( $args[ 'taxonomy' ] );

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

		?>

        <ul id="<?php echo $tax_name; ?>checklist" data-wp-lists="list:<?php echo $tax_name; ?>" class="categorychecklist form-no-clear">

            <?php

            	/* create a new instance of our radio list walker class */
            	$radio_walker = new Highrise_Walker_Taxonomy_Radio_List();

            	/* get the list of terms - this spits out the radio buttons! */
            	wp_terms_checklist(
            		$post->ID,
            		array(
            			'taxonomy'		=> $tax_name,
            			'walker'		=> $radio_walker,
            			'checked_ontop'	=> false
            		)
            	);

            ?>

            <hr />

            <li id="<?php echo $tax_name; ?>-0">

        		<label class="selectit">
        			<input type="radio" name="tax_input[<?php echo $tax_name; ?>][]" value="0">
        			<?php _e( 'None', 'highrise-taxonomy-ui' ); ?>
        		</label>

        	</li>

		</ul>

        <?php

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