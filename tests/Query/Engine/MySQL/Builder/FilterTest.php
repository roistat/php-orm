<?php

/**
 * @author Michael Slyshkin <m.slyshkin@gmail.com>
 */

namespace RsORMTest\Query\Engine\MySQL\Builder;

use RsORMTest;
use RsORM\Query\Engine\MySQL\Builder;

class FilterTest extends RsORMTest\Base {
    
    public function testCompareInt() {
        $stmt = Builder::filter()->compare("id", 13)->build();
        $this->assertSame("`id` = ?", $stmt->prepare());
        $this->assertSame([13], $stmt->values());
    }
    
    public function testCompareIntNot() {
        $stmt = Builder::filter()->compare("id", 13, false)->build();
        $this->assertSame("`id` != ?", $stmt->prepare());
        $this->assertSame([13], $stmt->values());
    }
    
    public function testCompareDouble() {
        $stmt = Builder::filter()->compare("pi", 3.14)->build();
        $this->assertSame("`pi` = ?", $stmt->prepare());
        $this->assertSame([3.14], $stmt->values());
    }
    
    public function testCompareDoubleNot() {
        $stmt = Builder::filter()->compare("pi", 3.14, false)->build();
        $this->assertSame("`pi` != ?", $stmt->prepare());
        $this->assertSame([3.14], $stmt->values());
    }
    
    public function testComapareString() {
        $stmt = Builder::filter()->compare("name", "%van%")->build();
        $this->assertSame("`name` LIKE ?", $stmt->prepare());
        $this->assertSame(["%van%"], $stmt->values());
    }
    
    public function testComapareStringNot() {
        $stmt = Builder::filter()->compare("name", "%van%", false)->build();
        $this->assertSame("NOT (`name` LIKE ?)", $stmt->prepare());
        $this->assertSame(["%van%"], $stmt->values());
    }
    
    public function testComapareBoolean() {
        $stmt = Builder::filter()->compare("flag", false)->build();
        $this->assertSame("`flag` IS ?", $stmt->prepare());
        $this->assertSame([0], $stmt->values());
    }
    
    public function testComapareBooleanNot() {
        $stmt = Builder::filter()->compare("flag", false, false)->build();
        $this->assertSame("`flag` IS NOT ?", $stmt->prepare());
        $this->assertSame([0], $stmt->values());
    }
    
    public function testComapareNull() {
        $stmt = Builder::filter()->compare("id", null)->build();
        $this->assertSame("`id` IS NULL", $stmt->prepare());
        $this->assertSame([], $stmt->values());
    }
    
    public function testComapareNullNot() {
        $stmt = Builder::filter()->compare("id", null, false)->build();
        $this->assertSame("`id` IS NOT NULL", $stmt->prepare());
        $this->assertSame([], $stmt->values());
    }
    
    public function testComapareArray() {
        $stmt = Builder::filter()->compare("id", [1, 2, 3])->build();
        $this->assertSame("`id` IN (?, ?, ?)", $stmt->prepare());
        $this->assertSame([1, 2, 3], $stmt->values());
    }
    
    public function testComapareArrayNot() {
        $stmt = Builder::filter()->compare("id", [1, 2, 3], false)->build();
        $this->assertSame("NOT (`id` IN (?, ?, ?))", $stmt->prepare());
        $this->assertSame([1, 2, 3], $stmt->values());
    }
    
    public function testEq() {
        $stmt = Builder::filter()->eq("id", 13)->build();
        $this->assertSame("`id` = ?", $stmt->prepare());
        $this->assertSame([13], $stmt->values());
    }
    
    public function testEqNot() {
        $stmt = Builder::filter()->eq("id", 13, false)->build();
        $this->assertSame("`id` != ?", $stmt->prepare());
        $this->assertSame([13], $stmt->values());
    }
    
    public function testLt() {
        $stmt = Builder::filter()->lt("id", 13)->build();
        $this->assertSame("`id` < ?", $stmt->prepare());
        $this->assertSame([13], $stmt->values());
    }
    
    public function testLtNot() {
        $stmt = Builder::filter()->lt("id", 13, false)->build();
        $this->assertSame("NOT (`id` < ?)", $stmt->prepare());
        $this->assertSame([13], $stmt->values());
    }
    
    public function testLte() {
        $stmt = Builder::filter()->lte("id", 13)->build();
        $this->assertSame("`id` <= ?", $stmt->prepare());
        $this->assertSame([13], $stmt->values());
    }
    
