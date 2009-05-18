<?php

class home extends command {
	function get() {
		echo $this->_tpl->execute( 'index' );
	}
	
	function post() {
		
	}
}

class status extends command {
	function get() {
		global $statusPath;
		$statuses = array();
		$status_file = file_get_contents( $statusPath );
		
		foreach( explode( "\n", $status_file ) as $line ) {
			if( substr( $line, 0, 1 ) == '#' )
				continue;
			
			$line = trim( $line );
			if( $line == '' )
				continue;
			
			$parts = explode( ' ', $line, 3 );
			if( !isset( $parts[2] ) || ( $parts[2] == '' ) )
				$parts[2] = false;
			
			$statuses[ $parts[0] ] = array(
				'status' => $parts[1],
				'description' => $parts[2]
			);
		}
		
		$this->_tpl->set( 'statuses', $statuses );
		echo $this->_tpl->execute( 'status' );
	}
}

class edit_status extends command {
	function get() {
		global $statusPath;
		$status_data = file_get_contents( $statusPath );
		$this->_tpl->set( 'status_data', $status_data );
		echo $this->_tpl->execute( 'status_edit_form' );
	}
	
	function post() {
		global $updatePassword, $statusPath;

		$password = $_POST['update_password'];
		if( $password == $updatePassword ) {
			$status_data = stripslashes($_POST['status_data']);
			file_put_contents( $statusPath, $status_data );
			header('Location: /status');
			return;
		} else {
			header('Location: /status');
			return;
		}
	}
}
