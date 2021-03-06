<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Box extends Model
{
    /**
     * The attributes that are not mass assignable
     * @var Array
     */
    protected $guarded = ['id'];

    /**
     * Returns the room the box is assigned to
     * @return App\Room
     */
    public function room()
    {
        return $this
            ->belongsTo('App\Room');
    }

    /**
     * The items in the box
     * @return App\Item
     */
    public function items()
    {
        return $this
            ->hasMany('App\Item');
    }
}
