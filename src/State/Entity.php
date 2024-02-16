<?php
/**
 * @author Evgeniy Udodov <flr.null@gmail.com>
 */

namespace RsORM\State;

abstract class Entity {

    private array $__initialState = [];

    public static function primaryKeyFieldName(): string {
        return 'id';
    }

    public function __getInitialState(): array {
        return $this->__initialState;
    }

    public function __setInitialState(array $initialState, string $primaryKeyValue = null): void {
        // @TODO throw exception if initial state has wrong param
        $this->__initialState = $initialState;
        if ($primaryKeyValue !== null && self::primaryKeyFieldName()) {
            $this->__initialState[self::primaryKeyFieldName()] = filter_var($primaryKeyValue, FILTER_VALIDATE_INT) ? (int)$primaryKeyValue : $primaryKeyValue;
        }
    }

    public function __getCurrentState(): array {
        $result = [];
        foreach (get_object_vars($this) as $param => $value) {
            if (strpos($param, '__') === 0) {
                continue;
            }
            if ($value === null) {
                continue;
            }
            $result[$param] = $value;
        }
        return $result;
    }
}
