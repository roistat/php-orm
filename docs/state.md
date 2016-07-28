# State package

State package consists of `State\Entity` and `State\Engine` classes. All entities should be extended from `State\Entity` which encapsulates object state data and get/set methods. All actions are going in `State\Engine`. Entity class may be extended with methods, which could return table name or field names. `State\Engine` class has static method `getInstance`, which initialize new object of `State\Engine` class or get existing and return it.

## State\Entity

At first, you should define class, which extends `State\Entity`. Basically it looks like:

```php
class Account extends State\Entity {
	public $id;
	public $email;
	public $password;
}
```

Than you can extends your class with helper methods for table name or field name definitions, or any set / get methods.

```php
class Account extends State\Entity {
	public $id;
	public $email;
	public $password;
	
	// return table name
	public static function table() {
		return "account_table";
	}
	
	// return field name for id property
	public static function id() {
		return "acc_id";
	}
	
	// set password property
	public function setPassword($password) {
		$this->password = md5($password);
	}
}
```

## State\Engine

With `State\Engine` class you can control state of your `State\Entity` objects. Hereinafter we will operate our first example, where we define basic `Account` class (without helper methods).

At first we need to get `State\Engine` object. You can create new instance of this class:

```php
$engine = new State\Engine();
```

But commonly it is more convenient to get already existing instance if it is created earlier. If instance of `State\Engine` isn't created yet, it would be created.

```php
$engine = State\Engine::getInstance();
```

Than we can check our object by new / not new state. It's useful for choosing among insert and update statement.

```php
$account = new Account();
$account->email = "qwe@qwe.qwe";
$account->password = "123456";
$engine->isNew($account); // true
```

Now we know, that our object is new and we can insert it into DB. After inserting we should change state of our object. This operation was named: `flush`. Example:

```php
$engine->flush($account);
$engine->isNew($account); // false
```

We want to change password for our account and check state of our object for any changes.

```php
$engine->isChanged($account); // false - no any changes
$account->password = "654321";
$engine->isChanged($account); // true - we did changes
```

We know, that account was changed, and we need to update it in the table of DB. But not all fields was changed. Method `diff` helps us to determine which fields was changed.

```php
$engine->diff($account); // ["password" => "654321"]
```

These fields we need to update in the table. After update we should to flush our account.

```php
$engine->flush($account);
$engine->isChanged(); // false
$engine->diff(); // []
```