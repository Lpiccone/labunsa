<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Exception;
use App\ResultModel;
use PhpParser\Node\Stmt\TryCatch;



class ResultController extends Controller
{
    public function index(Request $request){
        $result = ResultModel::all();
        return $result;
    }
    public function edit(Request $request){         
        $result = ResultModel::find($request);        
        return $result;       
    }
    public function store(Request $request)
    {
        //if (!$request->ajax()) return redirect('/');
        try{

            DB::beginTransaction();
            $request->validate([            
                'id_details'=>'required',
                'id_parameter'=>'required',
                'observations'=>'required'
                ]);
            $result = new ResultModel([
                'id_details'=> $request->post('id_details'),
                'id_parameter'=> $request->post('id_parameter'),
                'observations'=> $request->post('observations')
            ]);
            
            $result->save();
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
            $result = ResultModel::findOrFail($request->id_result);
            $result->id_details = $request->id_details;
            $result->id_parameter = $request->id_parameter;
            $result->observations = $request->observations;
            $result->save();
            DB::commit();
        } catch (Exception $e){
            DB::rollBack();
        }
    }
    public function create() { 
        //return view('ccategory.create'); 
    }
    public function destroy(Request $request){        
        $result = ResultModel::find($request);        
        $result->delete();       
        //return redirect('/ccategory')->with('success', 'Contact deleted!');    
    }
}
