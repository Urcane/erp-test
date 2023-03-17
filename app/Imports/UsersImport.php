<?php

namespace App\Imports;

use App\Models\Data_User;
use App\Models\Pemilik;
use App\Models\Produk;
use App\Models\ProdukFoto;
use App\Models\RefJenisUsaha;
use App\Models\RefKategoriProduk;
use App\Models\RefKecamatan;
use App\Models\RefKelurahan;
use App\Models\RefPendidikan;
use App\Models\Umkm;
use App\Models\UmkmDetail;
use App\Models\UmkmJenisUsaha;
use App\Models\UmkmStatus;
use Carbon\Carbon;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithStartRow;

class UsersImport implements ToCollection, WithStartRow

{   
    public function startRow(): int
    {
        return 3;
    }

    public function collection(Collection $rows)
    {   
        
        foreach ($rows as $row) 
        {
            $get_exist_data = Pemilik::where('nik',$row[4])->first();

            // // import data keseluruhan
            // // if($get_exist_data){
            // // }else{
            // //     if($row[9]=='p' || $row[9]=='P'){
            // //         $jk = 'perempuan';
            // //     }else{
            // //         $jk = 'laki-laki';
            // //     }
            // //     $pend = RefPendidikan::where('nama',$row[11])->first();
    
            // //     $kel_pem = RefKelurahan::where('nama',$row[2])->first();
            // //     $kec_pem = RefKecamatan::where('nama',$row[3])->first();
    
            // //     $input = $kec_pem->kode_wilayah;
            // //     $kel_umkm = RefKelurahan::where('nama',$row[43])->first();
            // //     $kec_umkm = RefKecamatan::where('nama',$row[44])->first();
    
            // //     $get_jenis = RefJenisUsaha::where('nama',$row[45])->first();
    
            // //     //akta
            // //     if($row[39] != null){
            // //         $akta = '1';
            // //         $akta_no = $row[40];
            // //         $akta_tgl = $row[41];
            // //         // $akta_tgl = Carbon::parse($row[41]);
            // //     }else{
            // //         $akta = '0';
            // //         $akta_no = null;
            // //         $akta_tgl = null;
            // //     }
            // //     //skdu
            // //     if($row[27] != null){
            // //         $skdu = '1';
            // //         $skdu_no = $row[28];
            // //         $skdu_tgl = $row[29];
            // //         // $skdu_tgl = Carbon::parse($row[29]);
            // //     }else{
            // //         $skdu = '0';
            // //         $skdu_no = null;
            // //         $skdu_tgl = null;
            // //     }
            // //     //npwp
            // //     if($row[18] != null){
            // //         $npwp = '1';
            // //         $npwp_no = $row[19];
            // //         $npwp_tgl = $row[20];
            // //         // $npwp_tgl = Carbon::parse($row[20]);
            // //     }else{
            // //         $npwp = '0';
            // //         $npwp_no = null;
            // //         $npwp_tgl = null;
            // //     }
            // //     //merk
            // //     if($row[30] != null){
            // //         $merk = '1';
            // //         $merk_no = $row[31];
            // //         $merk_tgl = $row[32];
            // //         // $merk_tgl = Carbon::parse($row[32]);
            // //     }else{
            // //         $merk = '0';
            // //         $merk_no = null;
            // //         $merk_tgl = null;
            // //     }
            // //     //hki
            // //     if($row[36] != null){
            // //         $hki = '1';
            // //         $hki_no = $row[37];
            // //         $hki_tgl = $row[38];
            // //         // $hki_tgl = Carbon::parse($row[38]);
            // //     }else{
            // //         $hki = '0';
            // //         $hki_no = null;
            // //         $hki_tgl = null;
            // //     }
            // //     //halal
            // //     if($row[33] != null){
            // //         $halal = '1';
            // //         $halal_no = $row[34];
            // //         $halal_tgl = $row[35];
            // //         // $halal_tgl = Carbon::parse($row[35]);
            // //     }else{
            // //         $halal = '0';
            // //         $halal_no = null;
            // //         $halal_tgl = null;
            // //     }
            // //     //pirt
            // //     if($row[21] != null){
            // //         $pirt = '1';
            // //         $pirt_no = $row[22];
            // //         $pirt_tgl = $row[23];
            // //         // $pirt_tgl = Carbon::parse($row[23]);
            // //     }else{
            // //         $pirt = '0';
            // //         $pirt_no = null;
            // //         $pirt_tgl = null;
            // //     }
                
            // //     if($get_jenis){
            // //         $jenis = $get_jenis->id;
            // //     }else{
            // //         $new_jenis = RefJenisUsaha::create([
            // //             'nama'=> $row[45],
            // //             'aktif'=>'1',
            // //             'dibuat_oleh'=>22200,
            // //         ]);
            // //         $jenis = $new_jenis->id;
            // //     }
                
            // //     if($row[47] != null){
            // //         $merk_produk = $row[47];
            // //     }else{
            // //         $merk_produk = $row[13];
            // //     }
    
            // //     $data_user = Data_User::create([
            // //         'id_otoritas' => 3,
            // //         'username' => $row[4],
            // //         'password'=>'1b148a953e6411cfc3438d5600627b116eea25d2',
            // //         'nama'=>$row[0],
            // //         'alamat'=>$row[1],
            // //         'email'=>$row[4].'@umkm.balikpapan.go.id',
            // //         'no_hp'=>$row[12],
            // //         'created_id'=>22200,
            // //     ]);
    
            // //     $data_pemilik = Pemilik::create([
            // //         'id_user'=>$data_user->id,
            // //         'kk'=>$row[5],
            // //         'nik'=>$row[4],
            // //         'nama'=>$row[0],
            // //         'jenis_kelamin'=>$jk,
            // //         'status_pernikahan'=>$row[10],
            // //         'tempat_lahir'=>$row[7],
            // //         'tanggal_lahir'=>$row[8],
            // //         'id_pendidikan'=> $pend->id_pendidikan,
            // //         'id_kecamatan'=> $input,
            // //         'id_kelurahan'=> $kel_pem->kode_wilayah,
            // //         'alamat_lengkap'=>$row[1],
            // //         'npwp'=>$npwp_no,
            // //         'telepon'=>$row[12],
            // //         'email'=>$row[4].'@umkm.balikpapan.go.id',
            // //         'aktif'=>'1',
            // //         'dibuat_oleh'=>22200,
            // //     ]);
    
            // //     $umkm = Umkm::create([
            // //         'id_user'=> $data_user->id,
            // //         'id_pemilik'=>$data_pemilik->id,
            // //         'id_jenis_usaha'=>$jenis,
            // //         'id_destinasi'=>$row[67],
            // //         'nama'=>$row[13],
            // //         'legalitas_akta'=>$akta,
            // //         'legalitas_nomor_akta'=>$akta_no,
            // //         'legalitas_tanggal_akta'=>$akta_tgl,
            // //         'legalitas_skdu'=>$skdu,
            // //         'legalitas_nomor_skdu'=>$skdu_no,
            // //         'legalitas_tanggal_skdu'=>$skdu_tgl,
            // //         'legalitas_npwp'=>$npwp,
            // //         'legalitas_nomor_npwp'=>$npwp_no,
            // //         'legalitas_tanggal_npwp'=>$npwp_tgl,
            // //         'legalitas_sertifikat_merk'=>$merk,
            // //         'legalitas_nomor_sertifikat_merk'=>$merk_no,
            // //         'legalitas_tanggal_sertifikat_merk'=>$merk_tgl,
            // //         'legalitas_sertifikat_hki'=>$hki,
            // //         'legalitas_nomor_sertifikat_hki'=>$hki_no,
            // //         'legalitas_tanggal_sertifikat_hki'=>$hki_tgl,
            // //         'legalitas_sertifikat_halal'=>$halal,
            // //         'legalitas_nomor_sertifikat_halal'=>$halal_no,
            // //         'legalitas_tanggal_sertifikat_halal'=>$halal_tgl,
            // //         'legalitas_sertifikat_pirt'=>$pirt,
            // //         'legalitas_nomor_sertifikat_pirt'=>$pirt_no,
            // //         'legalitas_tanggal_sertifikat_pirt'=>$pirt_tgl,
            // //         'mulai_usaha'=>$row[14],
            // //         'deskripsi'=>$row[45],
            // //         'merk_produk'=>$merk_produk,
            // //         'nomor_nib'=>$row[15],
            // //         'nomor_kbli'=>$row[16],
            // //         'tempat_pemasaran'=>'offline',
            // //         'pemasaran_offline'=>$row[49],
            // //         'link_pemasaran'=>$row[48],
            // //         'sumber_permodalan'=>$row[57],
            // //         'hasil_produksi'=>$row[46],
            // //         'merk_produk'=>$row[47],
            // //         'pelatihan'=>$row[58],
            // //         'fasilitas'=>$row[59],
            // //         'alamat'=>$row[42],
            // //         'id_kecamatan'=>$kec_umkm->kode_wilayah,
            // //         'id_kelurahan'=>$kel_umkm->kode_wilayah,
            // //         'latitude'=>$row[61],
            // //         'longitude'=>$row[62],
            // //         'status'=>'aktif',
            // //         'aktif'=>'1',
            // //         'dibuat_oleh'=>22200
            // //     ]);
    
            // //     $umkm_detail = UmkmDetail::create([
            // //         'id_umkm'=>$umkm->id,
            // //         'jml_tk'=>$row[50],
            // //         'jml_tk_laki_laki'=>$row[51],
            // //         'jml_tk_perempuan'=>$row[52],
            // //         'aset'=>$row[56],
            // //         'omset'=>$row[54],
            // //         'tahun'=>2022,
            // //         'aktif'=>'1',
            // //         'dibuat_oleh'=>22200,
            // //     ]);
    
            // //     $umkm_jenis_usaha = UmkmJenisUsaha::create([
            // //             'id_umkm'=>$umkm->id,
            // //             'id_ref'=>$jenis,
            // //             'aktif'=>'1',
            // //             'dibuat_oleh'=>22200,
            // //     ]);
                
            // //     $umkm_status = UmkmStatus::create([
            // //         'id_umkm'=>$umkm->id,
            // //         'aktif'=>'1',
            // //         'dibuat_oleh'=>22200,
            // //         'status'=>2,
            // //     ]);
    
            // //     // $get_kategori = RefKategoriProduk::where('nama',$row[68])->first();
                
            // //     // if($get_kategori){
            // //     //     $kategori = $get_kategori->id;
            // //     // }else{
            // //     //     $new_kategori = RefKategoriProduk::create([
            // //     //         'nama'=> $row[68],
            // //     //         'aktif'=>'1',
            // //     //         'dibuat_oleh'=>22200,
            // //     //     ]);
            // //     //     $kategori = $new_kategori->id;
            // //     // }
    
            // //     // $produk = Produk::create([
            // //     //     'id_umkm' => $umkm->id,
            // //     //     'id_kategori'=> $kategori,
            // //     //     'nama'=>$row[65],
            // //     //     'harga'=>$row[69],
            // //     //     'deskripsi'=>$row[65],
            // //     //     'stok'=>100,
            // //     //     'status'=>'1',
            // //     //     'aktif'=>'1',
            // //     //     'dibuat_oleh'=>22200,
            // //     // ]);
    
            // //     // $produk_foto = ProdukFoto::create([
            // //     //     'id_produk'=>$produk->id,
            // //     //     'image'=>$row[4].'.jpg',
            // //     //     'nama'=>$row[65],
            // //     //     'aktif'=>'1',
            // //     //     'dibuat_oleh'=>22200,
            // //     // ]);
            // // }

            // // ganti yang diganti nik,kk, telpon , tgllahir
            // if($get_exist_data){
            //     if($row[9]=='p' || $row[9]=='P'){
            //                 $jk = 'perempuan';
            //             }else{
            //                 $jk = 'laki-laki';
            //             }
            //     $update_pemilik = $get_exist_data->update([
            //         'jenis_kelamin'=>$jk,
            //         'nik'=>$row[72],
            //         'kk'=>$row[73],
            //         'telepon'=>$row[74],
            //         'tempat_lahir'=>$row[7],
            //         'tanggal_lahir'=>Carbon::parse($row[8]),
            //         // 'email'=>$row[72].'@umkm.balikpapan.go.id',
            //     ]);
            //     $get_user = Data_User::where('id',$get_exist_data->id_user)->update([
            //         'username'=>$row[72],
            //         // 'email'=>$row[72].'@umkm.balikpapan.go.id',
            //         'no_hp'=>$row[74],
            //     ]);
            // }else{
            // }
        }

        // // ganti detail umkm 2023
        // $update_tahun = UmkmDetail::where('tahun',2022)->update([
        //     'tahun'=>2023,
        // ]);

        // ganti password jadi sobatumkm123
        $update_password = Data_User::where('id_otoritas',3)->update([
            'password'=> sha1('sobatumkm123'),
        ]);
    }
}
 