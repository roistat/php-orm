<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace RSDB\Query\Filter;

/**
 * Description of AbstractBinaryFilter
 *
 * @author Michael Slyshkin <m.slyshkin@gmail.com>
 */
abstract class AbstractBinaryFilter extends AbstractFilter {
	/**
	 * @param string $operand1
	 * @param string $operand2
	 */
	public function __construct($operand1, $operand2 = NULL) {
		$this->_operands = [$operand1, $operand2];
	}
	/**
	 * @return string
	 */
	public function prepare() {
		return $this->_prepareOperand(0)
				.$this->_operator()
				.$this->_prepareOperand(1);
	}
}
