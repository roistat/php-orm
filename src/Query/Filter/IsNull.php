<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace RSDB\Query\Filter;

/**
 * Description of IsNull
 *
 * @author Michael Slyshkin <m.slyshkin@gmail.com>
 */
class IsNull extends AbstractUnaryFilter {
	protected function _operator() {
		return " IS NULL";
	}
	protected function _prefix() {
		return false;
	}
}
