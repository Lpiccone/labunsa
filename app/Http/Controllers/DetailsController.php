<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Exception;
use App\DetailsModel;
use PhpParser\Node\Stmt\TryCatch;

class DetailsController extends Controller
{
    public function index(Request $request){
        $details = DetailsModel::all();
        return $details;
    }
    public function store(Request $request){
        //if (!$request->ajax()) return redirect('/');
        try{
            DB::beginTransaction();
            $request->validate([            
                'id_headboards'=>'required',
                'id_analysis'=>'required',
                'observation'=>'required',
                'price'=>'required'
                ]);
            $details = new DetailsModel([
                'id_headboards' => $request->post('id_headboards'),
                'id_analysis'=> $request->post('id_analysis'),
                'observation'=> $request->post('observation'),
                'price'=> $request->post('price'),
            ]);  
            $details->save();
            DB::commit();
        //  return redirect('/category')->with('success', 'Category saved!');
        } catch (Exception $e){
            DB::rollBack();
        }   
    }
    public function update(Request $request)
    {
      $category = DetailsModel::findOrFail($request->id_in_reactive);
      $category ->unitys = $request->unitys;
      $category ->id_reactive = $request->id_reactive;
      $category->save();
    }
    public function destroy($id){
        $post = DetailsModel::find($id);
        $post->delete();
        return response()->json('successfully deleted');
    }
}
