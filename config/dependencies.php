<?php

use DI\ContainerBuilder;

$builder = new ContainerBuilder();

try {
    return $builder->build();
} catch (Exception $e) {
    $e->getMessage();
}