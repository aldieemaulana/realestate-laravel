<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AkadKredit extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'akad_kredits';

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
    protected $fillable = ["id_house", "status", "sp3k", "foto_copy_kartu_keluarga", "foto_copy_ktp_suami_istri", "foto_copy_npwp_pribadi", "foto_copy_buku_nikah_/_surat_cerai", "tanggal"];


    public function house() {
        return $this->hasOne("App\House", "id_house", "id");
    }
}
