<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProductsController extends Controller
{
	// Membuat method untuk get all
	function get(Request $request) {
		// membuat paging
		$pageSize = $request->get('pageSize', 10);
		$page = $request->get('page', 1);
		$sort = $request->get('sort', 'ProductID');
		$asc = $request->get('asc', 'true');
		$builder = DB::table("products"); 
		$count = $builder->count(); //menghitung total data
		$builder = $builder->orderBy($sort, $asc == "true" ? "asc" : "desc"); //urutkan data dari sort dengan ascending atau descending
		$builder->paginate($pageSize);

		$products = $builder->get();
		return response()->json([
			'data' => $products,
			'totalRow' => $count,
			'totalPage' => ceil($count / $pageSize),
			'direction' => $asc == "true" ? 'ASC' : 'DESC'
		]);
	}

	// Membuat method untuk get by id
	function getById(Request $request, $id) {
		$product = DB::table("products")
		->where("ProductID", $id);
		// Pengecekan data ada atau tidak
		if($product->exists()) {
			return response()->json($product->first());
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
		$success = DB::table("products")->insert($data);
		return response()->json([
			'success' => true,
			'message' => 'Insert Data Success',
			'data' => $data
		]);
	}

	// Membuat method untuk update
	function update(Request $request, $id) {
		$data = $request->all();
		$quebild = DB::table("products");

		// pengecekan ID
		$product = $quebild->where("ProductID", $id);

		// Pengecekan data ada atau tidak
		if($product->exists()) {
			$product->update($data);
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
		$quebild = DB::table("products");

		// pengecekan ID
		$product = $quebild->where("ProductID", $id);

		// Pengecekan data ada atau tidak
		if($product->exists()) {
			$product->delete();
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