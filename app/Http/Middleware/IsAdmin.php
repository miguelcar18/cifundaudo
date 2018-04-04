<?php

namespace Fundaudo\Http\Middleware;

use Illuminate\Contracts\Auth\Guard;
use Redirect;
use Closure;
Use Session;

class IsAdmin
{
    protected $auth;

    public function __construct(Guard $auth){
        $this->auth = $auth;
    }

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if ($this->auth->user()->rol == 3) {
            //$this->auth->logout();
            if ($request->ajax()) {
                //return response('Unauthorized.', 401);
                Session::flash('message', 'Sin privilegios');
                return Redirect::route('principal');
            } else {
                Session::flash('message', 'Sin privilegios');
                return Redirect::route('principal');
            }
        }

        return $next($request);
    }
}
