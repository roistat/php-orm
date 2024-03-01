<?php

/**
 * @author Michael Slyshkin <m.slyshkin@gmail.com>
 */

namespace RsORMTest\Query\Engine;

use RsORM\Query\Engine;
use RsORM\Query\Engine\MySQL\Condition;
use RsORM\Query\Engine\MySQL\Argument;
use RsORM\Query\Engine\MySQL\Clause;
use RsORM\Query\Engine\MySQL\Operator;
use RsORMTest;

class MySQLTest extends RsORMTest\Base {
    
    private $mysql;
    
    protected function setUp(): void {
        $this->mysql = new Engine\MySQL();
    }
    
    public function testSelect() {
        $objects = new Clause\Objects([
            new Argument\Field(new Argument\Column("id")),
            new Argument\Field(new Argument\Column("name")),
        ]);
        $table = new Clause\From(new Argument\Table("table"));
        $filter = new Clause\Filter(new Condition\LogicalOr([
            new Condition\Equal(new Argument\Column("id"), new Argument\Value(10)),
            new Condition\Equal(new Argument\Column("id"), new Argument\Value(20)),
        ]));
        $group = new Clause\Group([new Argument\Column("id")]);
        $having = new Clause\Having(new Condition\Equal(new Argument\Column("alive"), new Argument\Value(true)));
        $order = new Clause\Order([new Argument\Desc(new Argument\Column("id"))]);
        $limit = new Clause\Limit(new Argument\Value(5), new Argument\Value(10));
        $stmt = $this->mysql->select($objects, $table, $filter, $group, $having, $order, $limit);
        $this->assertSame("SELECT id, name FROM table WHERE (id = ?) OR (id = ?) GROUP BY id HAVING alive = ? ORDER BY id DESC LIMIT ? OFFSET ?", $stmt->prepare());
        $this->assertSame([10, 20, 1, 5, 10], $stmt->values());
    }
    
    public function testDelete() {
        $table = new Clause\From(new Argument\Table("table"));
        $filter = new Clause\Filter(new Condition\LogicalOr([
            new Condition\Equal(new Argument\Column("id"), new Argument\Value(10)),
            new Condition\Equal(new Argument\Column("id"), new Argument\Value(20)),
        ]));
        $order = new Clause\Order([new Argument\Desc(new Argument\Column("id"))]);
        $limit = new Clause\Limit(new Argument\Value(5), new Argument\Value(10));
        $stmt = $this->mysql->delete($table, $filter, $order, $limit);
        $this->assertSame("DELETE FROM table WHERE (id = ?) OR (id = ?) ORDER BY id DESC LIMIT ? OFFSET ?", $stmt->prepare());
        $this->assertSame([10, 20, 5, 10], $stmt->values());
    }
    
    public function testUpdate() {
        $table = new Clause\Target(new Argument\Table("table"));
        $set = new Clause\Set([
            new Operator\Assign(new Argument\Column("id"), new Argument\Value(1)),
            new Operator\Assign(new Argument\Column("name"), new Argument\Value("Mike")),
            new Operator\Assign(new Argument\Column("qwerty"), new Argument\NullValue()),
        ]);
        $filter = new Clause\Filter(new Condition\LogicalOr([
            new Condition\Equal(new Argument\Column("id"), new Argument\Value(10)),
            new Condition\Equal(new Argument\Column("id"), new Argument\Value(20)),
        ]));
        $order = new Clause\Order([new Argument\Desc(new Argument\Column("id"))]);
        $limit = new Clause\Limit(new Argument\Value(5), new Argument\Value(10));
        $stmt = $this->mysql->update($table, $set, $filter, $order, $limit);
        $this->assertSame("UPDATE table SET id = ?, name = ?, qwerty = NULL WHERE (id = ?) OR (id = ?) ORDER BY id DESC LIMIT ? OFFSET ?", $stmt->prepare());
        $this->assertSame([1, "Mike", 10, 20, 5, 10], $stmt->values());
    }
    
    public function testInsert() {
        $columns = new Clause\Columns([
            new Argument\Column("id"),
            new Argument\Column("name"),
            new Argument\Column("qwe"),
        ]);
        $table = new Clause\Into(new Argument\Table("table"));
        $values = new Clause\Values([
            new Argument\Value(1),
            new Argument\Value("Mike"),
            new Argument\NullValue(),
        ]);
        $stmt = $this->mysql->insert($table, $values, $columns);
        $this->assertSame("INSERT INTO table (id, name, qwe) VALUES (?, ?, NULL)", $stmt->prepare());
        $this->assertSame([1, "Mike"], $stmt->values());
    }

    public function testUpsert() {
        $columns = new Clause\Columns([
            new Argument\Column("id"),
            new Argument\Column("name"),
            new Argument\Column("qwe"),
        ]);
        $table = new Clause\Into(new Argument\Table("table"));
        $values = new Clause\Values([
            new Argument\Value(1),
            new Argument\Value("Mike"),
            new Argument\NullValue(),
        ]);
        $stmt = $this->mysql->upsert($table, $values, $columns);
        $this->assertSame("UPSERT INTO table (id, name, qwe) VALUES (?, ?, NULL)", $stmt->prepare());
        $this->assertSame([1, "Mike"], $stmt->values());
    }

    public function testUpsertMultiple() {
        $columns = new Clause\Columns([
            new Argument\Column("id"),
            new Argument\Column("name"),
            new Argument\Column("qwe"),
        ]);
        $table = new Clause\Into(new Argument\Table("table"));
        $values = new Clause\Values(
            [
                [
                    new Argument\Value(1),
                    new Argument\Value("Mike1"),
                    new Argument\NullValue(),
                ],
                [
                    new Argument\Value(2),
                    new Argument\Value("Mike2"),
                    new Argument\NullValue(),
                ]
            ]
        );
        $stmt = $this->mysql->upsert($table, $values, $columns);
        $this->assertSame("UPSERT INTO table (id, name, qwe) VALUES (?, ?, NULL), (?, ?, NULL)", $stmt->prepare());
        $this->assertSame([1, "Mike1", 2, "Mike2"], $stmt->values());
    }
    
}
