<?php

namespace App\Http\Controllers\Rss;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Rss;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Inertia\Inertia;

class RegisteredRssController extends Controller
{
     /**
     * Display the registration view.
     *
     * @return \Inertia\Response
     */
    public function create()
    {
        return Inertia::render('Rss/Register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request)
    {
        $request->validate([
            'rss' => 'url'
        ]);

        $rss = Rss::create([
            'rss' => $request->rss,
            'user->id' => Auth::user->id
        ]);

        event(new Registered($rss));

        return redirect(RouteServiceProvider::HOME);
    }
}
