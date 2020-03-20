<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Exception;
use App\CategoryModel;
use PhpParser\Node\Stmt\TryCatch;

class CategoryController extends Controller
{
    public function index(Request $request){
        $analysis_category = CategoryModel::all();
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
            $analysis_category = new CategoryModel([
                'name_category' => $request->post('name_category'),
            ]);
            $analysis_category->save();
            DB::commit();
            return redirect('/category')->with('success', 'Category saved!');
        } catch (Exception $e){
            DB::rollBack();
        }
    }
    public function update(Request $request)
    {
      $category = CategoryModel::findOrFail($request->id_analysis_category);
      $category ->name_category = $request->name_category;
      $category->save();
    }
    public function destroy($id){
        $post = CategoryModel::find($id);
        $post->delete();
        return response()->json('successfully deleted');
    }
}
