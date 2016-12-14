<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Report extends Model
{
    protected $table = 'reports';
    protected $primaryKey = "id";

    protected $fillable = [
        'jobseeker_id',
        'job_id',
        'type',
        'description',
        'status',
    ];

    public function jobseeker()
    {
        return $this->belongsTo('\App\Jobseeker');
    }

    public function job()
    {
        return $this->belongsTo('App\Job');
    }
}
