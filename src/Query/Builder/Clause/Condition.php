<?php

/**
 * @author Michael Slyshkin <m.slyshkin@gmail.com>
 */

namespace RsORM\Query\Builder\Clause;

use RsORM\Query\Engine\MySQL\Clause;
use RsORM\Query\Builder;

class Condition implements Builder\BuilderInterface {
    
    const WHERE = 1;
    
    const HAVING = 2;
    
    /**
     * @var string
     */
    private $_clauseClass;
    
    /**
     * @var Builder\Filter
     */
    private $_filter;
    
    /**
     * @param int $type
     */
    public function __construct($type = self::WHERE) {
        switch ($type) {
            case self::WHERE:
                $this->_clauseClass = Clause\Filter::class;
                break;
            case self::HAVING:
                $this->_clauseClass = Clause\Having::class;
                break;
        }
    }
    
    /**
     * @param Builder\Filter $filter
     */
    public function set(Builder\Filter $filter) {
        $this->_filter = $filter;
    }
    
    /**
     * @return Clause\Filter|Clause\Having
     */
    public function build() {
        if ($this->_filter === null) {
            return null;
        }
        $builtFilter = $this->_filter->build();
        if ($builtFilter === null) {
            return null;
        }
        return new $this->_clauseClass($builtFilter);
    }
}
