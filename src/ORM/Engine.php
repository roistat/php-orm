<?php
/**
 * @author Evgeniy Udodov <flr.null@gmail.com>
 */

namespace RSDB\ORM;

class Engine {

    /**
     * @param Entity $entity
     * @return bool
     */
    public function isNew(Entity $entity) {
        return count($entity->__getInitialState()) === 0;
    }

    /**
     * @param Entity $entity
     * @return bool
     */
    public function isChanged(Entity $entity) {
        return count($this->diff($entity)) > 0;
    }

    /**
     * @param Entity $entity
     */
    public function flush(Entity $entity) {
        $entity->__setInitialState($entity->__getCurrentState());
    }

    /**
     * @param Entity $entity
     * @return array
     */
    public function diff(Entity $entity) {
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
