<?php namespace Modules\Production\Entities;
   
use Illuminate\Database\Eloquent\Model;

class Order extends Model {

    protected $fillable = [];

    public function buyer()
    {
        return $this->belongsTo('Modules\Production\Entities\Buyer');
    }

    public function style()
    {
        return $this->belongsTo('Modules\Production\Entities\Style');
    }

    public function user()
    {
        return $this->belongsTo('App\User');
    }

}