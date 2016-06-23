<?php

/**
 * @author Michael Slyshkin <m.slyshkin@gmail.com>
 */

namespace RsORM\Driver;

use RsORM\Query\Engine\MySQL\Statement;
use RsORM\Driver\Exception\DB\Connection;
use RsORM\State;

class MySQL {
    
    const UTF8 = "utf8";
    
    /**
     * @var \PDO
     */
    private $_dbh;
    
    /**
     * @var string
     */
    private $_host = "127.0.0.1";
    
    /**
     * @var int
     */
    private $_port = 3306;
    
    /**
     * @var string
     */
    private $_dbname = null;
    
    /**
     * @var string
     */
    private $_user = "root";
    
    /**
     * @var string
     */
    private $_pass = "";
    
    /**
     * @var string
     */
    private $_charset = self::UTF8;
    
    /**
     * @var array
     */
    private $_options = [];
    
    /**
     * @param string $host
     * @param int $port
     * @param string $user
     * @param string $pass
     * @param string $dbname
     */
    public function __construct($host = null, $port = null, $user = null, $pass = null, $dbname = null) {
        $this->_host = $host === null ? $this->_host : $host;
        $this->_port = $port === null ? $this->_port : $port;
        $this->_user = $user === null ? $this->_user : $user;
        $this->_pass = $pass === null ? $this->_pass : $pass;
        $this->_dbname = $dbname;
    }
    
    /**
     * @param string $charset
     */
    public function setCharset($charset) {
        $this->_charset = $charset;
    }
    
    /**
     * @param array $options
     */
    public function setOptions(array $options) {
        $this->_options = $options;
    }
    
    /**
     * @param Statement\AbstractStatement $statement
     * @return array
     */
    public function fetchAssoc(Statement\AbstractStatement $statement) {
        if (!$sth = $this->_query($statement)) {
            return null;
        }
        return $sth->fetch(\PDO::FETCH_ASSOC);
    }
    
    /**
     * @param Statement\AbstractStatement $statement
     * @return array
     */
    public function fetchAllAssoc(Statement\AbstractStatement $statement) {
        if (!$sth = $this->_query($statement)) {
            return [];
        }
        return $sth->fetchAll(\PDO::FETCH_ASSOC);
    }
    
    /**
     * @param Statement\AbstractStatement $statement
     * @param string $class
     * @return State\Entity
     */
    public function fetchClass(Statement\AbstractStatement $statement, $class) {
        if (!$sth = $this->_query($statement)) {
            return null;
        }
        return $sth->fetch(\PDO::FETCH_CLASS, $class);
    }
    
    /**
     * @param Statement\AbstractStatement $statement
     * @param string $class
     * @return State\Entity[]
     */
    public function fetchAllClass(Statement\AbstractStatement $statement, $class) {
        if (!$sth = $this->_query($statement)) {
            return [];
        }
        return $sth->fetchAll(\PDO::FETCH_CLASS, $class);
    }
    
    /**
     * @param Statement\AbstractStatement $statement
     * @return boolean
     */
    public function query(Statement\AbstractStatement $statement) {
        return (bool) $this->_query($statement);
    }
    
    /**
     * @return string
     */
    public function getLastInsertId() {
        return $this->dbh()->lastInsertId();
    }
    
    private function _init() {
        $dsn = "mysql:host={$this->_host};port={$this->_port};";
        if ($this->_dbname !== null) {
            $dsn .= "dbname={$this->_dbname};";
        }
        try {
            $this->_dbh = new \PDO($dsn, $this->_user, $this->_pass, $this->_options);
            $this->_dbh->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
            $this->_dbh->exec("set names {$this->_charset}");
        } catch (\PDOException $e) {
            new Connection\Fail("Database error: {$e->getMessage()}");
        }
    }
    
    /**
     * @return \PDO
     */
    private function dbh() {
        if ($this->_dbh === null) {
            $this->_init();
        }
        return $this->_dbh;
    }
    
    /**
     * @param Statement\AbstractStatement $statement
     * @return \PDOStatement|boolean
     */
    private function _query(Statement\AbstractStatement $statement) {
        $result = $this->dbh()->prepare($statement->prepare());
        if (!$result->execute($statement->values())) {
            return false;
        }
        return $result;
    }
    
}
