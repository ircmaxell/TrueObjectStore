<?php

namespace TrueObjectStore;

class TrueObjectStore implements \Countable, \ArrayAccess, \IteratorAggregate {
    protected $store = [];

    public function getIterator() {
        foreach ($this->store as list($key, $value)) {
            yield $key => $value;
        }
    }

    public function count() {
        return count($this->store);
    }

    public function offsetExists($key) {
        return isset($this->store[$this->hash($key)]);
    }

    public function offsetGet($key) {
        $hash = $this->hash($key);
        if (isset($this->store[$hash])) {
            return $this->store[$hash][1];
        }
        return null;
    }

    public function offsetSet($key, $value) {
        $hash = $this->hash($key);
        $this->store[$hash] = [$key, $value];
    }

    public function offsetUnset($key) {
        unset($this->store[$this->hash($key)]);
    }

    protected function hash($key) {
        if (is_object($key)) {
            return 'o_' . spl_object_hash($key);
        } else {
            throw new \InvalidArgumentException('A non-object key was provided!');
        }
    }
}