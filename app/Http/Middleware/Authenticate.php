<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Contracts\Auth\Guard;
use App\Libraries\RequiredConstants;

class Authenticate
{
    /**
     * The Guard implementation.
     *
     * @var Guard
     */
    protected $auth;

    /**
     * Create a new filter instance.
     *
     * @param  Guard  $auth
     * @return void
     */
    public function __construct(Guard $auth)
    {
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
        if ($this->auth->guest()) {
            if ($request->ajax()) {
                return response('Unauthorized.', 401);
            } else {

                $account_sign_in_route = null;
                if ($request->is(RequiredConstants::ADMIN_ROUTE)) {
                    $account_sign_in_route = route('account-admin-sign-in');
                } elseif ($request->is(RequiredConstants::USER_ROUTE)) {
                    $account_sign_in_route = route('account-user-sign-in');
                }
                return redirect()->guest($account_sign_in_route);
            }
        }

        return $next($request);
    }
}
