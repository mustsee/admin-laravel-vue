<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Monument extends Model
{
    protected $fillable = [
        'default_name', 'longitude', 'latitude'
    ];

    public function monumentTranslations() {
        return $this->hasMany('App\MonumentTranslation');
    }
}
