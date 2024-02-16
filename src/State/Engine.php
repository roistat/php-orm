<?php
/**
 * @author Evgeniy Udodov <flr.null@gmail.com>
 */

namespace RsORM\State;

class Engine {

    private static ?Engine $_instance = null;

    public static function getInstance(): Engine {
        if (self::$_instance) {
            return self::$_instance;
        }
        return self::$_instance = new self();
    }

    public function isNew(Entity $entity): bool {
        return count($entity->__getInitialState()) === 0;
    }

    public function isChanged(Entity $entity): bool {
        return count($this->diff($entity)) > 0;
    }

    public function flush(Entity $entity, string $primaryKeyValue = null): void {
        $entity->__setInitialState($entity->__getCurrentState(), $primaryKeyValue);
    }

    public function diff(Entity $entity): array {
        $result = [];
        $initialState = $entity->__getInitialState();
        $currentState = $entity->__getCurrentState();
        foreach ($initialState as $param => $value) {
            if (!array_key_exists($param, $currentState)) {
                $result[$param] = null;
                continue;
            }
            if ($value !== $currentState[$param]) {
                $result[$param] = $currentState[$param];
            }
        }
        foreach ($currentState as $param => $value) {
            if (!array_key_exists($param, $initialState)) {
                $result[$param] = $value;
            }
        }
        return $result;
    }
}
