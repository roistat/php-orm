<?php
/**
 * Created by PhpStorm.
 * User: Юрий
 * Date: 03.07.2016
 * Time: 14:29
 */

namespace RsORM\Query\Engine\MySQL\Statement\Builder;

use RsORM\Query\Engine\MySQL\Clause;
use RsORM\Query\Engine\MySQL\Argument;
use RsORM\Query\Engine\MySQL\Statement;

class Select {
// Clause\Order $order = null, Clause\Limit $limit = null

    /**
     * @var Clause\Fields
     */
    private $_fields;

    /**
     * @var Clause\From
     */
    private $_table;

    /**
     * @var Clause\Filter
     */
    private $_filter;

    /**
     * @var Clause\Group
     */
    private $_group;

    /**
     * @var Clause\Having
     */
    private $_having;

    /**
     * @var Clause\Order
     */
    private $_order;

    /**
     * @var Clause\Limit
     */
    private $_limit;

    /**
     * Fields is array of strings. By now only supports field names.
     * @todo support of expression select statements like SELECT SUM(field) as su
     * @param string[] $fields
     * @return Select
     */
    public function __construct(array $fields = []) {
        $arguments = [];
        if (count($fields) === 0) {
            $arguments[] = new Argument\Any();
        } else {
            foreach ($fields as $field => $expression) {
                if (is_numeric($field)) {
                    $arguments[] = new Argument\Field(new Argument\Column($expression));
                }
            }
        }
        $this->_fields = new Clause\Fields($arguments);
        return $this;
    }

    /**
     * @param string $tableName
     * @return Select
     */
    public function from($tableName) {
        $this->_table = new Clause\From(new Argument\Table($tableName));
        return $this;
    }

    /**
     * @param Clause\Filter $filter
     * @return Select
     */
    public function where(Clause\Filter $filter) {
        // @todo constructors
        $this->_filter = $filter;
        return $this;
    }

    /**
     * @param string|string[] $fields
     * @return Select
     */
    public function groupBy($fields) {
        $arguments = [];
        if (is_string($fields)) {
            $arguments[] = new Argument\Column($fields);
        } elseif (is_array($fields)) {
            foreach ($fields as $field) {
                $arguments[] = new Argument\Column($field);
            }
        }
        $this->_group = new Clause\Group($arguments);
        return $this;
    }

    /**
     * @param Clause\Having $having
     * @return Select
     */
    public function having(Clause\Having $having) {
        // @todo constructors
        $this->_having = $having;
        return $this;
    }

    /**
     * @param Clause\Order $order
     * @return Select
     */
    public function orderBy(Clause\Order $order) {
        // @todo constructors
        $this->_order = $order;
        return $this;
    }

    /**
     * @param int $count
     * @param int $offset
     * @return Select
     */
    public function limit($count, $offset = 0) {
        $this->_limit = new Clause\Limit(
            new Argument\Value($offset),
            new Argument\Value($count)
        );
        return $this;
    }

    /**
     * @return Statement\Select
     */
    public function build() {
        return new Statement\Select(
            $this->_fields,
            $this->_table,
            $this->_filter,
            $this->_group,
            $this->_having,
            $this->_order,
            $this->_limit
        );
    }
}