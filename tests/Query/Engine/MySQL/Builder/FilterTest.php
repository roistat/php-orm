<?php

/**
 * @author Michael Slyshkin <m.slyshkin@gmail.com>
 */

namespace RsORMTest\Query\Engine\MySQL\Builder;

use RsORMTest;
use RsORM\Query\Engine\MySQL\Builder;

class FilterTest extends RsORMTest\Base {
    
    public function testCompareInt() {
        $filter = Builder::filter()->compare("id", 13);
        $stmt = $filter->build();
        $this->assertSame("`id` = ?", $stmt->prepare());
        $this->assertSame([13], $stmt->values());
    }
    
    public function testCompareIntNot() {
        $filter = Builder::filter()->compare("id", 13, false);
        $stmt = $filter->build();
        $this->assertSame("`id` != ?", $stmt->prepare());
        $this->assertSame([13], $stmt->values());
    }
    
    public function testCompareDouble() {
        $filter = Builder::filter()->compare("pi", 3.14);
        $stmt = $filter->build();
        $this->assertSame("`pi` = ?", $stmt->prepare());
        $this->assertSame([3.14], $stmt->values());
    }
    
    public function testCompareDoubleNot() {
        $filter = Builder::filter()->compare("pi", 3.14, false);
        $stmt = $filter->build();
        $this->assertSame("`pi` != ?", $stmt->prepare());
        $this->assertSame([3.14], $stmt->values());
    }
    
    public function testComapareString() {
        $filter = Builder::filter()->compare("name", "%van%");
        $stmt = $filter->build();
        $this->assertSame("`name` LIKE ?", $stmt->prepare());
        $this->assertSame(["%van%"], $stmt->values());
    }
    
    public function testComapareStringNot() {
        $filter = Builder::filter()->compare("name", "%van%", false);
        $stmt = $filter->build();
        $this->assertSame("NOT (`name` LIKE ?)", $stmt->prepare());
        $this->assertSame(["%van%"], $stmt->values());
    }
    
    public function testComapareBoolean() {
        $filter = Builder::filter()->compare("flag", false);
        $stmt = $filter->build();
        $this->assertSame("`flag` IS ?", $stmt->prepare());
        $this->assertSame([0], $stmt->values());
    }
    
    public function testComapareBooleanNot() {
        $filter = Builder::filter()->compare("flag", false, false);
        $stmt = $filter->build();
        $this->assertSame("`flag` IS NOT ?", $stmt->prepare());
        $this->assertSame([0], $stmt->values());
    }
    
    public function testComapareNull() {
        $filter = Builder::filter()->compare("id", null);
        $stmt = $filter->build();
        $this->assertSame("`id` IS NULL", $stmt->prepare());
        $this->assertSame([], $stmt->values());
    }
    
    public function testComapareNullNot() {
        $filter = Builder::filter()->compare("id", null, false);
        $stmt = $filter->build();
        $this->assertSame("`id` IS NOT NULL", $stmt->prepare());
        $this->assertSame([], $stmt->values());
    }
    
    public function testComapareArray() {
        $filter = Builder::filter()->compare("id", [1, 2, 3]);
        $stmt = $filter->build();
        $this->assertSame("`id` IN (?, ?, ?)", $stmt->prepare());
        $this->assertSame([1, 2, 3], $stmt->values());
    }
    
    public function testComapareArrayNot() {
        $filter = Builder::filter()->compare("id", [1, 2, 3], false);
        $stmt = $filter->build();
        $this->assertSame("NOT (`id` IN (?, ?, ?))", $stmt->prepare());
        $this->assertSame([1, 2, 3], $stmt->values());
    }
    
    public function testEq() {
        $filter = Builder::filter()->eq("id", 13);
        $stmt = $filter->build();
        $this->assertSame("`id` = ?", $stmt->prepare());
        $this->assertSame([13], $stmt->values());
    }
    
    public function testEqNot() {
        $filter = Builder::filter()->eq("id", 13, false);
        $stmt = $filter->build();
        $this->assertSame("`id` != ?", $stmt->prepare());
        $this->assertSame([13], $stmt->values());
    }
    
    public function testLt() {
        $filter = Builder::filter()->lt("id", 13);
        $stmt = $filter->build();
        $this->assertSame("`id` < ?", $stmt->prepare());
        $this->assertSame([13], $stmt->values());
    }
    
    public function testLtNot() {
        $filter = Builder::filter()->lt("id", 13, false);
        $stmt = $filter->build();
        $this->assertSame("NOT (`id` < ?)", $stmt->prepare());
        $this->assertSame([13], $stmt->values());
    }
    
    public function testLte() {
        $filter = Builder::filter()->lte("id", 13);
        $stmt = $filter->build();
        $this->assertSame("`id` <= ?", $stmt->prepare());
        $this->assertSame([13], $stmt->values());
    }
    
    public function testLteNot() {
        $filter = Builder::filter()->lte("id", 13, false);
        $stmt = $filter->build();
        $this->assertSame("NOT (`id` <= ?)", $stmt->prepare());
        $this->assertSame([13], $stmt->values());
    }
    
