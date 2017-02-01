<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\TranslationLocale;

class Setting extends Model
{
    public function getLocale()
    {
        $first_locale = TranslationLocale::find($this->first_locale)->name;
        $second_locale = TranslationLocale::find($this->second_locale)->name;
        $current_locale = session('locale');

        switch ($current_locale) {
            case $first_locale:
                return $second_locale;
            case $second_locale:
                return $first_locale;
            default:
            return $first_locale;
        }
    }

    public function getLogo()
    {
        return url("storage/uploads/images/logo/$this->site_logo");
    }
}
