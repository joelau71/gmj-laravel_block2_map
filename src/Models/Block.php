<?php

namespace GMJ\LaravelBlock2Map\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Block extends Model implements HasMedia
{
    use InteractsWithMedia;
    use HasTranslations;

    protected $guarded = [];
    protected $table = "laravel_block2_maps";
    public $translatable = ['text', 'address'];
}
