<?php
/**
 * @author Evgeniy Udodov <flr.null@gmail.com>
 */

namespace RSDBTest\ORM\Engine;

use RSDB\ORM\Engine;
use RSDBTest;
use RSDBTest\ORM\Stub;

class ChangesTest extends RSDBTest\Base {

    /**
     * @var Stub\Entity
     */
    private $_entity;

    /**
     * @var Engine;
     */
    private $_engine;

    public function setUp() {
        parent::setUp();
        $this->_entity = new Stub\Entity();
        $this->_engine = new Engine();
    }

    public function testIsNew() {
        $this->assertTrue($this->_engine->isNew($this->_entity));
        $this->_entity->name = 'Test';
        $this->assertTrue($this->_engine->isNew($this->_entity));
        $this->_engine->flush($this->_entity);
        $this->assertFalse($this->_engine->isNew($this->_entity));
    }

    public function testIsChanged() {
        $this->assertFalse($this->_engine->isChanged($this->_entity));
        $this->_entity->name = 'Test';
        $this->assertTrue($this->_engine->isChanged($this->_entity));
        $this->_engine->flush($this->_entity);

        $this->assertFalse($this->_engine->isChanged($this->_entity));
        $this->_entity->external_id = 1;
        $this->assertTrue($this->_engine->isChanged($this->_entity));
        $this->_engine->flush($this->_entity);

        $this->_entity->external_id = null;
        $this->assertTrue($this->_engine->isChanged($this->_entity));
    }

    public function testDiff() {
        $this->assertSame([], $this->_engine->diff($this->_entity));
        $this->_entity->name = 'Test';
        $this->assertSame(['name' => 'Test'], $this->_engine->diff($this->_entity));
        $this->_engine->flush($this->_entity);

        $this->assertSame([], $this->_engine->diff($this->_entity));
        $this->_entity->name = 'Test1';
        $this->_entity->id = 1;
        $this->_assertAssocArraysEquals(['id' => 1, 'name' => 'Test1'], $this->_engine->diff($this->_entity));
        $this->_engine->flush($this->_entity);

        $this->_entity->id = null;
        $this->_assertAssocArraysEquals(['id' => null], $this->_engine->diff($this->_entity));
        $this->_entity->name = 'Test2';
        $this->_assertAssocArraysEquals(['id' => null, 'name' => 'Test2'], $this->_engine->diff($this->_entity));
    }
}

