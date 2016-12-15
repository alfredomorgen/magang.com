<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Notification extends Model
{
    use Notifiable;
    protected $table = 'notifications';
    protected $primaryKey ='id';
    protected $fillable = [
        'user_id',
        'type',
        'notifiable_id',
        'notifiable_type',
        'data',
        'read_at',
        'created_at',
        'updated_at',
    ];

    public function user()
    {
        return $this->belongsTo('\App\User');
    }
    public function getCreatedAtAttribute()
    {
        return date('d/m/Y',strtotime($this->attributes['created_at']));
    }
}
