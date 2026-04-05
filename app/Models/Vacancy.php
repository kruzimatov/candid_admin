<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Vacancy extends Model
{
    protected $table = 'vacancies';
    protected $primaryKey = 'id';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'id', 'employer_id', 'description', 'company', 'location',
        'mode', 'type', 'salary', 'is_expired', 'start_date', 'end_date',
    ];

    protected function casts(): array
    {
        return [
            'start_date' => 'date',
            'end_date'   => 'date',
        ];
    }

    // vacancies.employer_id references users.user_id
    public function user()
    {
        return $this->belongsTo(User::class, 'employer_id', 'user_id');
    }
}
