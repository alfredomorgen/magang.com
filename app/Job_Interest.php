<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Job_Interest extends Model
{
    protected $table = 'job_interests';
    protected $primaryKey = "id";

    protected $fillable = [
        'jobseeker_id',
        'job_category_id',
        'name',
        'status',
    ];

    public function jobseeker()
    {
        return $this->belongsTo('\App\Jobseeker');
    }

    public function job_category()
    {
        return $this->belongsTo('App\Job_Category');
    }
}
