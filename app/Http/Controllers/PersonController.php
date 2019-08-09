<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\ModelPerson;

class PersonController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }
	
	public function index(){
		return view('greeting');
	}
	
	public function all(){
		$data = ModelPerson::all();
		return response($data);
	}
	
	public function show($id){
		$data = ModelPerson::where('_id',$id)->get();
		return response ($data);
	}
	public function store (Request $request){
		$data = new ModelPerson();
		$data->name = $request->input('name');
		$data->address = $request->input('address');
		$data->phone = $request->input('phone');
		$data->email = $request->input('email');
		$data->save();

		return response('Berhasil Tambah Data');
	}
	
	public function update(Request $request, $id){
		$data = ModelPerson::where('_id',$id)->first();
		$data->name = $request->input('name');
		$data->address = $request->input('address');
		$data->phone = $request->input('phone');
		$data->email = $request->input('email');
		$data->save();

		return response('Berhasil Merubah Data');
	}

	public function destroy($id){
		$data = ModelPerson::where('_id',$id)->first();
		$data->delete();

		return response('Berhasil Menghapus Data');
	}

    //
}