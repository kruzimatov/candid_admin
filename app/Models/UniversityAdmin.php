<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UniversityAdmin extends Model
{
    protected $table = 'universityadmin';
    protected $primaryKey = 'admin_id';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = ['admin_id', 'user_id', 'university_id', 'name', 'email', 'password'];
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
