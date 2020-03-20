<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Exception;
use App\ParameterModel;
use PhpParser\Node\Stmt\TryCatch;

class ParameterController extends Controller
{
    public function index(Request $request){
        $parameter = ParameterModel::all();
        return $parameter;
    }
    public function edit(Request $request){         
        $parameter = ParameterModel::find($request);        
        return $parameter;       
    }
    public function store(Request $request)
    {
        //if (!$request->ajax()) return redirect('/');
        try{

            DB::beginTransaction();
            $request->validate([            
                'id_analysis'=>'required',                    
                'name_parameter'=>'required',
                'value_min'=>'required',
                'value_max'=>'required',
                'unity'=>'required'
                ]);
            $parameter = new ParameterModel([
                'id_analysis'=>$request->post('id_analysis'),
                'name_parameter'=>$request->post('name_parameter'),
                'value_min'=>$request->post('value_min'),
                'value_max'=>$request->post('value_max'),
                'unity'=>$request->post('unity'),
            ]);
            
            $parameter->save();
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
            $parameter = ParameterModel::findOrFail($request->id_parameter);
            $parameter->id_analysis = $request->id_analysis;
            $parameter->name_parameter = $request->name_parameter;
            $parameter->value_min = $request->value_min;
            $parameter->value_max = $request->value_max;
            $parameter->unity = $request->unity;
            $parameter->save();
            DB::commit();
        } catch (Exception $e){
            DB::rollBack();
        }
    }
    public function create() { 
        //return view('ccategory.create'); 
    }
    public function destroy(Request $request){        
        $parameter = ParameterModel::find($request);        
        $parameter->delete();       
        //return redirect('/ccategory')->with('success', 'Contact deleted!');    
    }
}
