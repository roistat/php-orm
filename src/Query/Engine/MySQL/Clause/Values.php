<?php

/**
 * @author Michael Slyshkin <m.slyshkin@gmail.com>
 */

namespace RsORM\Query\Engine\MySQL\Clause;

use RsORM\Driver\Exception;

class Values extends AbstractClause {
    
    /**
     * @return string
     */
    public function prepare() {
        if (count($this->_argumentsSets) === 0 || count($this->_argumentsSets[0]) === 0) {
            throw new Exception\PrepareStatementFail("VALUES (...) clause is empty");
        }
        $argumentsSets = array_chunk($this->_prepareArguments(), count($this->_argumentsSets[0]));
        $valuesSets = array_map(function(array $argSet) { return "(" . implode(", ", $argSet) . ")"; }, $argumentsSets);

        return "VALUES " . implode(", ", $valuesSets);
    }
    
}
