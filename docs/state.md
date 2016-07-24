# State

Namespace: `RsORM\State`

State package consists of `State\Entity` and `State\Engine` classes.  
All entities should be extended from `RsORM\State\Entity` which encapsulates object state data and get/set methods. All actions are going in `RsORM\State\Engine`. Entity class may be extended with methods, which could return table name or field names.  
`State\Engine` class has static method `getInstance`, which initialize new object of `State\Engine` class or get existing and return it.

## State\Entity

Entity - abstract class, on base of it you can create your own entity classes, which extend `State\Entity`. This new classes you can use in `State\Engine` for control changes of each object.

### Example

```php
class Account extends State\Entity {
	public $id;
	public $email;
	public $password;
	public $ip;
}
```

## State\Engine methods

 - [*getInstance*](#getinstance) - get engine instance (static method).
 - [*isNew*](#isnew) - check entity is new.
 - [*isChanged*](#ischanged) - check entity is changed.
 - [*flush*](#flush) - flush all changes in entity.
 - [*diff*](#diff) - get all changed properties of entity, return data in form of key-value array.

### getInstance

Get engine instance (static method).

```php
State\Engine getInstance()
```

#### Return values

Return instance of `State\Engine`. If engine is not created yet, than create it previously and return its instance.

#### Example

```php
$engine = State\Engine::getInstance();
// Than you can do anything like this
$engine->isNew(...);
$engine->diff(...);
```

### isNew

Check entity is new.

```php
boolean isNew(State\Entity $entity)
```

#### Parameters

*entity* - `State\Entity` object.

#### Return values

It returns true in case of all object properties was currently initialize. False - in case of object was flushed.

#### Example

```php
$engine = State\Engine::getInstance();
class User extends State\Entity {
	public $id;
	public $name;
}

// Initialize user and set properties
$user = new User();
$user->id = 1;
$user->name = "Mike";
$engine->isNew($user); // true

// Flush user
$engine->flush($user);
$engine->isNew($user); // false

// Change user properties
$user->id = 2;
$user->name = "Egor";
$engine->isNew($user); // false
```

### isChanged

Check entity is changed.

```php
boolean isChanged(State\Entity $entity)
```

#### Parameters

*entity* - `State\Entity` object.

#### Example

```php
$engine = State\Engine::getInstance();
class User extends State\Entity {
	public $id;
	public $name;
}

// Initialize user and flush it
$user = new User();
$user->id = 1;
$user->name = "Mike";
$engine->flush($user);

// Test changes
$engine->isChanged($user); // false

// Change user properties and test it again
$user->id = 2;
$user->name = "Egor";
$engine->isChanged($user); // true
```

### flush

Flush all changes in entity.

```php
flush(State\Entity $entity)
```

#### Parameters

*entity* - `State\Entity` object.

#### Example

```php
$engine = State\Engine::getInstance();
class User extends State\Entity {
	public $id;
	public $name;
}

// Initialize user
$user = new User();
$user->id = 1;
$user->name = "Mike";
$engine->isNew($user); // true
$engine->flush($user);
$engine->isNew($user); // false

// Change user
$user->id = 2;
$user->name = "Egor";
$engine->isChanged($user); // true
$engine->flush($user);
$engine->isChanged($user); // false
```

### diff

Get all changed properties of entity, return data in form of key-value array.

```php
array diff(State\Entity $entity)
```

#### Parameters

*entity* - `State\Entity` object.

#### Return values

Returns data in form of key-value array. Returns only properties and their values, that was changed after last `flush` operation or after object initialization.

#### Example

```php
$engine = State\Engine::getInstance();
class User extends State\Entity {
	public $id;
	public $name;
	public $last_name;
}

// Initialize user
$user = new User();
$user->id = 1;
$user->name = "John";
$user->last_name = "Black";
$engine->diff($user); // ["id" => 1, "name" => "John", "last_name" => "Black"]

// Flush user
$engine->flush($user);
$engine->diff($user); // []

// Change user
$user->last_name = "Green";
$engine->diff($user); // ["last_name" => "Green"]

// And flush user again
$engine->flush($user);
$engine->diff($user); // []
```

