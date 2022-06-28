<?php

namespace App\Models;

use App\Http\Requests\MessagesTrait;
use Carbon\Carbon;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable implements MustVerifyEmail
{
    use HasApiTokens, HasFactory, Notifiable;
    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'type_id',
        'active',
        'code',
        'email_verified_at',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public static function store($data)
    {
        return self::create($data);
    }

    public static function updateById(int $id, $data)
    {
        self::where('id', $id)->update($data);
    }

    public function products()
    {
        return $this->hasMany(UserProducts::class);
    }

    public function userCheck($credentials)
    {

    }

    public function storeUser(array $data)
    {
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'type_id' => 5,
            'code' => rand(1, 1000000)
        ]);
    }

    public function userVerify()
    {
        dd($this);
        $this->update([
            'code' => null,
            'email_verified_at' => Carbon::now(),
        ]);
    }

    public function shops()
    {
        return $this->hasMany(ShopOperator::class);
    }

    public function operator(): BelongsTo
    {
        return $this->belongsTo(ShopOperator::class,'id','user_id');

    }

    public function changeUserPassword($userId, $password)
    {
        dd($this);
    }
}
