<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'bookings';

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
    protected $fillable = ["id_house","nama","status","telepon","tanggal_wawancara","booking_fee","tanggal_booking_fee","dp_1","tanggal_dp_1","dp_2","tanggal_dp_2","dp_3","tanggal_dp_3","dp_4","tanggal_dp_4","dp_5","tanggal_dp_5","kpr_diajukan","kpr_disetujui","kpr_selisih","tanggal_bayar","bayar","metode_bayar","tanggal_akad","tanggal_cair"];


    public function houses() {
        return $this->hasMany("App\House", "id_block", "id");
    }


}
