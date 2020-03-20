<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Exception;
use App\PatientModel;
use PhpParser\Node\Stmt\TryCatch;

class PatientController extends Controller
{
    public function index(Request $request){
        $patient = PatientModel::all();
        return $patient;
    }
    public function edit(Request $request){         
        $patient = PatientModel::find($request);        
        return $patient;       
    }
    public function store(Request $request)
    {
        //if (!$request->ajax()) return redirect('/');
        try{

            DB::beginTransaction();
            $request->validate([            
                'name_patient'=>'required',
                'last_name_patient'=>'required',
                'doi'=>'required',
                'phone'=>'required',
                'date_birth'=>'required',
                'gender'=>'required',
                'nationality'=>'required',
                'occupation'=>'required',
                'email'=>'required',
                'home_direction'=>'required',
                'allergies'=>'required'
                ]);
            $patient = new PatientModel([
                'name_patient'=> $request->post('name_patient'),
                'last_name_patient'=> $request->post('last_name_patient'),
                'doi'=> $request->post('doi'),
                'phone'=> $request->post('phone'),
                'date_birth'=> $request->post('date_birth'),
                'gender'=> $request->post('gender'),
                'nationality'=> $request->post('nationality'),
                'occupation'=> $request->post('occupation'),
                'email'=> $request->post('email'),
                'home_direction'=> $request->post('home_direction'),
                'allergies'=> $request->post('allergies')
            ]);
            
            $patient->save();
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
            $patient = PatientModel::findOrFail($request->id_patient);
            $patient->name_patient = $request->name_patient;
            $patient->last_name_patient = $request->last_name_patient;
            $patient->doi = $request->doi;
            $patient->phone = $request->phone;
            $patient->date_birth = $request->date_birth;
            $patient->gender = $request->gender;
            $patient->nationality = $request->nationality;
            $patient->occupation = $request->occupation;
            $patient->email = $request->email;
            $patient->home_direction = $request->home_direction;
            $patient->allergies = $request->allergies;
            $patient->save();
            DB::commit();
        } catch (Exception $e){
            DB::rollBack();
        }
    }
    public function create() { 
        //return view('ccategory.create'); 
    }
    public function destroy(Request $request){        
        $patient = PatientModel::find($request);        
        $patient->delete();       
        //return redirect('/ccategory')->with('success', 'Contact deleted!');    
    }
    public function selectPatient(Request $request){
        //if (!$request->ajax()) return redirect('/');

        $filtro = $request->filtro;
        $patients = PatientModel::join('headboards','patients.id_patient','=','headboards.id_patient')
        ->Where('patients.last_name_patient', 'like ' ,'%'.$filtro.'%')
        ->select('patients.id_patient','patients.last_name_patient','patients.name_patient')
        ->orderBy('patients.last_name_patient', 'asc')
        ->get();

        return ['patients'=>$patients.'el filtro '.$filtro];
        
    }
}
