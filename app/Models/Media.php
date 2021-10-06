<?php

namespace App\Models;

use Spatie\MediaLibrary\MediaCollections\Models\Media as BaseMedia;

class Media extends BaseMedia
{
    protected $appends = [
        'url',
        'full_url'
    ];

    public function getUrlAttribute()
    {
        return $this->getUrl();
    }

    public function getFullUrlAttribute()
    {
        return $this->getFullUrl();
    }
}