<?php

/**
 * @author Michael Slyshkin <m.slyshkin@gmail.com>
 */

namespace RsORM\Query\Engine\MySQL\Builder;

use RsORM\Query\Engine\MySQL;
use RsORM\Query\Engine\MySQL\Argument;
use RsORM\Query\Engine\MySQL\Clause;

trait TraitColumns {
    
    /**
     * @var MySQL\ObjectInterface[]
     */
    private $_columns = [];

    /**
     * @param MySQL\ObjectInterface[] $columns
     */
    protected function _setColumns(array $columns) {
        $this->_columns = [];
        foreach ($columns as $column) {
            $this->_addColumn($column);
        }
    }

    /**
     * @param MySQL\ObjectInterface|string $column
     * @param string $alias
     */
    protected function _addColumn($column, $alias = null) {
        $sqlObject = $column instanceof MySQL\ObjectInterface ? $column : new Argument\Column($column);
        if ($alias === null) {
            $this->_columns[] = new Argument\Field($sqlObject);
        } else {
            $this->_columns[] = new Argument\Field($sqlObject, new Argument\Alias($alias));
        }
    }


        /**
     * @return Clause\Objects
     */
    protected function _buildColumns() {
        $columns = $this->_columns === [] ? [new Argument\Any()] : $this->_columns;
        return new Clause\Objects($columns);
    }
}
