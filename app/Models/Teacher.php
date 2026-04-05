<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Teacher extends Model
{
    protected $table = 'teachers';
    protected $primaryKey = 'teacher_id';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'teacher_id', 'user_id', 'university_id', 'is_verified',
        'specialty', 'email', 'password', 'name',
    ];
    protected $hidden = ['password'];

    public function university()
    {
        return $this->belongsTo(University::class, 'university_id', 'id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'user_id');
    }
}
