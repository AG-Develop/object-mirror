<?php

$finder = PhpCsFixer\Finder::create()
    ->in(__DIR__ . '/example')
    ->in(__DIR__ . '/src')
    ->in(__DIR__ . '/test')
;

$config = new PhpCsFixer\Config();
return $config->setRules([
    '@Symfony' => true,
    'array_syntax' => ['syntax' => 'short'],
])
    ->setFinder($finder)
    ;
