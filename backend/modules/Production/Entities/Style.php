<?php namespace Modules\Production\Entities;
   
use Illuminate\Database\Eloquent\Model;

class Style extends Model {

    protected $fillable = [];

    public function user()
    {
        return $this->belongsTo('App\User');
    }
}