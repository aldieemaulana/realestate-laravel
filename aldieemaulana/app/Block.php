<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Block extends Model
{

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'blocks';

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
    protected $fillable = ['id_location', 'name', 'available'];


    public function location() {
        return $this->hasOne("App\Location", "id", "id_location");
    }

    public function houses() {
        return $this->hasMany("App\House", "id_block", "id");
    }

    public function housesAkad() {
        return $this->hasMany("App\House", "id_block", "id")->whereStatus('akad');
    }

    public function housesIsi() {
        return $this->hasMany("App\House", "id_block", "id")->whereStatus('isi');
    }

    public function housesKosong() {
        return $this->hasMany("App\House", "id_block", "id")->whereStatus('kosong');
    }


}
