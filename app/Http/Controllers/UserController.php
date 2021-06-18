<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserUpdateRequest;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Requests\RegisterRequest;
use Illuminate\Support\Facades\Mail;
use App\Mail\WelcomeMail;
use App\Http\Requests\LoginRequest;

class UserController extends HomeController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(RegisterRequest $request)
    {
        $name = $request->input('name');
        $email = $request->input('email');
        $password = $request->input('password');
        $verification_code = self::randomString(10);

        $user = new User();

        try {
            $user->register($name, $email, $password, $verification_code);
            $url = 'http://localhost:8000/user/email_verify/' . $email . '/' . $verification_code;
            Mail::to($email)->send(new WelcomeMail(['url' => $url]));
            return view('pages.sign-up-success');
        } catch (\Exception $exception) {
            dd($exception->getMessage());
        }
    }

    public function email_verify($email, $code){
        $user = new User();
        $user->verify($email, $code);
        return view('pages.login');
    }

    public function login(LoginRequest $request){
        $email = $request->input('email');
        $password = $request->input('password');

        $user = User::where('email', $email)->first();
        if($user){
            if(password_verify($password, $user->password)){
                if($user->email_verified_at != null) {
                    session()->put('user', $user);
                    if(session()->has('url.intended')){
                        return redirect()->route(session()->get('url.intended'));
                    }
                    return redirect()->route('home');
                }else {
                    $error = 'E-mail not verified';
                }
            }else {
                $error = 'Wrong password';
            }
        }else {
            $error = 'User not found';
        }
        return back()->with('error', $error);
    }

    public function logout() {
        session()->flush();
        return redirect()->route('home');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UserUpdateRequest $request, $id)
    {
        $name = $request->input('name');
        $email = $request->input('email');
        $new_password = $request->input('password');
        $current_password = $request->input('current_password');

        $user = User::find($id);

        if(password_verify($current_password, $user->password)){
            $user->name = $name;
            $user->email = $email;
            if(isset($new_password)){
                $user->password = password_hash($new_password, PASSWORD_DEFAULT);
            }
            $user->save();
            session()->flush();
            session()->put('user', $user);
            return redirect()->route('account')->withSuccess('Update successful');
        }else {
            dd("wrong password");
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
