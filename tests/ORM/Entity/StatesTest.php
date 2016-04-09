<?php
/**
 * @author Evgeniy Udodov <flr.null@gmail.com>
 */

namespace RSDBTest\ORM\Entity;

use RSDBTest;
use RSDBTest\ORM\Stub;

class StatesTest extends RSDBTest\Base {

    /**
     * @var Stub\Entity
     */
    private $_project;

    public function setUp() {
        parent::setUp();
        $this->_project = new Stub\Entity();
    }

    public function testStatesOperations() {
        $this->assertSame([], $this->_project->getInitialState());
        $this->_project->setInitialState(['name' => 'Test']);
        $this->assertSame(['name' => 'Test'], $this->_project->getInitialState());

        $this->_project->setInitialState(['name' => 'Test1'], 1);
        $this->_assertAssocArraysEquals(['id' => 1, 'name' => 'Test1'], $this->_project->getInitialState());

        $this->_project->id = 3;
        $this->_assertAssocArraysEquals(['id' => 1, 'name' => 'Test1'], $this->_project->getInitialState());
        $this->_project->setInitialState(['id' => 2]);
        $this->_assertAssocArraysEquals(['id' => 2], $this->_project->getInitialState());
        $this->assertSame(3, $this->_project->id);
        $this->_assertAssocArraysEquals(['id' => 3], $this->_project->getCurrentState());
    }
}
