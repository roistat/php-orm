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

    private $_driver = "mysql";

    /**
     * @param string $host
     * @param int $port
     * @param string $user
     * @param string $pass
     * @param string $dbname
     * @param string $driver
     */
    public function __construct($host = null, $port = null, $user = null, $pass = null, $dbname = null, $driver = null) {
        $this->_host = $host === null ? $this->_host : $host;
        $this->_port = $port === null ? $this->_port : $port;
        $this->_user = $user === null ? $this->_user : $user;
        $this->_pass = $pass === null ? $this->_pass : $pass;
        $this->_driver = $driver === null ? $this->_driver : $driver;
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
        $sth = $this->_query($statement);
        $sth->setFetchMode(\PDO::FETCH_ASSOC);
        return $sth->fetch();
    }

    /**
     * @param Statement\AbstractStatement $statement
     * @return array
     */
    public function fetchAllAssoc(Statement\AbstractStatement $statement) {
        $sth = $this->_query($statement);
        $sth->setFetchMode(\PDO::FETCH_ASSOC);
        return $sth->fetchAll();
    }

    /**
     * @param Statement\AbstractStatement $statement
     * @param string $class
     * @return State\Entity
     */
    public function fetchClass(Statement\AbstractStatement $statement, $class) {
        $sth = $this->_query($statement);
        $sth->setFetchMode(\PDO::FETCH_CLASS, $class);
        $object = $sth->fetch();
        $this->_flushObject($object);
        return $object;
    }

    /**
     * @param Statement\AbstractStatement $statement
     * @param string $class
     * @return State\Entity[]
     */
    public function fetchAllClass(Statement\AbstractStatement $statement, $class) {
        $sth = $this->_query($statement);
        $sth->setFetchMode(\PDO::FETCH_CLASS, $class);
        $objects = $sth->fetchAll();
        $this->_flushObjects($objects);
        return $objects;
    }

    /**
     * @param Statement\AbstractStatement $statement
     */
    public function query(Statement\AbstractStatement $statement) {
        $this->_query($statement);
    }

    /**
     * @param string $query
     * @return \PDOStatement
     */
    public function queryCustom($query) {
        return $this->dbh()->query($query);
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
            $this->_dbh->setAttribute(\PDO::ATTR_EMULATE_PREPARES, false);
            $this->_dbh->exec("set names {$this->_charset}");
        } catch (\PDOException $e) {
            throw new Connection\Fail("Database error: {$e->getMessage()}");
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
     * @return \PDOStatement
     * @throws Exception\PrepareStatementFail
     * @throws Exception\ExecuteStatementFail
     */
    private function _query(Statement\AbstractStatement $statement) {
        if (!($result = $this->dbh()->prepare($statement->prepare()))) {
            throw new Exception\PrepareStatementFail();
        }
        if (!$result->execute($statement->values())) {
            throw new Exception\ExecuteStatementFail();
        }
        return $result;
    }

    /**
     * @param mixed $object
     */
    private function _flushObject($object) {
        if ($object instanceof State\Entity) {
            State\Engine::getInstance()->flush($object);
        }
    }

    /**
     * @param mixed[] $objects
     */
    private function _flushObjects(array $objects) {
        foreach ($objects as $object) {
            $this->_flushObject($object);
        }
    }

}
