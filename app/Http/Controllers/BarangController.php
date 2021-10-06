<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BarangController extends Controller
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
}
