<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Job_Category extends Model
{
    protected $table = 'job_categories';
    protected $primaryKey = "id";

    protected $fillable = [
        'name',
        'status',
    ];

    public function job()
    {
        return $this->hasMany('\App\Job');
    }

    public function job_interest()
    {
        return $this->hasMany('\App\Job_Interest');
    }
}