    public function testLteNot() {
        $stmt = Builder::filter()->lte("id", 13, false)->build();
        $this->assertSame("NOT (`id` <= ?)", $stmt->prepare());
        $this->assertSame([13], $stmt->values());
    }
    
    public function testGt() {
        $stmt = Builder::filter()->gt("id", 13)->build();
        $this->assertSame("`id` > ?", $stmt->prepare());
        $this->assertSame([13], $stmt->values());
    }
    
    public function testGtNot() {
        $stmt = Builder::filter()->gt("id", 13, false)->build();
        $this->assertSame("NOT (`id` > ?)", $stmt->prepare());
        $this->assertSame([13], $stmt->values());
    }
    
    public function testGte() {
        $stmt = Builder::filter()->gte("id", 13)->build();
        $this->assertSame("`id` >= ?", $stmt->prepare());
        $this->assertSame([13], $stmt->values());
    }
    
    public function testGteNot() {
        $stmt = Builder::filter()->gte("id", 13, false)->build();
        $this->assertSame("NOT (`id` >= ?)", $stmt->prepare());
        $this->assertSame([13], $stmt->values());
    }
    
    public function testIs() {
        $stmt = Builder::filter()->is("flag", true)->build();
        $this->assertSame("`flag` IS ?", $stmt->prepare());
        $this->assertSame([1], $stmt->values());
    }
    
    public function testIsNot() {
        $stmt = Builder::filter()->is("flag", true, false)->build();
        $this->assertSame("`flag` IS NOT ?", $stmt->prepare());
        $this->assertSame([1], $stmt->values());
    }
    
    public function testIsNull() {
        $stmt = Builder::filter()->isNull("id")->build();
        $this->assertSame("`id` IS NULL", $stmt->prepare());
        $this->assertSame([], $stmt->values());
    }
    
    public function testIsNotNull() {
        $stmt = Builder::filter()->isNull("id", false)->build();
        $this->assertSame("`id` IS NOT NULL", $stmt->prepare());
        $this->assertSame([], $stmt->values());
    }
    
    public function testLike() {
        $stmt = Builder::filter()->like("name", "%van%")->build();
        $this->assertSame("`name` LIKE ?", $stmt->prepare());
        $this->assertSame(["%van%"], $stmt->values());
    }
    
    public function testLikeNot() {
        $stmt = Builder::filter()->like("name", "%van%", false)->build();
        $this->assertSame("NOT (`name` LIKE ?)", $stmt->prepare());
        $this->assertSame(["%van%"], $stmt->values());
    }
    
    public function testBetween() {
        $stmt = Builder::filter()->between("id", 10, 100)->build();
        $this->assertSame("`id` BETWEEN ? AND ?", $stmt->prepare());
        $this->assertSame([10, 100], $stmt->values());
    }
    
    public function testBetweenNot() {
        $stmt = Builder::filter()->between("id", 10, 100, false)->build();
        $this->assertSame("NOT (`id` BETWEEN ? AND ?)", $stmt->prepare());
        $this->assertSame([10, 100], $stmt->values());
    }
    
    public function testIn() {
        $stmt = Builder::filter()->in("id", [1, 2, 3])->build();
        $this->assertSame("`id` IN (?, ?, ?)", $stmt->prepare());
        $this->assertSame([1, 2, 3], $stmt->values());
    }
    
    public function testInNot() {
        $stmt = Builder::filter()->in("id", [1, 2, 3], false)->build();
        $this->assertSame("NOT (`id` IN (?, ?, ?))", $stmt->prepare());
        $this->assertSame([1, 2, 3], $stmt->values());
    }
    
    public function testOneLevel() {
        $stmt = Builder::filter()
                ->compare("status", 4)
                ->compare("id", [1, 2, 3], false)
                ->between("id", 100, 200)
                ->build();
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
        $stmt = Builder::filter()
                ->compare("id", [1, 2, 3])
                ->compare("name", "A%")
                ->logicOr($filter1)
                ->logicOr($filter2)
                ->build();
        $this->assertSame("((`id` IN (?, ?, ?)) AND (`name` LIKE ?)) OR ((`status` = ?) AND (`age` > ?)) OR ((`status` = ?) AND (`age` > ?))", $stmt->prepare());
        $this->assertSame([1, 2, 3, "A%", 4, 18, 5, 21], $stmt->values());
    }
    
}
