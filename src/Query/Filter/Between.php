<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace RSDB\Query\Filter;

/**
 * Description of Between
 *
 * @author Michael Slyshkin <m.slyshkin@gmail.com>
 */
class Between extends AbstractFilter {
	public function __construct($operand1, $operand2, $operand3) {
		$this->_operands = [$operand1, $operand2, $operand3];
	}
	protected function _operator() {
		return " BETWEEN ";
	}
	public function prepare() {
		return $this->_prepareOperand(0)
				. $this->_operator()
				. $this->_prepareOperand(1)
				. " AND "
				. $this->_prepareOperand(2);
	}
}
