<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Package extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'price', 'details', 'service_id', 'tag'];

    public function service()
    {
        return $this->belongsTo(Service::class);
    }
}
