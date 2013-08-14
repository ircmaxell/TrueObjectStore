<?php

use TrueObjectStore\TrueObjectStore;
use TrueObjectStore\TypedObjectStore;
require 'vendor/autoload.php';

$store = new TrueObjectStore;

$store[new StdClass] = 1;
$store[new StdClass] = 2;
$store[new StdClass] = 3;
$store[new StdClass] = 4;
$store[new StdClass] = 5;
$store[new StdClass] = 6;

foreach ($store as $key => $value) {
    $key->value = $value;
}

foreach ($store as $key => $value) {
    var_dump($key, $value);
}

interface Bar {}
class Foo implements Bar {
}

$store2 = new TypedObjectStore(Bar::class);
$store2[new Foo] = 1;
$store2[new Foo] = 2;
try {
    $store2[new Stdclass] = 3;
} catch (RuntimeException $e) {
    echo "Exception caught\n";
}
var_dump($store2);