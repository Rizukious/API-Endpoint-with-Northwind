<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;

class UserController extends Controller
{
	// Method membuat fungsi getAll data user
	public function getAll(Request $request) {
		$data = [
			['id'=> 1, 'nama'=>'Agus'],
			['id'=> 2, 'nama'=>'TEs'],
			['id'=> 3, 'nama'=>'Sendi'],
		];
		return response()->json($data);
	}

	// Method membuat fungsi getById data user
	public function getById(Request $request, $id) {
		return response()->json(['id' => $id, 'nama'=>'Rizki']);
	}

	// Method membuat fungsi insert data user
	public function insert(Request $req) {
		$data = $req->all();
		$data['nama'] = 'Juki';
		return response()->json($data);
	}

	// Method membuat fungsi update data user
	public function update(Request $req) {
		$data = $req->all();
		$data['nama'] = 'Usman';
		return response()->json([
			'status' => true,
			'message' => "Berhasil update data",
			'data' => $data
		]);
	}

	// Method membuat fungsi delete data user
	public function delete(Request $req) {
		$data = $req->all();
		$data['nama'] = 'Thoriq';
		return response()->json([
			'status' => true,
			'message' => "Berhasil delete data",
			'data' => $data
		]);
	}
}