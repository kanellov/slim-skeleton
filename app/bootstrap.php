<?php

return function (Slim\Slim $app) {

    array_map(function ($file) use ($app) {
        include $file;
    }, glob(__DIR__ . '/{services,hooks,routes}/{,*/}*.php', GLOB_BRACE));

    return $app;
};
