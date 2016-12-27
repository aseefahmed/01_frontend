<?php namespace Modules\Production\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\belongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Buyer extends Model {

    use SoftDeletes;

    protected $dates = ['deleted_at'];
    protected $fillable = [];

    public function user()
    {
        return $this->belongsTo('App\User');
    }

}