    public function testGt() {
        $filter = Builder::filter()->gt("id", 13);
        $stmt = $filter->build();
        $this->assertSame("`id` > ?", $stmt->prepare());
        $this->assertSame([13], $stmt->values());
    }
    
    public function testGtNot() {
        $filter = Builder::filter()->gt("id", 13, false);
        $stmt = $filter->build();
        $this->assertSame("NOT (`id` > ?)", $stmt->prepare());
        $this->assertSame([13], $stmt->values());
    }
    
    public function testGte() {
        $filter = Builder::filter()->gte("id", 13);
        $stmt = $filter->build();
        $this->assertSame("`id` >= ?", $stmt->prepare());
        $this->assertSame([13], $stmt->values());
    }
    
    public function testGteNot() {
        $filter = Builder::filter()->gte("id", 13, false);
        $stmt = $filter->build();
        $this->assertSame("NOT (`id` >= ?)", $stmt->prepare());
        $this->assertSame([13], $stmt->values());
    }
    
    public function testIs() {
        $filter = Builder::filter()->is("flag", true);
        $stmt = $filter->build();
        $this->assertSame("`flag` IS ?", $stmt->prepare());
        $this->assertSame([1], $stmt->values());
    }
    
    public function testIsNot() {
        $filter = Builder::filter()->is("flag", true, false);
        $stmt = $filter->build();
        $this->assertSame("`flag` IS NOT ?", $stmt->prepare());
        $this->assertSame([1], $stmt->values());
    }
    
    public function testIsNull() {
        $filter = Builder::filter()->isNull("id");
        $stmt = $filter->build();
        $this->assertSame("`id` IS NULL", $stmt->prepare());
        $this->assertSame([], $stmt->values());
    }
    
    public function testIsNotNull() {
        $filter = Builder::filter()->isNull("id", false);
        $stmt = $filter->build();
        $this->assertSame("`id` IS NOT NULL", $stmt->prepare());
        $this->assertSame([], $stmt->values());
    }
    
    public function testLike() {
        $filter = Builder::filter()->like("name", "%van%");
        $stmt = $filter->build();
        $this->assertSame("`name` LIKE ?", $stmt->prepare());
        $this->assertSame(["%van%"], $stmt->values());
    }
    
    public function testLikeNot() {
        $filter = Builder::filter()->like("name", "%van%", false);
        $stmt = $filter->build();
        $this->assertSame("NOT (`name` LIKE ?)", $stmt->prepare());
        $this->assertSame(["%van%"], $stmt->values());
    }
    
    public function testBetween() {
        $filter = Builder::filter()->between("id", 10, 100);
        $stmt = $filter->build();
        $this->assertSame("`id` BETWEEN ? AND ?", $stmt->prepare());
        $this->assertSame([10, 100], $stmt->values());
    }
    
    public function testBetweenNot() {
        $filter = Builder::filter()->between("id", 10, 100, false);
        $stmt = $filter->build();
        $this->assertSame("NOT (`id` BETWEEN ? AND ?)", $stmt->prepare());
        $this->assertSame([10, 100], $stmt->values());
    }
    
    public function testIn() {
        $filter = Builder::filter()->in("id", [1, 2, 3]);
        $stmt = $filter->build();
        $this->assertSame("`id` IN (?, ?, ?)", $stmt->prepare());
        $this->assertSame([1, 2, 3], $stmt->values());
    }
    
    public function testInNot() {
        $filter = Builder::filter()->in("id", [1, 2, 3], false);
        $stmt = $filter->build();
        $this->assertSame("NOT (`id` IN (?, ?, ?))", $stmt->prepare());
        $this->assertSame([1, 2, 3], $stmt->values());
    }
    
    public function testOneLevel() {
        $filter = Builder::filter()
                ->compare("status", 4)
                ->compare("id", [1, 2, 3], false)
                ->between("id", 100, 200);
        $stmt = $filter->build();
        $this->assertSame("(`status` = ?) AND (NOT (`id` IN (?, ?, ?))) AND (`id` BETWEEN ? AND ?)", $stmt->prepare());
        $this->assertSame([4, 1, 2, 3, 100, 200], $stmt->values());
    }
    
    public function testTwoLevels() {
        $filter1 = Builder::filter()
                ->compare("status", 4)
                ->gt("age", 18);
        $filter2 = Builder::filter()
                ->compare("status", 5)
                ->gt("age", 21);;
        $filter = Builder::filter()
                ->compare("id", [1, 2, 3])
                ->compare("name", "A%")
                ->logicOr($filter1)
                ->logicOr($filter2);
        $stmt = $filter->build();
        $this->assertSame("((`id` IN (?, ?, ?)) AND (`name` LIKE ?)) OR ((`status` = ?) AND (`age` > ?)) OR ((`status` = ?) AND (`age` > ?))", $stmt->prepare());
        $this->assertSame([1, 2, 3, "A%", 4, 18, 5, 21], $stmt->values());
    }
    
}
