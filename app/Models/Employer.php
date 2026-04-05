<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Employer extends Model
{
    protected $table = 'employers';
    protected $primaryKey = 'id';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = ['id', 'name', 'email', 'company', 'password'];
    protected $hidden = ['password'];

    public function vacancies()
    {
        return $this->hasMany(Vacancy::class, 'employer_id', 'id');
    }
}
