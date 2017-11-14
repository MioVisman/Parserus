<?php

if (! class_exists('\PHPUnit_Framework_TestCase') && class_exists('\PHPUnit\Framework\TestCase')) {
    class_alias('\PHPUnit\Framework\TestCase', '\PHPUnit_Framework_TestCase');
}

#include 'Parserus.php';

spl_autoload_register(
    function($className)
    {
        if ($className == 'Parserus') {

            $path = __DIR__ . '/../Parserus.php';

            if (file_exists($path)) {
                include $path;
            }
        }
    }
);
