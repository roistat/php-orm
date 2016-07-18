<?php

/**
 * @author Michael Slyshkin <m.slyshkin@gmail.com>
 */

namespace RsORMTest\Query\Engine\MySQL\Builder;

use RsORMTest;
use RsORM\Query\Engine\MySQL\Builder;

class FilterTest extends RsORMTest\Base {
    
    public function testCompareInt() {
        $filter = new Builder\Filter();
        $filter->compare("id", 13);
        $query = $filter->build();
        $this->assertSame("`id` = ?", $query->prepare());
        $this->assertSame([13], $query->values());
    }
    
    public function testCompareIntNot() {
        $filter = new Builder\Filter();
        $filter->compare("id", 13, false);
        $query = $filter->build();
        $this->assertSame("`id` != ?", $query->prepare());
        $this->assertSame([13], $query->values());
    }
    
    public function testCompareDouble() {
        $filter = new Builder\Filter();
        $filter->compare("pi", 3.14);
        $query = $filter->build();
        $this->assertSame("`pi` = ?", $query->prepare());
        $this->assertSame([3.14], $query->values());
    }
    
    public function testCompareDoubleNot() {
        $filter = new Builder\Filter();
        $filter->compare("pi", 3.14, false);
        $query = $filter->build();
        $this->assertSame("`pi` != ?", $query->prepare());
        $this->assertSame([3.14], $query->values());
    }
    
    public function testComapareString() {
        $filter = new Builder\Filter();
        $filter->compare("name", "%van%");
        $query = $filter->build();
        $this->assertSame("`name` LIKE ?", $query->prepare());
        $this->assertSame(["%van%"], $query->values());
    }
    
    public function testComapareStringNot() {
        $filter = new Builder\Filter();
        $filter->compare("name", "%van%", false);
        $query = $filter->build();
        $this->assertSame("NOT (`name` LIKE ?)", $query->prepare());
        $this->assertSame(["%van%"], $query->values());
    }
    
    public function testComapareBoolean() {
        $filter = new Builder\Filter();
        $filter->compare("flag", false);
        $query = $filter->build();
        $this->assertSame("`flag` IS ?", $query->prepare());
        $this->assertSame([0], $query->values());
    }
    
    public function testComapareBooleanNot() {
        $filter = new Builder\Filter();
        $filter->compare("flag", false, false);
        $query = $filter->build();
        $this->assertSame("`flag` IS NOT ?", $query->prepare());
        $this->assertSame([0], $query->values());
    }
    
    public function testComapareNull() {
        $filter = new Builder\Filter();
        $filter->compare("id", null);
        $query = $filter->build();
        $this->assertSame("`id` IS NULL", $query->prepare());
        $this->assertSame([], $query->values());
    }
    
    public function testComapareNullNot() {
        $filter = new Builder\Filter();
        $filter->compare("id", null, false);
        $query = $filter->build();
        $this->assertSame("`id` IS NOT NULL", $query->prepare());
        $this->assertSame([], $query->values());
    }
    
    public function testComapareArray() {
        $filter = new Builder\Filter();
        $filter->compare("id", [1, 2, 3]);
        $query = $filter->build();
        $this->assertSame("`id` IN (?, ?, ?)", $query->prepare());
        $this->assertSame([1, 2, 3], $query->values());
    }
    
    public function testComapareArrayNot() {
        $filter = new Builder\Filter();
        $filter->compare("id", [1, 2, 3], false);
        $query = $filter->build();
        $this->assertSame("NOT (`id` IN (?, ?, ?))", $query->prepare());
        $this->assertSame([1, 2, 3], $query->values());
    }
    
    public function testEq() {
        $filter = new Builder\Filter();
        $filter->eq("id", 13);
        $query = $filter->build();
        $this->assertSame("`id` = ?", $query->prepare());
        $this->assertSame([13], $query->values());
    }
    
    public function testEqNot() {
        $filter = new Builder\Filter();
        $filter->eq("id", 13, false);
        $query = $filter->build();
        $this->assertSame("`id` != ?", $query->prepare());
        $this->assertSame([13], $query->values());
    }
    
    public function testLt() {
        $filter = new Builder\Filter();
        $filter->lt("id", 13);
        $query = $filter->build();
        $this->assertSame("`id` < ?", $query->prepare());
        $this->assertSame([13], $query->values());
    }
    
    public function testLtNot() {
        $filter = new Builder\Filter();
        $filter->lt("id", 13, false);
        $query = $filter->build();
        $this->assertSame("NOT (`id` < ?)", $query->prepare());
        $this->assertSame([13], $query->values());
    }
    
    public function testLte() {
        $filter = new Builder\Filter();
        $filter->lte("id", 13);
        $query = $filter->build();
        $this->assertSame("`id` <= ?", $query->prepare());
        $this->assertSame([13], $query->values());
    }
    
    public function testLteNot() {
        $filter = new Builder\Filter();
        $filter->lte("id", 13, false);
        $query = $filter->build();
        $this->assertSame("NOT (`id` <= ?)", $query->prepare());
        $this->assertSame([13], $query->values());
    }
    
