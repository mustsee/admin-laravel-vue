<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Language extends Model
{
    protected $fillable = ['code'];

    public function monumentsInLangugage() {
        return $this->hasMany('App\MonumentTranslation');
    }
}
