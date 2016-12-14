<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Bookmark extends Model
{
    protected $table = 'bookmarks';
    protected $primaryKey = 'id';
    protected $fillable = [
        'user_id',
        'target',
        'type',
        'status',
    ];

    public function user()
    {
        return $this->belongsTo('\App\User');
    }
}
