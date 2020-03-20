<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Exception;
use App\ReactivesModel;
use PhpParser\Node\Stmt\TryCatch;

class ReactivesController extends Controller
{
    public function index(Request $request){
        $analysis_category = ReactivesModel::all();
        return $analysis_category;
    }

    public function store(Request $request)
    {
        //if (!$request->ajax()) return redirect('/');
        try{

            DB::beginTransaction();
            $request->validate([            
                'name_category'=>'required',                    
                ]);
            $analysis_category = new ReactivesModel([
                'name_category' => $request->post('name_category'),
            ]);
            
            $analysis_category->save();
            DB::commit();
            return redirect('/category')->with('success', 'Category saved!');
        } catch (Exception $e){
            DB::rollBack();
        }   
    }
   /* public function edit($id){         
        $analysis_category = CategoryModel::find($id);        
        return $analysis_category;       
    }
    public function update(Request $request)
    {
        //if (!$request->ajax()) return redirect('/');
        try{
            DB::beginTransaction();
            $category = CategoryModel::findOrFail($request->id_analysis_category);
            $category->name_category = $request->name_category;
            $category->save();
            DB::commit();
        } catch (Exception $e){
            DB::rollBack();
        }
    }*/
    public function edit($id)
    {
      $post = ReactivesModel::find($id);
      return response()->json($post);
    }

    public function update($id, Request $request)
    {
      $post = ReactivesModel::find($id);

      $post->update($request->all());

      return response()->json('successfully updated');
    }
    public function create() { 
        return view('ccategory.create'); 
    }
    public function destroy($id){        
        $post = ReactivesModel::find($id);
        $post->delete();
        return response()->json('successfully deleted');
    }
}
