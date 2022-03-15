<?php

namespace App\Http\Controllers;

use App\Models\Departamento;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DepartamentoController extends Controller
{
      /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      $departamentos=  DB::table('departamentos')->select('*')->get();
      return $departamentos ;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('departamentos.form');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $request->validate([
            'name'=>'required|min:3|max:50',
            'invoice'=>'required',
            'address' =>'required',
            'city' =>'required',
            'phone' =>'required',
            'email'=>'required',
            'status'=>'required'

        ]);
        $nombre=$request->post('name');
        $invoice=$request->post('invoice');
        $address=$request->post('address');
        $city=$request->post('city');
        $phone=$request->post('phone');
        $email=$request->post('email');
        $status=$request->post('status');

        DB::table('departamentos')->insert([
            'name'=>$nombre,
            'invoice'=>$invoice,
            'address'=>$address,
            'city'=>$city,
            'phone'=>$phone,
            'email'=> $email,
            'status'=>$status,

        ]);

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

        $departamento=DB::table('departamentos')->where('id',$id)->first();
        return $departamento;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $departamento=DB::table('departamentos')->where('id',$id)->first();
        return view('departamentos.edit',compact('departamento'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
              $departamento=Departamento::findOrFail($id);
              $request->validate([
                'name'=>'required|min:3|max:50',
                'invoice'=>'required',
                'address' =>'required',
                'city' =>'required',
                'phone' =>'required',
                'email'=>'required',
                'status'=>'required'
            ]);
              $departamento->name=$request->input('name');
              $departamento->invoice=$request->input('invoice');
              $departamento->address =$request->input('address');
              $departamento->city=$request->input('city');
              $departamento->phone =$request->input('phone');
              $departamento->email=$request->input('email');
              $departamento->status=$request->input('status');

              $departamento->save();

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        DB::table('departamentos')->where('id',$id)->delete();
    }
}
