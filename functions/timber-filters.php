<?php

function ig_evergreen_timber_blocks() {
	return ['blocks'];
}
add_filter( 'timber/acf-gutenberg-blocks-templates', 'ig_evergreen_timber_blocks' );
