<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\View;

class NewsController extends Controller
{

    public function create()
    {
        $attributes = [];

        //dd( $attributes);
        return view('laravel-examples/news');
    }

    public function store()
    {

        // $attributes = request()->validate([
        //     'name' => ['required', 'max:50'],
        //     'email' => ['required', 'email', 'max:50', Rule::unique('users')->ignore(Auth::user()->id)],
        //     'phone'     => ['min:10']
        // ]);
        
        dd($attributes);
        User::where('id',Auth::user()->id)
        ->update([
            'name'    => $attributes['name'],
            'email' => $attributes['email'],
            'phone'     => $attributes['phone'],
            'location' => isset($attributes['location'])?$attributes['location']:'',
            'about_me'    => isset($attributes["about_me"])?$attributes["about_me"]:'',
        ]);


        return redirect('/news')->with('success','Profile updated successfully');
    }
}
