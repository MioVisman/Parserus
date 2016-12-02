<?php

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
