<?php

/**
 * @author Michael Slyshkin <m.slyshkin@gmail.com>
 */

namespace RsORMTest\Query\Engine\MySQL;

use RsORMTest;
use RsORM\Query\Engine\MySQL\Flag;

class FlagTest extends RsORMTest\Base {
    
    public function testAll() {
        $flag = new Flag\All();
        $this->assertSame("ALL", $flag->prepare());
    }
    
    public function testDelayed() {
        $flag = new Flag\Delayed();
        $this->assertSame("DELAYED", $flag->prepare());
    }
    
    public function testDistinct() {
        $flag = new Flag\Distinct();
        $this->assertSame("DISTINCT", $flag->prepare());
    }
    
    public function testDistinctRow() {
        $flag = new Flag\DistinctRow();
        $this->assertSame("DISTINCTROW", $flag->prepare());
    }
    
    public function testHighPriority() {
        $flag = new Flag\HighPriority();
        $this->assertSame("HIGH_PRIORITY", $flag->prepare());
    }
    
    public function testIgnore() {
        $flag = new Flag\Ignore();
        $this->assertSame("IGNORE", $flag->prepare());
    }
    
    public function testLowPriority() {
        $flag = new Flag\LowPriority();
        $this->assertSame("LOW_PRIORITY", $flag->prepare());
    }
    
    public function testQuick() {
        $flag = new Flag\Quick();
        $this->assertSame("QUICK", $flag->prepare());
    }
    
    public function testSQLBigResult() {
        $flag = new Flag\SQLBigResult();
        $this->assertSame("SQL_BIG_RESULT", $flag->prepare());
    }
    
    public function testSQLBufferResult() {
        $flag = new Flag\SQLBufferResult();
        $this->assertSame("SQL_BUFFER_RESULT", $flag->prepare());
    }
    
    public function testSQLCache() {
        $flag = new Flag\SQLCache();
        $this->assertSame("SQL_CACHE", $flag->prepare());
    }
    
    public function testSQLCalcFoundRows() {
        $flag = new Flag\SQLCalcFoundRows();
        $this->assertSame("SQL_CALC_FOUND_ROWS", $flag->prepare());
    }
    
    public function testSQLNoCache() {
        $flag = new Flag\SQLNoCache();
        $this->assertSame("SQL_NO_CACHE", $flag->prepare());
    }
    
    public function testSQLSmallResult() {
        $flag = new Flag\SQLSmallResult();
        $this->assertSame("SQL_SMALL_RESULT", $flag->prepare());
    }
    
    public function testStraightJoin() {
        $flag = new Flag\StraightJoin();
        $this->assertSame("STRAIGHT_JOIN", $flag->prepare());
    }
    
}
