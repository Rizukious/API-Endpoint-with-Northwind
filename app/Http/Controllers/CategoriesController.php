<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CategoriesController extends Controller
{
	// Membuat method untuk get all
	function get(Request $request) {
		// membuat paging
		$pageSize = $request->get('pageSize', 10);
		$page = $request->get('page', 1);
		$sort = $request->get('sort', 'CategoryID');
		$asc = $request->get('asc', 'true');
		$builder = DB::table("categories"); 
		$count = $builder->count(); //menghitung total data
		$builder = $builder->orderBy($sort, $asc == "true" ? "asc" : "desc"); //urutkan data dari sort dengan ascending atau descending
		$builder->paginate($pageSize);

		$categories = $builder->get();
		return response()->json([
			'data' => $categories,
			'totalRow' => $count,
			'totalPage' => ceil($count / $pageSize),
			'direction' => $asc == "true" ? 'ASC' : 'DESC'
		]);
	}

	// Membuat method untuk get by id
	function getById(Request $request, $id) {
		$category = DB::table("categories")
		->where("CategoryID", $id);

		// Pengecekan data ada atau tidak
		if($category->exist()) {
			return response()->json($category->first());
		} else {
			return response()->json([
				'success' => false,
				'status' => 404,
				'type' => 'Not Found',
				'detail' => 'Data not Found',
				'timestamp' => time()
			], 404);
		}
	}

	// Membuat method untuk insert
	function insert(Request $request) {
		$data = $request->all();
		$success = DB::table("categories")->insert($data);
		return response()->json([
			'success' => true,
			'message' => 'Insert Data Success',
			'data' => $data
		]);
	}

	// Membuat method untuk update
	function update(Request $request, $id) {
		$data = $request->all();
		$quebild = DB::table("categories");

		// pengecekan ID
		$category = $quebild->where("CategoryID", $id);

		// Pengecekan data ada atau tidak
		if($category->exists()) {
			$category->update($data);
			return response()->json([
				'success' => true,
				'message' => 'Update Data Success',
				'data' => $data
			]);
		} else {
			return response()->json([
				'success' => false,
				'status' => 404,
				'type' => 'Not Found',
				'detail' => 'Data not Found',
				'timestamp' => time()
			], 404);
		}
	}

	// Membuat method untuk delete
	function delete(Request $request, $id) {
		$quebild = DB::table("categories");

		// pengecekan ID
		$category = $quebild->where("CategoryID", $id);

		// Pengecekan data ada atau tidak
		if($category->exists()) {
			$category->delete();
			return response()->json([
				'success' => true,
				'message' => 'Delete Data Success'
			]);
		} else {
			return response()->json([
				'success' => false,
				'status' => 404,
				'type' => 'Not Found',
				'detail' => 'Data not Found',
				'timestamp' => time()
			], 404);
		}
	}
}	