<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Divisions extends Model
{
    protected $table = 'divisions';

    protected $fillable = [
        'division_code',
        'division_name',
        'divisional_secretariat',
    ];
    public function households()
    {
        return $this->hasMany(Households::class, 'division_id');
    }
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
