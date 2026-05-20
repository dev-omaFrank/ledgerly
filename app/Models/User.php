<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Str;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'signup_method',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function businesses()
    {
        return $this->hasMany(BusinessModel::class);
    }

    public function getNameInitials(): string
    {
        $name = $this->name;
        $name_array = explode(' ',trim($name));

        $firstWord = $name_array[0];
        $lastWord = $name_array[count($name_array)-1];

        return mb_substr($firstWord[0],0,1)."".mb_substr($lastWord[0],0,1);
    }

    public function subscriptions()
    {
        return $this->hasMany(Subscription::class);
    }

    public function clients(){
        return $this->hasMany(ClientModel::class, 'user_id');
    }

}
