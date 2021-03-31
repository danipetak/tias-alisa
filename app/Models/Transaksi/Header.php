<?php

namespace App\Models\Transaksi;

use App\Models\Auth\User;
use App\Models\Setting\Account\Account;
use App\Models\Setting\Period;
use App\Models\Setting\Setup;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\DB;
use Tanggal;

class Header extends Model
{
    use SoftDeletes;
    protected $appends  =   ['nomor_transaksi', 'total_transaksi', 'catatan_kwitansi'];

    public function getCatatanKwitansiAttribute()
    {
        if (Header::tracking_perubahan($this->id)) {
            return Header::tracking_perubahan($this->id);
        } else {
            return $this->deleted_at ? ($this->informasi ? $this->informasi : "TRANSAKSI DIHAPUS TANGGAL ". Tanggal::date($this->deleted_at)) : "TIDAK ADA CATATAN" ;
        }
    }

    public function getNomorTransaksiAttribute()
    {
        return $this->reff . '-' . Setup::zerofill($this->nomor, 7);
    }

    public function getTotalTransaksiAttribute()
    {
        $data   =   Headlist::select(DB::raw("SUM(debit) AS db"), DB::raw("SUM(kredit) AS cr"))
                    ->where('header_id', $this->id)
                    ->whereIn('account_id', Account::select('id')
                        ->whereIn('link_id', [2,3,4])
                    )->first();

        return ($data->db - $data->cr);
    }

    public static function tracking_perubahan($id, $type=FALSE)
    {
        $perubahan  =   Header::where('parent', $id)
                        ->withTrashed()
                        ->first();

        if ($perubahan) {
            if ($type) {
                return $perubahan->nomor_transaksi ;
            } else {
                return "DIKOREKSI KE TRANSAKSI " . $perubahan->nomor_transaksi ;
            }
        }

        $dirubah    =   Header::where('id', $id)
                        ->whereIn('parent', Header::select('id')->withTrashed())
                        ->first();

        if ($dirubah) {
            if ($type) {
                return $dirubah->induk->nomor_transaksi;
            } else {
                return "PERUBAHAN ATAS TRANSAKSI " . $dirubah->induk->nomor_transaksi;
            }
        }

    }

    public static function nomor_transaksi($type, $periode=FALSE)
    {
        $data   =   Header::select('nomor')
                    ->where(function($query) use ($type) {
                        if (($type == 'AJB') OR ($type == 'AJM') OR ($type == 'AJT')) {
                            $query->whereIn('reff', ['AJB','AJM','AJT']);
                        } else {
                            $query->where('reff', $type);
                        }
                    })
                    ->where(function($query) use ($periode) {
                        if ($periode) {
                            $query->where('period_id', $periode);
                        } else {
                            $query->where('period_id', Period::periode_aktif('id'));
                        }
                    })
                    ->orderBy('nomor', 'DESC')
                    ->limit(1)
                    ->withTrashed()
                    ->first();

        return  $data ? ($data->nomor + 1) : 1 ;
    }

    public static function list_trans($reff=FALSE, $periode=FALSE)
    {
        $riwayat    =   Header::where(function($query) use ($reff) {
                            if ($reff) {
                                $query->whereIn('reff', $reff);
                            }
                        })
                        ->where('period_id', $periode ? $periode : Period::periode_aktif('id'))
                        ->orderBy('id', 'DESC')
                        ->get();

        $data   =   '';
        foreach ($riwayat as $row) {
            $data   .=  "<option value='" . $row->id . "'>";
            $data   .=  $row->nomor_transaksi . ' | ' . $row->uraian;
            $data   .=  "</option>";
        }

        return $data;
    }

    public function induk()
    {
        return $this->belongsTo(Header::class, 'parent', 'id')->withTrashed();
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
