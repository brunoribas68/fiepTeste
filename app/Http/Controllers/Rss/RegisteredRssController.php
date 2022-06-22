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

        Rss::create([
            'rss' => $request->rss,
            'user_id' => Auth::id()
        ]);

        return $this->list();
    }

    /**
     * Display the list of rss.
     *
     * @return \Inertia\Response
     */
    public function list(){
        $rss = Rss::all();
        Inertia::share('rss', $rss);

        return Inertia::render('Rss/List', ['rss' => $rss]);
    }

        /**
     * Handle an delete operation.
     *
     * @param  $id from url
     * @return \Illuminate\Http\RedirectResponse
     * 
     */
    public function delete($id){
        Rss::destroy($id);
        return $this->list();
    }

   /**
     * Display the list of rss.
     * @param  $id from url
     * @return \Inertia\Response
     */
    public function edit($id){
        $rss = Rss::find($id);
        return Inertia::render('Rss/Edit', ['rss' => $rss]);
    }
    /**
     * Handle an incoming edited request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function edited($id, Request $request){
        $rss = Rss::find($id);
        $rss->rss = $request->rss;
        $rss->save();
        return $this->list();
    }
}
