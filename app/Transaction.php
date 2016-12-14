<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    protected $fillable = [
        'jobseeker_id',
        'job_id',
        'status',
    ];

    public function job()
    {
        return $this->belongsTo('\App\Job');
    }

    public function jobseeker()
    {
        return $this->belongsTo('\App\Jobseeker');
    }

}
