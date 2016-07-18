<?php

/**
 * @author Michael Slyshkin <m.slyshkin@gmail.com>
 */

namespace RsORM\Query\Engine\MySQL\Builder;

use RsORM\Query\Engine\MySQL\Clause;

trait TraitHaving {
    
    /**
     * @var FilterInterface
     */
    private $_havingFilter;
    
    /**
     * @param FilterInterface $filter
     * @return $this
     */
    public function having(FilterInterface $filter) {
        $this->_havingFilter = $filter;
        return $this;
    }
    
    /**
     * @return Clause\Having
     */
    protected function _buildHaving() {
        $filter = $this->_havingFilter === null ? null : $this->_havingFilter->build();
        return $filter === null ? null : new Clause\Having($filter);
    }
}
