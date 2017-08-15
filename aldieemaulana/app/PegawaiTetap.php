<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PegawaiTetap extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'pegawai_tetaps';

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
    protected $fillable = ["id_house", "status", "surat_keterangan_kerja", "surat_pengakatan_karyawan_tetap", "slip_gaji_terbaru", "kartu_pegawai",
        "gaji_cash", "rekening_koran_3_bulan_terakhir", "foto_copy_npwp_pribadi", "spt_/_sk_spt"];


    public function house() {
        return $this->hasOne("App\House", "id_house", "id");
    }
}
