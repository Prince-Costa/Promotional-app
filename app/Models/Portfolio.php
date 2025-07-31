<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Portfolio extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'body',
        'service_id',
        'client_id',
        'portfolio_tag_id',
        'image',
    ];


    public function service()
    {
        return $this->belongsTo(Service::class);
    }

    public function client()
    {
        return $this->belongsTo(Client::class);
    }

    public function portfolioTag()
    {
        return $this->belongsTo(PortfolioTag::class);
    }

}
