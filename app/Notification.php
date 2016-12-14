<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    use SoftDeletes;
    protected $table = 'notifications';
    protected $primaryKey ='id';
    protected $fillable = [
        'user_id',
        'type',
        'description',
        'status',
    ];

    public function user()
    {
        return $this->belongsTo('\App\User');
    }
}
