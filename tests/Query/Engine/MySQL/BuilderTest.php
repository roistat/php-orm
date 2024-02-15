<?php

/**
 * @author Michael Slyshkin <m.slyshkin@gmail.com>
 */

namespace RsORMTest\Query\Engine\MySQL;

use RsORMTest;
use RsORM\Query\Engine\MySQL\Builder;

class BuilderTest extends RsORMTest\Base {
    
    public function testFuncAvg() {
        $stmt = Builder::funcAvg("name", "alias");
        $this->assertSame("AVG(name) AS alias", $stmt->prepare());
        $this->assertSame([], $stmt->values());
    }
    
    public function testFuncAvgDistinct() {
        $stmt = Builder::funcAvg("name", "alias", true);
        $this->assertSame("AVG(DISTINCT name) AS alias", $stmt->prepare());
        $this->assertSame([], $stmt->values());
    }
    
    public function testFuncCount() {
        $stmt = Builder::funcCount("name", "alias");
        $this->assertSame("COUNT(name) AS alias", $stmt->prepare());
        $this->assertSame([], $stmt->values());
    }
    
    public function testFuncCountDistinct() {
        $stmt = Builder::funcCount("name", "alias", true);
        $this->assertSame("COUNT(DISTINCT name) AS alias", $stmt->prepare());
        $this->assertSame([], $stmt->values());
    }
    
    public function testFuncSum() {
        $stmt = Builder::funcSum("name", "alias");
        $this->assertSame("SUM(name) AS alias", $stmt->prepare());
        $this->assertSame([], $stmt->values());
    }
    
    public function testFuncSumDistinct() {
        $stmt = Builder::funcSum("name", "alias", true);
        $this->assertSame("SUM(DISTINCT name) AS alias", $stmt->prepare());
        $this->assertSame([], $stmt->values());
    }
    
    public function testFuncConcat() {
        $stmt = Builder::funcConcat(["name1", "name2"], "alias");
        $this->assertSame("CONCAT(?, ?) AS alias", $stmt->prepare());
        $this->assertSame(["name1", "name2"], $stmt->values());
    }
}
