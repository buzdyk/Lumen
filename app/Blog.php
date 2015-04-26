<?php
namespace App;

use Illuminate\Database\Eloquent\Model;

class Blog extends Model
{

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function user()
    {
        return $this->belongsTo('Written\Models\User');
    }
}
