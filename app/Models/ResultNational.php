<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ResultNational extends Model
{
    use HasFactory;
    protected $table = 'result_national';

    protected $fillable = ['party_id', 'priority'];

    // Relationship with Party
    public function party()
    {
        return $this->belongsTo(Party::class);
    }
}
