<?php

function border_beagle_timber_blocks() {
	return ['blocks'];
}
add_filter( 'timber/acf-gutenberg-blocks-templates', 'border_beagle_timber_blocks' );
