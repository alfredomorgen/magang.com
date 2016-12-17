<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Job extends Model
{
    use SoftDeletes;
    protected $fillable = [
        'company_id',
        'job_category_id',
        'title',
        'type',
        'salary',
        'period',
        'benefit',
        'requirement'
    ];

    public function company()
    {
        return $this->belongsTo('\App\Company');
    }

    public function transaction(){
        return $this->hasMany('\App\Transaction');
    }
}
