<?php

// Create a Filesystem instance
$filesystem = new Illuminate\Filesystem\Filesystem();

// Create a new FileLoader instance specifying the translation path
$loader = new Illuminate\Translation\FileLoader($filesystem, dirname(dirname(__FILE__)) . "/app/lib/lang");

// Specify the translation namespace
$loader->addNamespace("lang", dirname(dirname(__FILE__)) . "/app/lib/lang");

// This is used to create the path to your validation.php file
$loader->load($lang = "en", $group = "validation", $namespace = "lang");

$factory = new Illuminate\Translation\Translator($loader, "en");

$validator = new Illuminate\Validation\Factory($factory);


?>