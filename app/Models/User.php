<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'phone',
        'password',
        'role',
        'is_guest',
        'extra_column',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
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
            'is_guest' => 'boolean',
        ];
    }
    public function hasEmail()
    {
        return !is_null($this->email);
    }

    /**
     * Determine if the user is registered with a phone number.
     *
     * @return bool
     */
    public function hasPhone()
    {
        return !is_null($this->phone);
    }
    public function nationalVotes()
    {
        return $this->hasMany(NationalVote::class);
    }
    public function districtVotes()
    {
        return $this->hasMany(DistrictVote::class);
    }
}
