<?php
namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Locale;

class Review extends Model {

	public function product()
    {
        return $this->belongsTo('App\Product');
    }

    public function member()
    {
        return $this->belongsTo('App\Member');
    }

    public function details()
    {
        return $this->hasMany('App\_Review');
    }

    public function translated($locale = null)
    {
        return $this->details()->where('locale_id' , Locale::where('name',$locale ?: app()->getLocale())->first()->id)->first();
    }

}
