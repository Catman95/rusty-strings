<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\DB;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'role_id'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function register($name, $email, $password, $verification_code){
        try {
            DB::transaction(function () use ($name, $email, $password, $verification_code) {
                DB::table('verification_codes')
                    ->insert([
                        'email' => $email,
                        'code' => $verification_code
                    ]);
                DB::table('users')
                    ->insert([
                        'name' => $name,
                        'email' => $email,
                        'password' => password_hash($password, PASSWORD_DEFAULT),
                        'role_id' => 2
                    ]);
            });
        } catch (\Exception $exception){
            dd($exception->getMessage());
        }
    }

    public function verify($email, $code) {
        $instance = \DB::table('verification_codes')
            ->where('email', $email)
            ->where('code', $code)
            ->first();
        if($instance){
            \DB::table('users')
                ->where('email', $email)
                ->update([
                   'email_verified_at' => date("Y-m-d H:i:s")
                ]);
        }
    }
}
