<?php

$app->hook('slim.before', function () use ($app) {
    $config = $app->settings;
    if (isset($config['view.parser']['options'])) {
        $app->view->parserOptions = $app->settings['view.parser']['options'];
    }
    if (isset($config['view.parser']['extensions'])) {
        $app->view->parserExtensions = array_map(function ($ext) use ($app) {
            if (is_string($ext) && $app->container->has($ext)) {
                $ext = $app->container->get($ext);
            }

            if (is_string($ext) && class_exists($ext)) {
                $ext = new $ext;
            }

            if (!$ext instanceof Twig_Extension) {
                throw new RuntimeException('Invalid twig extension');
            }

            return $ext;
        }, $config['view.parser']['extensions']);
    }
});
