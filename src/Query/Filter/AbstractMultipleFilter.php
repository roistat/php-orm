<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace RSDB\Query\Filter;

/**
 * Description of AbstractMultipleFilter
 *
 * @author Michael Slyshkin <m.slyshkin@gmail.com>
 */
abstract class AbstractMultipleFilter extends AbstractFilter {
	/**
	 * @param string[]|AbstractFilter[] $operands
	 */
	public function __construct(array $operands) {
		$this->_operands = $operands;
	}
	/**
	 * @return string
	 */
	public function prepare() {
		return implode($this->_operator(), $this->_prepareOperands());
	}
}
