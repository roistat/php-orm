<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace RSDB\Query\Filter;

/**
 * Description of AbstractUnaryFilter
 *
 * @author Michael Slyshkin <m.slyshkin@gmail.com>
 */
abstract class AbstractUnaryFilter extends AbstractFilter {
	/**
	 * @param string|AbstractFilter $operand
	 */
	public function __construct($operand) {
		$this->_operands = [$operand];
	}
	/**
	 * @return string
	 */
	public function prepare() {
		$result = $this->_prepareOperand(0);
		if ($this->_prefix()) {
			$result = $this->_operator() . $result;
		}
		else {
			$result .= $this->_operator();
		}
		return $result;
	}
	/**
	 * @return boolean
	 */
	protected function _prefix() {
		return true;
	}
}
