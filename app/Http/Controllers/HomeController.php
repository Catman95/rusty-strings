<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class HomeController extends Controller
{
    protected function randomString($length){
        $characters = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
        $string = '';
        for($i = 0; $i < $length; $i++){
            $string .= substr($characters, rand(0, strlen($characters)), 1);
        }
        return $string;
    }
}
