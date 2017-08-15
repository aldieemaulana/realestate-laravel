<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SyaratUmum extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'syarat_umums';

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
    protected $fillable = ["id_house", "status", "form_bank", "foto_copy_ktp_suami_istri", "foto_copy_kartu_keluarga", "foto_copy_kartu_kerja", "foto_copy_buku_nikah_/_surat_cerai",
        "surat_keterangan_belum_memiliki_rumah_dari_kelurahan", "foto_copy_tabungan_btn"];


    public function house() {
        return $this->hasOne("App\House", "id_house", "id");
    }
}
