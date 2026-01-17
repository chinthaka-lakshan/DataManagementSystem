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
    public function households(): HasMany
    {
        return $this->hasMany(Household::class);
    }
}
