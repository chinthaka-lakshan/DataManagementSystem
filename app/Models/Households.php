<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Households extends Model
{
    protected $table = 'households';

    protected $fillable = [
        'division_id',
        'house_number',
        'address',
        'head_of_household',
    ];

    public function division()
    {
        return $this->belongsTo(Divisions::class);
    }

    public function citizens(): HasMany
    {
        return $this->hasMany(Citizens::class);
    }
}
