<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    use HasFactory;

    protected $fillable = [
        "interested_user_id",
        'user_id',
        'description',
    ];

    public function user() {
        return $this->belongsTo(User::class, "interested_user_id");
    }
}
