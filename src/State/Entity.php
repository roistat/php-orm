<?php
/**
 * @author Evgeniy Udodov <flr.null@gmail.com>
 */

namespace RsORM\State;

abstract class Entity {

    /**
     * @var string
     */
    protected $__autoIncrementField = 'id';

    /**
     * @var array
     */
    private $__initialState = [];

    /**
     * @return array
     */
    public function __getInitialState() {
        return $this->__initialState;
    }

    /**
     * @param array $initialState
     * @param int $autoIncrementId
     */
    public function __setInitialState(array $initialState, $autoIncrementId = null) {
        // @TODO throw exception if initial state has wrong param
        $this->__initialState = $initialState;
        if ($autoIncrementId !== null) {
            $this->__initialState[$this->__autoIncrementField] = $autoIncrementId;
        }
    }

    /**
     * @return array
     */
    public function __getCurrentState() {
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
