<?php

namespace App\Http\Controllers;

use App\Models\Propietario;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PropietarioController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      $propietarios=  DB::table('propietarios')->select('*')->get();
      return response()->json($propietarios)  ;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('propietarios.form');
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
            'name'=>'required|min:3|max:60',
            'invoice'=>'required|max:1',
            'address' =>'required|max:60',
            'city'=>'required|max:60',
            'phone'=>'required|max:15',
            'email' =>'required|max:60',
            'status' =>'required|max:1'

        ]);
        $nombre=$request->post('name');
        $invoice=$request->post('invoice');
        $address=$request->post('address');
        $city=$request->post('city');
        $phone=$request->post('phone');
        $email=$request->post('email');
        $status=$request->post('status');



        DB::table('propietarios')->insert([
            'name'=>$nombre,
            'invoice'=> $invoice,
            'address'=>$address,
            'city'=>$city,
            'phone'=>$phone,
            'email'=>$email,
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

        $propietario=DB::table('propietarios')->where('id',$id)->first();
        return $propietario;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $propietario=DB::table('propietarios')->where('id',$id)->first();
        return view('propietarios.edit',compact('propietario'));
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
              $propietario=Propietario::findOrFail($id);
              $request->validate([
                'name'=>'required|min:3|max:60',
                'invoice'=>'required|max:1',
                'address' =>'required|max:60',
                'city'=>'required|max:60',
                'phone'=>'required|max:15',
                'email' =>'required|max:60',
                'status' =>'required|max:1'
            ]);
              $propietario->name=$request->input('name');
              $propietario->invoice=$request->input('invoice');
              $propietario->address=$request->input('address');
              $propietario->city =$request->input('city');
              $propietario->phone=$request->input('phone');
              $propietario->email=$request->input('email');
              $propietario->status=$request->input('status');
              $propietario->save();

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        DB::table('propietarios')->where('id',$id)->delete();
    }
}
