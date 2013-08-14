<?php

namespace TrueObjectStore;

class TypedObjectStore extends TrueObjectStore {
    protected $type;

    public function __construct($type) {
        $this->type = $type;
    }

    protected function hash($key) {
        if (! $key instanceof $this->type) {
            throw new \RuntimeException('Expected ' . $this->type . ', got ' . get_class($key));
        }
        return parent::hash($key);
    }
}