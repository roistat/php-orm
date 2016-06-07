<?php

/**
 * @author Michael Slyshkin <m.slyshkin@gmail.com>
 */

namespace RSDB\Query\Engine\MySQL\Operator;

abstract class AbstractComplexOperand extends AbstractOperand {
    
    /**
     * @var array
     */
    protected $_values = [];
    
    /**
     * @param array $values
     */
    public function __construct(array $values) {
        foreach ($values as $key => $value) {
            if (!$value instanceof AbstractOperand) {
                $values[$key] = new Value($value);
            }
        }
        $this->_values = $values;
    }
    
    /**
     * @return string[]
     */
    protected function _prepareValues() {
        $result = [];
        foreach ($this->_values as $value) {
            if ($value instanceof AbstractComplexOperand && !$value instanceof Interval) {
                $result[] = "({$value->prepare()})";
            } else {
                $result[] = $value->prepare();
            }
            
        }
        return $result;
    }
    
    /**
     * @return array
     */
    public function values() {
        $result = [];
        foreach ($this->_values as $value) {
            $result = array_merge($result, $value->values());
        }
        return $result;
    }

}
