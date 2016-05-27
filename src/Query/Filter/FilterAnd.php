<?php

/**
 * @author Michael Slyshkin <m.slyshkin@gmail.com>
 */

namespace RSDB\Query\Filter;

class FilterAnd extends AbstractMultipleFilter {
    
	protected function _operator() {
		return " AND ";
	}
    
}
