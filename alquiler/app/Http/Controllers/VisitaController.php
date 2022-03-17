<?php

namespace App\Http\Controllers;

use App\Models\Visita;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class VisitaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $visitantes =  DB::table('visitas')->select('*')->get();
        return response()->json($visitantes);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('visitas.form');
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
            'email' => 'required',
            'password' => 'required'
        ]);

        $email = $request->post('email');
        $password = $request->post('password');

        DB::table('visitas')->insert([
            'email' => $email,
            'passwordd' => $password,
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

        $visita = DB::table('visitas')->where('id', $id)->first();
        return $visita;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $visita = DB::table('visitas')->where('id', $id)->first();
        return view('visitas.edit', compact('visita'));
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
        $visita = Visita::findOrFail($id);
        $request->validate([
            'email' => 'required',
            'password' => 'required',
        ]);

        $visita->email = $request->input('email');
        $visita->password = $request->input('password');
        $visita->save();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        DB::table('visitas')->where('id', $id)->delete();
    }
}
