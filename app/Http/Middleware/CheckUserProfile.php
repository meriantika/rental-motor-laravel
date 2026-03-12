<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CheckUserProfile
{
    public function handle(Request $request, Closure $next)
    {
        $user = auth()->user();

        if (!$user->phone || !$user->nik || !$user->address) {

            session([
                'sewa_motor_id' => $request->route('id'),
                'start_date' => $request->start_date,
                'end_date' => $request->end_date
            ]);

            return redirect()->route('profile');
        }

        return $next($request);
    }
}