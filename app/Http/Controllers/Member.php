<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class Member extends Controller
{
    public function __construct()
	{

	}

	public function login(Request $request){

		$npm = $request->npm;
		$password = $request->password;
		$member = DB::table('member')->where('member_npm', $npm)->get();
		if (!$member->isEmpty()) {
			$message = $password == decrypt($member[0]->member_password)?"Success":"Password Salah";
		}else{
			$message = "Username Salah";
		}
		return response()->json($message);
	}

	public function register(Request $request){
		$npm = $request->npm;
		$password = $request->password;
		$member = DB::table('member')->where('member_npm', $npm)->get();
		if ($member->isEmpty()) {
			$data = array(
				'jurusan_id'		=>	$request->jurusan_id,
				'member_nama'	=>	$request->nama,
				'member_npm'	=>	$request->npm,
				'member_password'	=>	$request->password,
				'member_foto'	=>	$request->foto,
				'member_alamat'	=>	$request->alamat,
				'member_tempatlahir'	=>	$request->tempatlahir,
				'member_tanggallahir'	=>	$request->tanggallahir,
				'member_nohp'	=>	$request->nohp,
				'member_otw_nama'	=>	$request->otw_nama,
				'member_otw_nohp'	=>	$request->otw_nohp,
				'member_status_alumni'	=>	$request->status_alumni,
				'member_status_pelatih'	=>	$request->status_pelatih
			);
			$insert = DB::table('member')->insertGetId($data);
			if ($insert) {
				$message = "Success";
			}else{
				$message = "Register gagal";
			}
		}else{
			$message = "NPM Sudah Ada";
		}
		return response()->json($message);
	}
}
