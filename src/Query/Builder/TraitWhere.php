<?php

/**
 * @author Michael Slyshkin <m.slyshkin@gmail.com>
 */

namespace RsORM\Query\Builder;

use RsORM\Query\Engine\MySQL\Clause;

trait TraitWhere {
    
    /**
     * @var Filter
     */
    private $_whereFilter;
    
    /**
     * @param Filter $filter
     * @return AbstractBuilder
     */
    public function where(Filter $filter) {
        $this->_whereFilter = $filter;
        return $this;
    }
    
    /**
     * @return Clause\Filter
     */
    protected function _buildWhere() {
        return $this->_buildClause($this->_whereFilter, Clause\Filter::class);
    }
}
