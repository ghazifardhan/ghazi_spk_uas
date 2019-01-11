<?php

namespace Petruk\Framework;

use Illuminate\Database\Capsule\Manager as Capsule;

class Database {

    public function __construct() {
        $capsule = new Capsule;
        $capsule->addConnection([
         'driver' => getenv('DB_DRIVER'),
         'host' => getenv('DB_HOST'),
         'database' => getenv('DB_NAME'),
         'username' => getenv('DB_USER'),
         'password' => getenv('DB_PASS'),
         'charset' => 'utf8',
         'collation' => 'utf8_unicode_ci',
         'prefix' => '',
        ]);
        // Setup the Eloquent ORM
        $capsule->bootEloquent();
    }

}