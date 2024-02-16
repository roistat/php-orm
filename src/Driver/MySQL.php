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

    private ?\PDO $_pdo;

    private string $_dsn;
    private string $_host;
    private int $_port;
    private ?string $_user;
    private ?string $_pass;
    private ?string $_dbname;
    private string $_driver;

    private string $_charset = self::UTF8;
    private array $_options = [];

    /**
     * @param string $host
     * @param int $port
     * @param string $user
     * @param string $pass
     * @param string $dbname
     * @param string $driver
     */
    public function __construct(string $host = "127.0.0.1", int $port = 3306, ?string $user = "root", ?string $pass = null, ?string $dbname = null, string $driver = "mysql") {
        $this->_host = $host;
        $this->_port = $port;
        $this->_user = $user;
        $this->_pass = $pass;
        $this->_driver = $driver;
        $this->_dbname = $dbname;
        $this->_pdo = null;
        $this->_calcDSN();
    }

    private function _calcDSN() {
        $dsn = "{$this->_driver}:host={$this->_host};port={$this->_port};";
        if ($this->_dbname !== null) {
            $dsn .= "dbname={$this->_dbname};";
        }
        $this->_dsn = $dsn;
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
        return $this->_pdo()->query($query);
    }

    /**
     * @return string
     */
    public function getLastInsertId() {
        return $this->_pdo()->lastInsertId();
    }

    private function _init() {
        try {
            $this->_pdo = new \PDO($this->_dsn, $this->_user, $this->_pass, $this->_options);
            $this->_pdo->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
            $this->_pdo->setAttribute(\PDO::ATTR_EMULATE_PREPARES, false);
            $this->_pdo->exec("set names {$this->_charset}");
        } catch (\PDOException $e) {
            throw new Connection\Fail("Database error: {$e->getMessage()}");
        }
    }

    /**
     * @return string
     */
    public function dsn() {
        return $this->_dsn;
    }

    /**
     * @return \PDO
     */
    private function _pdo() {
        if ($this->_pdo === null) {
            $this->_init();
        }
        return $this->_pdo;
    }

    /**
     * @param Statement\AbstractStatement $statement
     * @return \PDOStatement
     * @throws Exception\PrepareStatementFail
     * @throws Exception\ExecuteStatementFail
     */
    private function _query(Statement\AbstractStatement $statement) {
        if (!($result = $this->_pdo()->prepare($statement->prepare()))) {
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
