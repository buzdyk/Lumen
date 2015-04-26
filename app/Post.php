<?php
namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo('Written\Models\User');
    }
}
