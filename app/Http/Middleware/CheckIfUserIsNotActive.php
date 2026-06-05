<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckIfUserIsNotActive
{
    public function handle(Request $request, Closure $next): Response
    {
        $user = auth()->user();

        if ($user && $user->account->is_suspended) {
            return redirect()->back()->with('error', 'Your account has been deactivated, please talk to support for a resolution.');
        }

        return $next($request);
    }
}
