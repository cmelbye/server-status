<?php

function buildStatus( $status ) {
	switch( $status ) {
		case 'up':
			$image = 'tick';
			$text = 'Up';
			break;
		case 'warn':
			$image = 'error';
			$text = 'Warning';
			break;
		case 'down':
			$image = 'cross';
			$text = 'Down';
			break;
		default:
			$image = 'help';
			$text = 'Unknown';
			break;
	}
	
	return "<img src=\"/images/$image.png\" alt=\"$image\" /> $text";
}
