<?php

/**
 * @author Michael Slyshkin <m.slyshkin@gmail.com>
 */

namespace RsORM\Query\Engine\MySQL\Clause;

class Distinct extends AbstractClause {
    
    /**
     * @param Fields $fields
     */
    public function __construct(Fields $fields) {
        parent::__construct([$fields]);
    }
    
    /**
     * @return string
     */
    public function prepare() {
        return "DISTINCT " . $this->_prepareArguments()[0];
    }
    
}
