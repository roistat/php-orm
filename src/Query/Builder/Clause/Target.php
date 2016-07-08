<?php

/**
 * @author Michael Slyshkin <m.slyshkin@gmail.com>
 */

namespace RsORM\Query\Builder\Clause;

use RsORM\Query\Engine\MySQL\Clause;
use RsORM\Query\Engine\MySQL\Argument;
use RsORM\Query\Builder;

class Target implements Builder\BuilderInterface {
    
    const FROM = 1;
    
    const INTO = 2;
    
    const TARGET = 3;
    
    /**
     * @var string
     */
    private $_clauseClass;
    
    private $_table;
    
    /**
     * @param int $type
     */
    public function __construct($type = self::TARGET) {
        switch ($type) {
            case self::FROM:
                $this->_clauseClass = Clause\From::class;
                break;
            case self::INTO:
                $this->_clauseClass = Clause\Into::class;
                break;
            case self::TARGET:
                $this->_clauseClass = Clause\Target::class;
                break;
        }
    }
    
    /**
     * @param string $name
     */
    public function set($name) {
        $this->_table = new Argument\Table($name);
    }
    
    /**
     * @return Clause\From|Clause\Into|Clause\Target
     */
    public function build() {
        return new $this->_clauseClass($this->_table);
    }
}
