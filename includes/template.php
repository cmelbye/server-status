<?php

class template {
	protected $path, $vars, $use_layout, $layout;
	protected $layout_file = null;
	
	public function __construct( $path, $use_layout = true, $layout_file = null ) {
		$this->path = rtrim( $path, "/" );
		$this->vars = array();
		$this->use_layout = $use_layout;
		
		if( $use_layout ) {
			$this->layout = new template( $this->path, false );
			
			if( $layout_file )
				$this->layout_file = $layout_file;
			else
				$this->layout_file = "layout";
		}
	}
	
	public function getLayout() { return $this->layout; }
	
	public function set( $key, $value ) { $this->vars[ $key ] = $value; }
	
	public function execute( $file ) {
		$template = $this->_execute( $file );
		
		if( $this->use_layout ) {
			$this->layout->set( 'yield', $template );
			return $this->getLayout()->execute( $this->layout_file );
		} else {
			return $template;
		}
	}
	
	private function _execute( $file ) {
		if( !strstr($file, ".phtml") )
			$file .= ".phtml";
		
		extract( $this->vars );
		ob_start();
		include( $this->path . "/" . $file );
		$contents = ob_get_clean();
		
		return $contents;
	}
}
