<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $data=[
            'nama'=>'doraemon',
            'pekerjaan'=>'develper'
        ];
        return view('home')->with($data);
    }
    //or you can use this 
    //$nama ="doraemon";
    //$pekerjaan="student";
    //retrun view ('home',compact('nama','kerjaan'));
    public function contact()
    {
        return view ('contact');
    }
}

