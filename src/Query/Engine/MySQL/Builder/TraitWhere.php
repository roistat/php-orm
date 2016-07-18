<?php

/**
 * @author Michael Slyshkin <m.slyshkin@gmail.com>
 */

namespace RsORM\Query\Engine\MySQL\Builder;

use RsORM\Query\Engine\MySQL\Clause;

trait TraitWhere {
    
    /**
     * @var Filter
     */
    private $_whereFilter;
    
    /**
     * @param Filter $filter
     * @return $this
     */
    public function where(Filter $filter) {
        $this->_whereFilter = $filter;
        return $this;
    }
    
    /**
     * @return Clause\Filter
     */
    protected function _buildWhere() {
        $filter = $this->_whereFilter === null ? null : $this->_whereFilter->build();
        return $filter === null ? null : new Clause\Filter($filter);
    }
}
