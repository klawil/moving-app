<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    /**
     * The attributes that are not mass assignable
     * @var Array
     */
    protected $guarded = ['id'];

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
