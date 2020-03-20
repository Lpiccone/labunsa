<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Exception;
use App\In_ReactivesModel;
use App\ReactivesModel;
use PhpParser\Node\Stmt\TryCatch;

class In_ReactivesController extends Controller
{
    public function getReactives() {
        return ReactivesModel::all();
    }
    public function index(Request $request){
        $in_reactives = DB::table('in_reactives')
                ->join('reactives', 'reactives.id_reactive', '=', 'in_reactives.id_reactive')
                ->select('in_reactives.id_in_reactive', 'in_reactives.unitys', 'in_reactives.update_at', 'reactives.name', 'in_reactives.id_reactive', 'in_reactives.observations')
                ->orderBy('reactives.name','desc')
                ->get();
        //$in_reactives = In_ReactivesModel::all();
        return $in_reactives;
    }
    public function store(Request $request)
    {
        //if (!$request->ajax()) return redirect('/');
        try{

            DB::beginTransaction();
            $request->validate([            
                'id_reactive'=>'required', 
                'unitys'=>'required',   
                'observation'=>'required',                  
                ]);
            $in = new In_ReactivesModel([
                'id_reactive' => $request->post('id_reactive'),
                'unitys' => $request->post('unitys'),
                'observations' => $request->post('observations'),
            ]);
            
            $in->save();
            DB::commit();
        } catch (Exception $e){
            DB::rollBack();
        }   
    }
    public function update(Request $request)
    {
        $in_reactive = In_ReactivesModel::findOrFail($request->id_in_reactive);
        $in_reactive ->unitys = $request->unitys;
        $in_reactive ->id_reactive = $request->id_reactive;
        $in_reactive ->observations = $request->observations;
        $in_reactive->save();
    }
    public function destroy($id){        
        $post = In_ReactivesModel::find($id);
        $post->delete();
        return response()->json('successfully deleted');
    }
}
