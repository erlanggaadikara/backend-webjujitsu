<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class Auth extends Controller
{
	public function __construct()
	{

	}

	public function login(Request $request){

		$username = $request->username;
		$password = $request->password;
		$user = DB::table('user')->where('user_name', $username)->get();
		if (!$user->isEmpty()) {
			$message = $password == decrypt($user[0]->user_password)?"Success":"Password Salah";
		}else{
			$message = "Username Salah";
		}
		return response()->json($message);
	}

	public function register(Request $request){
		$username = $request->username;
		$password = $request->password;
		$level = $request->level;
		$user = DB::table('user')->where('user_name', $username)->get();
		if ($user->isEmpty()) {
			$data = array(
				'user_name'		=>	$username,
				'user_password'	=>	$password,
				'user_level'	=>	$level
			);
			$insert = DB::table('user')->insertGetId($data);
			if ($insert) {
				$message = "Success";
			}else{
				$message = "Register gagal";
			}
		}else{
			$message = "Username Sudah Ada";
		}
		return response()->json($message);
	}

	public function check_csrf($kode){
		if ($kode=="honeybadger") {
			return response()->json(csrf_token());
		}else{
			return redirect('/');
		}
	}


}
