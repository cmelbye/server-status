<?php

class command {
	protected $_tpl;
	
	function __construct() {
		global $templatePath;
		$this->_tpl = new template( $templatePath );
	}
}
