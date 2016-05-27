<?php

/**
 * @author Michael Slyshkin <m.slyshkin@gmail.com>
 */

namespace RSDB\Query\Filter;

class FilterOr extends AbstractMultipleFilter {
    
	protected function _operator() {
		return " OR ";
	}
    
}
