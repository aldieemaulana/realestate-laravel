<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class House extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'houses';

    /**
     * The database primary key value.
     *
     * @var string
     */
    protected $primaryKey = 'id';

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['id_block', 'number', 'status', 'indicator_satu', 'indicator_dua', 'indicator_tiga'];


    public function block() {
        return $this->hasOne("App\Block", "id", "id_block");
    }
}
