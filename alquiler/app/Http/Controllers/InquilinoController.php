<?php

namespace App\Http\Controllers;

use App\Models\Inquilino;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class InquilinoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      $products=  DB::table('inquilinos')->select('*')->get();
      return $products ;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('inquilinos.form');
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
            'phone'=>'required',
            'cuit' =>'required',
            'dni' =>'required',
            'facturar' =>'required'

        ]);
        $nombre=$request->post('name');
        $phone=$request->post('phone');
        $cuit=$request->post('cuit');
        $dni=$request->post('dni');
        $facturar=$request->post('facturar');

        DB::table('inquilinos')->insert([
            'name'=>$nombre,
            'phone'=>$phone,
            'cuit'=> $cuit,
            'dni'=>$dni,
            'facturar'=>$facturar,

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

        $inquilino=DB::table('inquilinos')->where('id',$id)->first();
        return $inquilino;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $inquilino=DB::table('inquilinos')->where('id',$id)->first();
        return view('inquilinos.edit',compact('inquilino'));
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
              $inquilino=Inquilino::findOrFail($id);
              $request->validate([
                'name'=>'required|min:3|max:50',
                'phone'=>'required',
                'cuit' =>'required',
                'dni' =>'required',
                'facturar' =>'required'
            ]);
              $inquilino->name=$request->input('name');
              $inquilino->phone=$request->input('phone');
              $inquilino->cuit =$request->input('cuit');
              $inquilino->dni=$request->input('dni');
              $inquilino->facturar =$request->input('facturar');

              $inquilino->save();

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        DB::table('inquilinos')->where('id',$id)->delete();
    }
}
