<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Report extends Model
{
    use HasFactory;

    protected $fillable = [
        'post_id',
        'reporter_id',
        'reason',
        'status',
    ];

    // KEEP this one because User.php exists by default in Laravel
    public function reporter()
    {
        return $this->belongsTo(User::class, 'reporter_id');
    }

    // THE POST FUNCTION HAS BEEN REMOVED TO PREVENT THE ERROR
}