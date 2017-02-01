<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Info extends Model
{

    public function getTableColumns() {
        return $this->getConnection()->getSchemaBuilder()->getColumnListing($this->getTable());
    }

    public function getUrl()
    {
        return route('site.infos.index',['slug'=> $this->slug]);
    }

    public function isActive()
    {

        return (bool) $this->active;

    }

}
