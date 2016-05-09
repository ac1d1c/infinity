<?php

class InfinityExtension_MySQLi {
	private static $connection;
	
	public static function connect( $host, $username, $password, $database ) {
		$connection = mysqli_connect( $host, $username, $password, $database );
		if( !mysqli_connect_errno() ) {
			self::$connection = $connection;
		}
	}
	
	public static function close() {
		mysqli_close( self::$connection );
	}
	
	public static function query( $query ) {
		if( isset( self::$connection ) ) {
			if( $r = mysqli_query( self::$connection, $query ) ) {
                if( $r === true ) {
                    return true;
                } else {
                    $rows = [];
                    while( $row = mysqli_fetch_assoc( $r ) ) {
                        array_push( $rows, $row );
                    }
                    return $rows;
                }
			} else {
                return false;
            }
		} else {
			return false;
		}
	}
	
	public static function select( $select, $from, $where ) {
		if( isset( self::$connection ) ) {
			if( $r = mysqli_query( self::$connection, 'SELECT ' . $select . ' FROM ' . $from . ' WHERE ' . $where . ';' ) ) {
				$rows = [];
				while( $row = mysqli_fetch_assoc( $r ) ) {
					array_push( $rows, $row );
				}
				return $rows;
			}
		} else {
			return false;
		}
	}
	
	public static function delete() {
        return false;
	}
	
	public static function insert() {
        return false;
	}
	
	public static function update() {
        return false;
	}
}

?>