<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace RSDB\Query\Filter;

/**
 * Description of AbstractFilter
 *
 * @author Michael Slyshkin <m.slyshkin@gmail.com>
 */
abstract class AbstractFilter {
	/**
	 * @var string[]|AbstractFilter[]
	 */
	protected $_operands;
	/**
	 * @return string
	 */
	abstract public function prepare();
	/**
	 * @param int $index
	 * @return string
	 */
	protected function _prepareOperand($index) {
		if ($index == 1 && $this->_operands[$index] === NULL)
			return ":" . $this->_operands[0];
		if ($this->_operands[$index] instanceof AbstractFilter)
			return "(" . $this->_operands[$index]->prepare() . ")";
		return $this->_operands[$index];
	}
	protected function _prepareOperands() {
		$result = [];
		for ($i = 0; $i < count($this->_operands); $i++) {
			$result[$i] = $this->_prepareOperand($i);
		}
		return $result;
	}
	/**
	 * @return string
	 */
	abstract protected function _operator();
}
