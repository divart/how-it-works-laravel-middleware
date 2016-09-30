<?php

namespace App\Http\Middleware;

use Closure;

class WordSwap
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next, $old = 'Hello', $new = 'Goodbye')
    {
        $res = $next($request);
        $res->setContent(preg_replace("/$old/", $new, $res->getContent()));
        return $res;
    }

    public function terminate($request, $res)
    {
        sleep(2);
        echo " means 'Goodbye'";
    }
}
