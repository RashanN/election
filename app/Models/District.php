<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class District extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'image', 'extra'];
    public function districtVotes()
    {
        return $this->hasMany(DistrictVote::class);
    }
    public function results()
    {
        return $this->hasMany(Result::class);
    }
}
