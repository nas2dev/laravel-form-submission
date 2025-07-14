<?php

namespace App\Http\Middleware;

use Closure;
use App\Models\User;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class isAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $userId = $request->query('user_id');

        if(!$userId) {
            return redirect()->route('HomePage')->with('error', 'User ID is required.');
        }

        $user = User::find($userId);

        if(!$user) {
            $users = User::all();
            return redirect()->route('HomePage', compact('users'))->with('error', 'User not found.');
        }

        if(strtolower($user->role !== 'admin')) {
            $users = User::all();
            return redirect()->route('HomePage', compact('users'))->with('error', 'Access denied. Admin privilages required.');
        }

        return $next($request);
    }
}
