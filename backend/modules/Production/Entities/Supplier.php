<?php namespace Modules\Production\Entities;
   
use Illuminate\Database\Eloquent\Model;

class Supplier extends Model {

    protected $fillable = [];

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function supplier_type()
    {
        return $this->belongsTo('Modules\Production\Entities\SupplierType');
    }
}