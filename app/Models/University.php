<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class University extends Model
{
    protected $table = 'universities';
    protected $primaryKey = 'id';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = ['id', 'name', 'admin_id', 'location', 'is_active'];

    public function students()
    {
        return $this->hasMany(Student::class, 'university_id', 'id');
    }

    public function teachers()
    {
        return $this->hasMany(Teacher::class, 'university_id', 'id');
    }
}
