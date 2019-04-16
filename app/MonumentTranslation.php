<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MonumentTranslation extends Model
{
    protected $fillable = [
        'monument_id',
        'language_id',
        'name',
        'city',
        'country',
        'content'
    ];

    public function monument() {
        return $this->belongsTo('App\Monument');
    }

    public function language() {
        return $this->belongsTo('App\Language');
    }
}
