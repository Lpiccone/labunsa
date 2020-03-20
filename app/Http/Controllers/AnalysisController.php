<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Exception;
use App\AnalysisModel;
use App\CategoryModel;
use PhpParser\Node\Stmt\TryCatch;

class AnalysisController extends Controller
{
    public function index(Request $request){
        $analysis = AnalysisModel::all();
        return $analysis;
    }
    public function getAnalysis() {
        return AnalysisModel::all();
    }
    public function getCategory() {
        return CategoryModel::all();
    }
    public function store(Request $request)
    {
        //if (!$request->ajax()) return redirect('/');
        try{

            DB::beginTransaction();
            $request->validate([            
                'id_analysis_category'=>'required',
                'id_cash'=>'required',
                'name_analysis'=>'required',
                'description'=>'required',
                'price'=>'required'
                ]);
            $analysis_category = new AnalysisModel([
                'id_analysis_category'=>$request->post('id_analysis_category'),
                'id_cash'=>$request->post('id_cash'),
                'name_analysis'=>$request->post('name_analysis'),
                'description'=>$request->post('description'),
                'price'=>$request->post('price'),
            ]);
            $analysis_category->save();
            DB::commit();

        } catch (Exception $e){
            DB::rollBack();
        }   
    }
    public function update(Request $request)
    {
        //if (!$request->ajax()) return redirect('/');

            $analysis = AnalysisModel::findOrFail($request->id_analysis);
            $analysis->id_analysis_category = $request->id_analysis_category;
            $analysis->id_cash = $request->id_cash;
            $analysis->name_analysis = $request->name_analysis;
            $analysis->description = $request->description;
            $analysis->price = $request->price;
            $analysis->save();
    }
    public function destroy(Request $request){        
        $analysis = AnalysisModel::find($request);        
        $analysis->delete();       
        //return redirect('/ccategory')->with('success', 'Contact deleted!');    
    }
}
