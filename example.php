<?php

$laravel = function(Closure $f) {
    $req = 1;

    echo "Starting Laravel \n";
    echo "Response from Middleware: ".$f($req)."\n";
    echo "Ending Laravel \n";
};

$m1 = $m2 = function(Closure $next) {
    return function($req) use ($next) {
        echo "Starting Middleware $req\n";
        $res = $next($req + 1);
        echo "Returning Middleware $req\n";
        return $res.' '.$req;
    };
};

$app = function($req) {
    echo "Running app with the request: $req\n";
    return "Response";
};

$laravel($m1($m2($app)));


// Output
/*
 * Starting Laravel 
 * Starting Middleware 1
 * Starting Middleware 2
 * Running app with the request: 3
 * Returning Middleware 2
 * Returning Middleware 1
 * Response from Middleware: Response 2 1
 * Ending Laravel 
 */
