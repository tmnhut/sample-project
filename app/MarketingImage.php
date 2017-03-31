<?php

namespace App;

use App\Traits\ShowsImages;
use Illuminate\Database\Eloquent\Model;

class MarketingImage extends SuperModel
{
    use ShowsImages;

    protected $fillable = ['is_active',
        'is_featured',
        'image_name',
        'image_extension',
        'image_weight'
    ];
}
