<?php

/**
 * @author Michael Slyshkin <m.slyshkin@gmail.com>
 */

namespace RSDB\Query\Filter;

abstract class AbstractFilter implements LogicInterface {
    
    /**
     * @var string
     */
    protected $_field;
    
    /**
     * @var mixed[]
     */
    protected $_parameters = [];
    
    /**
     * @param string $field
     * @throws \Exception
     */
    public function __construct($field) {
        if (!is_string($field)) {
            throw new \Exception("Wrong field type");
        }
        $this->_field = $field;
    }
    
    /**
     * @return string
     */
    public function prepare() {
        return "`{$this->_field}`{$this->_prepareOperator()}{$this->_prepareParameters()}";
    }
    
    /**
     * @return string
     */
    abstract protected function _operator();
    
    /**
     * @return string
     */
    protected function _prepareOperator() {
        if (count($this->_parameters) === 0) {
            $postfix = "";
        }
        else {
            $postfix = " ";
        }
        return " " . $this->_operator() . $postfix;
    }
    
    /**
     * return string
     */
    protected function _prepareParameters() {
        switch (count($this->_parameters)) {
            case 0:
                return "";
            case 1:
                return "?";
            case 2:
                return "? AND ?";
            default :
                return "(" . str_repeat("?, ", count($this->_parameters) - 1) . "?)";
        }
    }
    
    /**
     * @return mixed[]
     */
    public function getParameters() {
        return $this->_parameters;
    }
    
}
