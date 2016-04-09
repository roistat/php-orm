RSDB
====

Simple and fast DB utils with no magic methods. It could be used in high load projects even with partitioning and sharding. 

* ORM package — responsible for object state management. Returns the data that prepared for usage in DB queries.
* Query package — responsible for creating queries from ORM data to specified DB engine. 


ORM
---

All entities should be extended from RSDB\ORM\Entity which encapsulates object state data and get/set methods. All actions are going in RSDB\ORM\Engine.
Engine has several methods: isNew, isChanged, diff. Diff method returns array of changed fields with values.

Examples:

```php
<?php

class User extends ORM\Entity {
    public $id;
    public $name;
}

class Project extends ORM\Entity {
    public $id;
    public $name;
    public $user_id;
}

$engine = new ORM\Engine();

// You could create objects as usual
$project = new Project();

// New objects it's object without initial state
$isNew = $engine->isNew($project); // true
$isChanged = $engine->isChanged($project); // false

$project->name = "Test";
$project->user_id = 1;

$isNew = $engine->isNew($project); // true
$isChanged = $engine->isChanged($project); // true
$diff = $engine->diff($project); // ['name' => 'Test', 'user_id' => 1]

// Flush changes initial state, object now is not new and not changed
$engine->flush($project);

$isNew = $engine->isNew($project); // false
$isChanged = $engine->isChanged($project); // false
$diff = $engine->diff($project); // []

```
