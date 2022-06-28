<?php

namespace App\Http\Middleware;

use App\Enum\UsersType;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminCompanyMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        if(Auth::user()->type_id != 3 ) {
            return abort(403);
        }
        if(Auth::user()->operator->is_administrator != 1){
            return abort(403);
        }
        if(Auth::user()->operator->entity_type != 'App\Models\FinanceCompany'){
            return abort(403);
        }
        return $next($request);
    }
}
