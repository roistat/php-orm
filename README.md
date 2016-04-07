ORM
===

Требования
----------

* ORM обеспечивает 2 основных процесса: из данных бизнес логики создаем структуру для запроса в БД и из ответа БД создаем данные для бизнес логики
* ORM должна осуществлять только маппинг и не делать никаких действий. В том числе не должна делать сами запросы в БД. Работа должна осуществляться через интерфейсы без упоминания конкретных БД или драйверов
* Поддержка рефакторинга. В текстовом виде поля объекта могут упоминаться только внутри класса объекта. То есть любой рефакторинг должен иметь возможность быть сделанным не выходя из файла с классом объекта
* Должна быть поддержка обновления данных конкретного объекта. Если у объекта изменилось поле name, то запрос в MySQL должен быть UPDATE ... SET name = :newName WHERE id = :id

Основные сценарии использования
-------------------------------

* Во всех случаях на выходе мы получаем подготовленную для запроса в БД информацию. 
* Получить данные из БД по заданному фильтру. На входе мы имеем набор фильтров. Каждый фильтр состоит из трех обязательных атрибутов: field, operator, value.
* Сохранить данные в бд. На входе мы имеем объекты.

Примеры
-------

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

// Движок работает с ORM\Entity, содержит всю основную логику
$engine = ORM\Engine::mysql()

// Объекты программист может создавать как обычно
$project = new Project();
$project->name = "Test";
$project->user_id = 1;


// Новым считается объект без initial state
$isNew = $engine->isNew($project); // true

// У нового объекта все данные нужны для инсерта
$dataToInsert = $engine->getInsertData($project); // ['name' => 'Test', 'user_id' => 1]

// Для реплейса аналогично
$dateToReplace = $engine->getReplaceData($project); // ['name' => 'Test', 'user_id' => 1]

// Апдейта у нового объекта не может быть
$dataToUpdate = $engine->getUpdateData($project); // []

// После загрузки объекта из БД или после его сохранения, нужно установить initial state
// Если это был инсерт, то при необходимости можно добавить полученный id
// initial state сохраняется в protected переменную внутри объекта
$engine->setInitialState($project, ['id' => 1]);


// Теперь объект считается существующим
$isNew = $engine->isNew($project); // false

// Существующий объект нельзя инсертить
$dataToInsert = $engine->getInsertData($project); // []

// Для реплейса он по-прежнему доступен, но уже может содержать больше данных
$dateToReplace = $engine->getReplaceData($project); // ['id' => 1, 'name' => 'Test', 'user_id' => 1]

// Для апдейта ничего нет, так как мы пока ничего не меняли
$dataToUpdate = $engine->getUpdateData($project); // []

// После смены свойств у объекта, для инсерта и реплейса ничего не меняется, а вот для апдейта появляется диф
$project->name = 'New name';
$dataToInsert = $engine->getInsertData($project); // []
$dateToReplace = $engine->getReplaceData($project); // ['id' => 1, 'name' => 'New name', 'user_id' => 1]
$dataToUpdate = $engine->getUpdateData($project);

// values — поля для апдейта
// filter — стандартный фильтр про PK + предыдущему значению поля
// filter_strict — фильтр по полному предыдущему состоянию объекта для критичных к консистетности данных ситуаций
$dateToUpdate = [
    'values' => [
        'name' => 'New name',    
    ],
    'filter' => [
        'id'   => 1,
        'name' => 'Test',
    ],
    'filter_strict' => [
        'id'   => 1,
        'name' => 'Test',
        'user_id' => 1,
    ],
];



```
