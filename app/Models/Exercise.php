<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Exercise extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'content',
    ];

    public function exercise_counter()
    {
        return $this->hasMany(ExerciseCounter::class);
    }

    public function name(): string
    {
        return $this->name;
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
