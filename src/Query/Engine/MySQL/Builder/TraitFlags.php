<?php

/**
 * @author Michael Slyshkin <m.slyshkin@gmail.com>
 */

namespace RsORM\Query\Engine\MySQL\Builder;

use RsORM\Query\Engine\MySQL\Flag;
use RsORM\Query\Engine\MySQL\Clause;

trait TraitFlags {
    
    /**
     * @var Flag\AbstractFlag[]
     */
    private $_flags = [];
    
    /**
     * @return BuilderInterface
     */
    public function flagAll() {
        $this->_flags[] = new Flag\All();
        return $this;
    }
    
    /**
     * @return BuilderInterface
     */
    public function flagDelayed() {
        $this->_flags[] = new Flag\Delayed();
        return $this;
    }
    
    /**
     * @return BuilderInterface
     */
    public function flagDistinct() {
        $this->_flags[] = new Flag\Distinct();
        return $this;
    }
    
    /**
     * @return BuilderInterface
     */
    public function flagDistinctRow() {
        $this->_flags[] = new Flag\DistinctRow();
        return $this;
    }
    
    /**
     * @return BuilderInterface
     */
    public function flagHighPriority() {
        $this->_flags[] = new Flag\HighPriority();
        return $this;
    }
    
    /**
     * @return BuilderInterface
     */
    public function flagIgnore() {
        $this->_flags[] = new Flag\Ignore();
        return $this;
    }
    
    /**
     * @return BuilderInterface
     */
    public function flagLowPriority() {
        $this->_flags[] = new Flag\LowPriority();
        return $this;
    }
    
    /**
     * @return BuilderInterface
     */
    public function flagQuick() {
        $this->_flags[] = new Flag\Quick();
        return $this;
    }
    
    /**
     * @return BuilderInterface
     */
    public function flagSQLBigResult() {
        $this->_flags[] = new Flag\SQLBigResult();
        return $this;
    }
    
    /**
     * @return BuilderInterface
     */
    public function flagSQLBufferResult() {
        $this->_flags[] = new Flag\SQLBufferResult();
        return $this;
    }
    
    /**
     * @return BuilderInterface
     */
    public function flagSQLCache() {
        $this->_flags[] = new Flag\SQLCache();
        return $this;
    }
    
    /**
     * @return BuilderInterface
     */
    public function flagSQLCalcFoundRows() {
        $this->_flags[] = new Flag\SQLCalcFoundRows();
        return $this;
    }
    
    /**
     * @return BuilderInterface
     */
    public function flagSQLNoCache() {
        $this->_flags[] = new Flag\SQLNoCache();
        return $this;
    }
    
    /**
     * @return BuilderInterface
     */
    public function flagSQLSmallResult() {
        $this->_flags[] = new Flag\SQLSmallResult();
        return $this;
    }
    
    /**
     * @return BuilderInterface
     */
    public function flagStraightJoin() {
        $this->_flags[] = new Flag\StraightJoin();
        return $this;
    }
    
    /**
     * @return Clause\Flags
     */
    protected function _buildFlags() {
        return $this->_flags === [] ? null : new Clause\Flags($this->_flags);
    }
}
