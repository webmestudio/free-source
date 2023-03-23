<?php

class Database {
	
	// Object Property
	private $dbs;
	private $error;

	public function __construct($engine, $host, $user, $pass, $dbname, $port) {
		// set DSN
		$dsn = $engine . ':host=' . $host . '; port=' . $port . '; dbname=' . $dbname;

		// Set options
        $options = array(
            PDO::ATTR_PERSISTENT 	=> true,
            PDO::ATTR_ERRMODE 		=> PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_EMULATE_PREPARES => false
        );

        // Create a new PDO instanace
        try {
            $this->dbs = new PDO($dsn, $this->user, $this->pass, $options);
            
            /*
            if($this->dbs == null) {
                echo 'Connection Database Failed : You Must Set Database Name, Please Check /config/database.php';
                die;
            }
            */         
        }
        // Catch any errors
        catch(PDOException $e) {
        	echo('Connection Failed : '. $e->getMessage());
            die;
		}	
	}
    
    public function query($query) {
        $this->stmt = $this->dbs->prepare($query);
    }
    
    public function bind($param, $value, $type = null) {
        if (is_null($type)) {
            switch (true) {
                case is_int($value):
                    $type = PDO::PARAM_INT;
                    break;
                case is_bool($value):
                    $type = PDO::PARAM_BOOL;
                    break;
                case is_null($value):
                    $type = PDO::PARAM_NULL;
                    break;
                default:
                    $type = PDO::PARAM_STR;
            }
        }
        $this->stmt->bindValue($param, $value, $type);
    }
    
    public function execute() {
		return $this->stmt->execute();
    }
	
	/**
	 * Default Param $setType = PDO::FETCH_ASSOC
	 * Kamu Bisa Cek http://php.net/manual/en/pdo.constants.php
	 */
	public function resultAll($setType = 'PDO::FETCH_ASSOC') {
		$this->execute();
		return $this->stmt->fetchAll($setType);
	}
	
	/**
	 * Default Param $setType = PDO::FETCH_ASSOC
	 * Kamu Bisa Set Cek http://php.net/manual/en/pdo.constants.php
	 */
	public function singleAll($setType = 'PDO::FETCH_ASSOC') {
		$this->execute();
		return $this->stmt->fetch($setType);
	}
	
	public function rowCount() {
		return $this->stmt->rowCount();
	}
	
	public function insert($dataArray, $tableName = null) {		
		// pecah data array
		foreach($dataArray as $column => $values) {
			// format string untuk kunci
			// eg -> fieldname
			$field[] = $column;
			
			// format parameter nilai untuk kolom 
			//eg -> insert into tablename () values (:kolom1, :kolom2)
			$fieldParams[] = ':'.$column;
			
			// array add string ':column' untuk method execute
			$executed[':'.$column] = $values; 
		}
		
		// output -> field, field
		$field = implode(', ', $field);
		// output -> :kolom1, :kolom2
		$fieldParams = implode(', ', $fieldParams);
	
		// sql command
		$sql = $this->dbs->prepare("INSERT INTO $tableName ($field) VALUES ($fieldParams) ");
		return $sql->execute($executed);
	}
	
	public function update($dataArray, $find = null, $tableName = null) {
		// Defines
		foreach($dataArray as $column => $values) {
			// format string untuk kunci
			// eg -> fieldname
			$set[] = $column . '=' . ':' .$column;
			
			// array add string ':column' untuk method execute
			$executed[':'.$column] = $values;
		}
		// Set Field => Value
		$set = implode(', ', $set);
		
		// sql command
		$sql = $this->dbs->prepare("UPDATE $tableName SET $set WHERE $find");
		return $sql->execute($executed);
	}
	
	public function lastInsertId() {
		return $this->dbs->lastInsertId();
	}
	
	public function beginTransaction() {
		return $this->dbs->beginTransaction();
	}
	
	public function endTransaction() {
		return $this->dbs->commit();
	}
	
	public function cancelTransaction() {
		return $this->dbs->rollBack();
	}
	
	public function debugDumpParams() {
		return $this->stmt->debugDumpParams();
	}
}

?>