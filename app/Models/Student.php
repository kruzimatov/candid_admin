<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    protected $table = 'student';
    protected $primaryKey = 'student_id';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'student_id', 'user_id', 'university_id', 'admin_id',
        'first_name', 'last_name', 'email', 'password',
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
