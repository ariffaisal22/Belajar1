<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\tbl_katalog;


class Barang extends Controller
{
    Public function getData(){
        $data = DB::table('tbl_katalog')->get();
        if(count($data)> 0){
            $res['message'] = "success";
            $res['value'] = $data;
            return response($res);
        }else{
            $res['message'] = "empty!";
            return response($res);
        }
    }

    Public  function store(Request $request){
        
        //ini untuk validasi
        $validated = $request->validate(['file' => 'required|max:2084']);

        //menyimpan data yang di upload ke variable file
       $file = $request->file('file');
        //ini untuk mengganti nama file yang di upload
        $nama_file = $file->getClientOriginalName(); 
        //ini untuk tempat file yang upload
        $tujuan_upload = 'data_file';
        if($file->move($tujuan_upload,$nama_file)){
            $data = tbl_katalog::create([
                'nama_produk'   => $request->nama_produk,
                'berat'         => $request->berat,
                'harga'         => $request->harga,
                'gambar'        => $nama_file,
                'keterangan'    => $request->keterangan
            ]);
            $res['message'] = 'success';
            $res['values'] = $data;
            return response($res);
        }
    }

    Public function update(Request $request){
        if(!empaty($request->file)){
           // $this->validate($request, ['file' => 'required|max:2048']);

            $validated = $request->validate(['file' => 'required|max:2084']);
            $file = $request->file('file');
            $nama_file = $file->getClientOriginalName(); 
            //ini untuk tempat file yang upload
            $tujuan_upload = 'data_file';

            $file->move($tujuan_upload,$nama_file);
            $data = DB::table('tbl_katalog')->where('id',$request->id)->get();

            //perulangan untuk menghapus file tujuan yang lama
            foreach ($data as $katalog){
                @unlink(public_path('data_file/' . $katalog->gambar)); //untuk menghapus file tujuan yang lama
                $ket = DB::table('tbl_katalog')->where('id',$request->id)->update([
                        'nama_produk'   => $request->nama_produk,
                        'berat'         => $request->berat,
                        'harga'         => $request->harga,
                        'gambar'        => $nama_file,
                        'keterangan'    => $keterangan->keterangan
                    ]);

                $res['message'] = 'success';
                $res['values'] = $ket;
                return response($res);

            }
                
          
        }else{

            $data = DB::table('tbl_katalog')->where('id',$request->id)->get();

            //perulangan 
            foreach ($data as $katalog){
               
                $ket = DB::table('tbl_katalog')->where('id',$request->id)->update([
                        'nama_produk'   => $request->nama_produk,
                        'berat'         => $request->berat,
                        'harga'         => $request->harga,
                        'keterangan'    => $keterangan->keterangan
                    ]);

                $res['message'] = 'success';
                $res['values'] = '$ket';
                return response($res);

            }

        }
    }

    public function hapus($id){
        $data = DB::table('tbl_katalog')->where('id',$id)->get();
        foreach ($data as $katalog){
           if(file_exists(public_path('data_file/' . $katalog->gambar)))  {
            @unlink(public_path('data_file/' . $katalog->gambar));
            DB::table('tbl_katalog')->where('id',$id)->delete();

            $res['message'] = 'success';
            return response($res);
           }  
        
        }

    }

    public function getDetail($id){
        $data = DB::table('tbl_katalog')->where('id',$id)->get();
        if(count($data)> 0){
            $res['message'] = "success";
            $res['value'] = $data;
            return response($res);
        }else{
            $res['message'] = "empty!";
            return response($res);
        }
    }
}
