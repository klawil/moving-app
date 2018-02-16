<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    /**
     * Returns the box the item is in
     * @return App\Box
     */
    public function box()
    {
        return $this
            ->belongsTo('App\Box');
    }
}
