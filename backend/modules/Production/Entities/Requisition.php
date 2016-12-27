<?php namespace Modules\Production\Entities;
   
use Illuminate\Database\Eloquent\Model;

class Requisition extends Model {

    protected $fillable = [];

    public function user()
    {
        return $this->belongsTo('App\User');
    }

}