<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FollowUpBank extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'follow_up_banks';

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
    protected $fillable = ["id_house", "status", "form_lampiran_ixb", "form_lampiran_xia", "form_lampiran_xib", "form_data_alamat_debitur", "form_sbum", "form_keterangan_penjual", "tanggal"];


    public function house() {
        return $this->hasOne("App\House", "id_house", "id");
    }
}
