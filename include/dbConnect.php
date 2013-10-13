<?php

/* OLD PROCEDURAL STYLE TO CONNECTING TO DB.

//Step 1- Create your database server connection
$connection = mysql_connect('localhost', 'root', 'rajbad1');

// Step 2 - Connect to the database
mysql_select_db('ascoopdb', $connection);

*/



//NEW OBJECT-ORIENTED METHOD TO CONNECTING TO DATBASE.
//Connection can now be more Database Neutral easily

//require_once("config.php"); - removed as it conflicts with C:\xampp\php\PEAR

class MySQLDatabase {
	
	private $connection;
	
  function __construct() {
    $this->open_connection();
  }

	public function open_connection() {
		$this->connection = mysql_connect('localhost', 'root', 'rajbad1');
		if (!$this->connection) {
			die("Database connection failed: " . mysql_error());
		} else {
			$db_select = mysql_select_db('ascoopdb', $this->connection);
			if (!$db_select) {
				die("Database selection failed: " . mysql_error());
			}
		}
	}

	public function close_connection() {
		if(isset($this->connection)) {
			mysql_close($this->connection);
			unset($this->connection);
		}
	}

	public function query($sql) {
		$result = mysql_query($sql, $this->connection);
		$this->confirm_query($result);
		return $result;
	}
	
	public function escape_value( $value ) {
		$magic_quotes_active = get_magic_quotes_gpc();
		$new_enough_php = function_exists( "mysql_real_escape_string" ); // i.e. PHP >= v4.3.0
		if( $new_enough_php ) { // PHP v4.3.0 or higher
			// undo any magic quote effects so mysql_real_escape_string can do the work
			if( $magic_quotes_active ) { $value = stripslashes( $value ); }
			$value = mysql_real_escape_string( $value );
		} else { // before PHP v4.3.0
			// if magic quotes aren't already on then add slashes manually
			if( !$magic_quotes_active ) { $value = addslashes( $value ); }
			// if magic quotes are active, then the slashes already exist
		}
		return $value;
	}
	
	// "database-neutral" methods
  public function fetch_array($result_set) {
    return mysql_fetch_array($result_set);
  }
  
  public function num_rows($result_set) {
   return mysql_num_rows($result_set);
  }
  
  public function insert_id() {
    // get the last id inserted over the current db connection
    return mysql_insert_id($this->connection);
  }
  
  public function affected_rows() {
    return mysql_affected_rows($this->connection);
  }

  
	
	private function confirm_query($result) {
		if (!$result) {
			die("Database query failed: " . mysql_error());
		}
	}
	
}

$database = new MySQLDatabase();
$db =& $database;


?>