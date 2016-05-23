<?php

class SQLQuery {

    protected $_dbh;
    protected $_stmt;

    /** Connects to database **/

    public function connect($address, $account, $pwd, $name) {
	
    $options = array(
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_PERSISTENT => true
            );
    $dsn = "mysql:host=$address;dbname=$name";
   try {
        $this->_dbh = new PDO($dsn, $account, $pwd, $options);
    } catch( PDOException $e ) {
       die( $e->getMessage() );
    }
return $this->_dbh;

    }

    public function query($query)
    {
        $this->_stmt = $this->_dbh->prepare($query);
        return $this->_stmt;
    }

    public function bind($pos, $value, $type = null)
    {
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
        $this->_stmt->bindValue($pos, $value, $type);
    }

    public function execute()
    {
        $this->_queryCounter++;
        return $this->_stmt->execute();
    }

    public function resultset()
    {
        $this->execute();
        return $this->_stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function single()
    {
        $this->execute();
        return $this->_stmt->fetch(PDO::FETCH_ASSOC);
    }

    // returns last insert ID
    //!!!! if called inside a transaction, must call it before closing the transaction!!!!!!
    public function lastInsertId()
    {
        return $this->_dbh->lastInsertId();
    }

    // begin transaction // must be innoDatabase table
    public function beginTransaction()
    {
        return $this->_dbh->beginTransaction();
    }

    // end transaction
    public function endTransaction()
    {
        return $this->_dbh->commit();
    }

    // cancel transaction
    public function cancelTransaction()
    {
        return $this->_dbh->rollBack();
    }

    // returns number of rows updated, deleted, or inserted
    public function rowCount()
    {
        return $this->_stmt->rowCount();
    }

    // returns the equivalent to mysql_num_rows()
    public function fetchColumn()
    {
        return $this->_stmt->fetchColumn();
    }

    // returns number of queries executed
    public function queryCounter()
    {
        return $this->_queryCounter;
    }

    public function debugDumpParams()
    {
        return $this->_stmt->debugDumpParams();
    }

}

/**
 * Establish a DB connection.
 */
/*
$database = new Database('root', '', 'testing');
*/


/**
 * Select a row of items from DB
 */
/*
$database->query('SELECT col1, col2, col3 FROM testing WHERE id > ? LIMIT ?');
$database->bind(1, 1);
$database->bind(2, 5);
$row = $database->single();
echo "<pre>";
print_r($row);
echo "</pre>";
*/

/**
 * Create a new query, bind values and return a resultset.
 */
/*
$database->query('SELECT col1, col2, col3 FROM testing WHERE col2 = :col2 LIMIT :limit');
$database->bind(':col2', 'hello 2');
$database->bind(':limit', 10);
$rs = $database->resultset();

foreach ($rs as $row) {
    echo $row['col1'] . '<br>';
    echo $row['col2'] . '<br>';
    echo $row['col3'] . '<br>';
}
*/

/**
 * Show number of queries executed on DB
 */
/*
echo $database->queryCounter();
*/

/**
 * ################################# ENDS PDO WRAPPER ################################
**/
