<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Exception;
use App\ReferenciaModel;
use PhpParser\Node\Stmt\TryCatch;


class ReferenciaController extends Controller
{
    public function index(Request $request){
        $referencia = ReferenciaModel::all();
        return $referencia;
    }
    public function edit(Request $request){         
        $referencia = ReferenciaModel::find($request);        
        return $referencia;       
    }
    public function store(Request $request)
    {
        //if (!$request->ajax()) return redirect('/');
        try{

            DB::beginTransaction();
            $request->validate([            
                'referencia_name'=>'required',
                'doi'=>'required',
                'phone'=>'required',
                'speciality'=>'required',
                'email'=>'required',
                'direction'=>'required'
                ]);
            $referencia = new ReferenciaModel([
                'referencia_name'=> $request->post('referencia_name'),
                'doi'=> $request->post('doi'),
                'phone'=> $request->post('phone'),
                'speciality'=> $request->post('speciality'),
                'email'=> $request->post('email'),
                'direction'=> $request->post('direction')
            ]);
            
            $referencia->save();
            DB::commit();
            //return redirect('/category')->with('success', 'Category saved!');
        } catch (Exception $e){
            DB::rollBack();
        }   
    }
    /*
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        //if (!$request->ajax()) return redirect('/');
        try{
            DB::beginTransaction();
            $referencia = ReferenciaModel::findOrFail($request->id_referencia);
            $referencia->referencia_name = $request->referencia_name;
            $referencia->doi = $request->doi;
            $referencia->phone = $request->phone;
            $referencia->speciality = $request->speciality;
            $referencia->email = $request->email;
            $referencia->direction = $request->direction;
            $referencia->save();
            DB::commit();
        } catch (Exception $e){
            DB::rollBack();
        }
    }
    public function create() { 
        //return view('ccategory.create'); 
    }
    public function destroy(Request $request){        
        $referencia = ReferenciaModel::find($request);        
        $referencia->delete();       
        //return redirect('/ccategory')->with('success', 'Contact deleted!');    
    }
}
