<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ClientReview extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'client_id',
        'review',
        'rating',
        'image'
    ];

    public function client()
    {
        return $this->belongsTo(Client::class);
    }
}
