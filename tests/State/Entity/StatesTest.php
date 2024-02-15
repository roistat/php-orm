<?php
/**
 * @author Evgeniy Udodov <flr.null@gmail.com>
 */

namespace RsORMTest\State\Entity;

use RsORMTest;
use RsORMTest\State\Stub;

class StatesTest extends RsORMTest\Base {

    /**
     * @var Stub\Entity
     */
    private $_project;

    public function setUp(): void {
        parent::setUp();
        $this->_project = new Stub\Entity();
    }

    public function testStatesOperations() {
        $this->assertSame([], $this->_project->__getInitialState());
        $this->_project->__setInitialState(['name' => 'Test']);
        $this->assertSame(['name' => 'Test'], $this->_project->__getInitialState());

        $this->_project->__setInitialState(['name' => 'Test1'], 1);
        $this->_assertAssocArraysEquals(['id' => 1, 'name' => 'Test1'], $this->_project->__getInitialState());

        $this->_project->id = 3;
        $this->_assertAssocArraysEquals(['id' => 1, 'name' => 'Test1'], $this->_project->__getInitialState());
        $this->_project->__setInitialState(['id' => 2]);
        $this->_assertAssocArraysEquals(['id' => 2], $this->_project->__getInitialState());
        $this->assertSame(3, $this->_project->id);
        $this->_assertAssocArraysEquals(['id' => 3], $this->_project->__getCurrentState());
    }
}
