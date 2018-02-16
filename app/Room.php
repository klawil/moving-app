<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Room extends Model
{
    /**
     * The attributes that are not mass assignable
     * @var Array
     */
    protected $guarded = ['id'];

    /**
     * The boxes assigned to the room
     * @return App\Box
     */
    public function boxes()
    {
        return $this
            ->hasMany('App\Box');
    }
}
