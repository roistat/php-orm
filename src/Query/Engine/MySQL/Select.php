<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace RSDB\Query\Engine\MySQL;

use RSDB\Query\Filter;

/**
 * Description of Select
 *
 * @author Michael Slyshkin <m.slyshkin@gmail.com>
 */
class Select {
	/**
	 *
	 * @var string
	 */
	private $_table;
	/**
	 *
	 * @var Filter\AbstractFilter
	 */
	private $_filter;
	/**
	 * 
	 * @param string $table
	 * @param Filter\AbstractFilter $filter
	 */
	public function __construct($table, Filter\AbstractFilter $filter) {
		$this->_table = $table;
		$this->_filter = $filter;
	}
	/**
	 * 
	 * @return string
	 */
	public function prepare() {
		$whereStatement = $this->_filter->prepare();
		if ($whereStatement) {
			$whereStatement = " WHERE " . $whereStatement;
		}
		return "SELECT * FROM {$this->_table}$whereStatement";
	}
}