    public function testGt() {
        $filter = new Builder\Filter();
        $filter->gt("id", 13);
        $query = $filter->build();
        $this->assertSame("`id` > ?", $query->prepare());
        $this->assertSame([13], $query->values());
    }
    
    public function testGtNot() {
        $filter = new Builder\Filter();
        $filter->gt("id", 13, false);
        $query = $filter->build();
        $this->assertSame("NOT (`id` > ?)", $query->prepare());
        $this->assertSame([13], $query->values());
    }
    
    public function testGte() {
        $filter = new Builder\Filter();
        $filter->gte("id", 13);
        $query = $filter->build();
        $this->assertSame("`id` >= ?", $query->prepare());
        $this->assertSame([13], $query->values());
    }
    
    public function testGteNot() {
        $filter = new Builder\Filter();
        $filter->gte("id", 13, false);
        $query = $filter->build();
        $this->assertSame("NOT (`id` >= ?)", $query->prepare());
        $this->assertSame([13], $query->values());
    }
    
    public function testIs() {
        $filter = new Builder\Filter();
        $filter->is("flag", true);
        $query = $filter->build();
        $this->assertSame("`flag` IS ?", $query->prepare());
        $this->assertSame([1], $query->values());
    }
    
    public function testIsNot() {
        $filter = new Builder\Filter();
        $filter->is("flag", true, false);
        $query = $filter->build();
        $this->assertSame("`flag` IS NOT ?", $query->prepare());
        $this->assertSame([1], $query->values());
    }
    
    public function testIsNull() {
        $filter = new Builder\Filter();
        $filter->isNull("id");
        $query = $filter->build();
        $this->assertSame("`id` IS NULL", $query->prepare());
        $this->assertSame([], $query->values());
    }
    
    public function testIsNotNull() {
        $filter = new Builder\Filter();
        $filter->isNull("id", false);
        $query = $filter->build();
        $this->assertSame("`id` IS NOT NULL", $query->prepare());
        $this->assertSame([], $query->values());
    }
    
    public function testLike() {
        $filter = new Builder\Filter();
        $filter->like("name", "%van%");
        $query = $filter->build();
        $this->assertSame("`name` LIKE ?", $query->prepare());
        $this->assertSame(["%van%"], $query->values());
    }
    
    public function testLikeNot() {
        $filter = new Builder\Filter();
        $filter->like("name", "%van%", false);
        $query = $filter->build();
        $this->assertSame("NOT (`name` LIKE ?)", $query->prepare());
        $this->assertSame(["%van%"], $query->values());
    }
    
    public function testBetween() {
        $filter = new Builder\Filter();
        $filter->between("id", 10, 100);
        $query = $filter->build();
        $this->assertSame("`id` BETWEEN ? AND ?", $query->prepare());
        $this->assertSame([10, 100], $query->values());
    }
    
    public function testBetweenNot() {
        $filter = new Builder\Filter();
        $filter->between("id", 10, 100, false);
        $query = $filter->build();
        $this->assertSame("NOT (`id` BETWEEN ? AND ?)", $query->prepare());
        $this->assertSame([10, 100], $query->values());
    }
    
    public function testIn() {
        $filter = new Builder\Filter();
        $filter->in("id", [1, 2, 3]);
        $query = $filter->build();
        $this->assertSame("`id` IN (?, ?, ?)", $query->prepare());
        $this->assertSame([1, 2, 3], $query->values());
    }
    
    public function testInNot() {
        $filter = new Builder\Filter();
        $filter->in("id", [1, 2, 3], false);
        $query = $filter->build();
        $this->assertSame("NOT (`id` IN (?, ?, ?))", $query->prepare());
        $this->assertSame([1, 2, 3], $query->values());
    }
    
    public function testOneLevel() {
        $filter = new Builder\Filter();
        $filter->compare("status", 4)
                ->compare("id", [1, 2, 3], false)
                ->between("id", 100, 200);
        $query = $filter->build();
        $this->assertSame("(`status` = ?) AND (NOT (`id` IN (?, ?, ?))) AND (`id` BETWEEN ? AND ?)", $query->prepare());
        $this->assertSame([4, 1, 2, 3, 100, 200], $query->values());
    }
    
    public function testTwoLevels() {
        $filter1 = new Builder\Filter();
        $filter2 = new Builder\Filter();
        $filter = new Builder\Filter();
        $filter1->compare("status", 4)
                ->gt("age", 18);
        $filter2->compare("status", 5)
                ->gt("age", 21);
        $filter->compare("id", [1, 2, 3])
                ->compare("name", "A%")
                ->logicOr($filter1)
                ->logicOr($filter2);
        $query = $filter->build();
        $this->assertSame("((`id` IN (?, ?, ?)) AND (`name` LIKE ?)) OR ((`status` = ?) AND (`age` > ?)) OR ((`status` = ?) AND (`age` > ?))", $query->prepare());
        $this->assertSame([1, 2, 3, "A%", 4, 18, 5, 21], $query->values());
    }
    
}
