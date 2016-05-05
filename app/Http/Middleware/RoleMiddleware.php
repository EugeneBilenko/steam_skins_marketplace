<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Config;

class RoleMiddleware
{
    /**
     * Run the request filter.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string  $role
     * @return mixed
     */
    public function handle($request, Closure $next, $role)
    {
        $roles = Config::get('roles');

        $userRole = $request->user()->role;
        if(!isset($roles[$role]['level'])){
            return $this->redirect($request,'Role "'. $role . '" not configured');
        }
        if(!isset($roles[$userRole]['level'])){
            return $this->redirect($request,'User role "'. $userRole . '" not configured');
        }
        if ($roles[$userRole]['level'] < $roles[$role]['level']) {

            return $this->redirect($request,'Permission denied');
        }

        return $next($request);
    }

    private function redirect($request, $message){

        session()->flash('msg',$message);
        session()->flash('msg-type', 'warning');
        if ($request->ajax() || $request->wantsJson()) {

            return response($message, 401);
        } else {

            return redirect('/');
        }
    }
}