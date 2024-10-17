<?php

namespace App\Http\Middleware;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Middleware;

class HandleInertiaRequests extends Middleware
{
    /**
     * The root template that's loaded on the first page visit.
     *
     * @see https://inertiajs.com/server-side-setup#root-template
     *
     * @var string
     */
    protected $rootView = 'app';

    /**
     * Determines the current asset version.
     *
     * @see https://inertiajs.com/asset-versioning
     */
    public function version(Request $request): ?string
    {
        return parent::version($request);
    }

    /**
     * Define the props that are shared by default.
     *
     * @see https://inertiajs.com/shared-data
     *
     * @return array<string, mixed>
     */
    public function share(Request $request): array
    {
        return array_merge(parent::share($request), [
            'auth.user' => function () {
                if (Auth::check()) {
                    if (Auth::user()->role_id === 1) {
                        return Auth::user()->loadMissing('candidate:id,user_id,avatar,name');
                    } else {
                        return Auth::user()->loadMissing('company:id,user_id,logo,name');
                    }
                }
                return null;
            } ,
            'message' => fn () => $request->session()->get('message')
        ]);
    }
}
