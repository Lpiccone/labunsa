<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Exception;
use App\HeadboardsModel;
use App\DetailsModel;
use App\ReferenciaModel;
use App\PatientModel;
use App\AnalysisModel;
use Carbon\Carbon;


class HeadboardsController extends Controller
{
    public function index(Request $request){
        $headboards = DB::table('headboards')
                ->join('referencias', 'referencias.id_referencia', '=', 'headboards.id_referencia')
                ->join('patients', 'patients.id_patient', '=', 'headboards.id_patient')
                ->select('referencias.referencia_name', DB::raw("CONCAT(patients.last_name_patient,',',patients.name_patient) as display_name"), 'headboards.total', 'headboards.created_at')
                ->orderBy('headboards.id_headboards','desc')
                ->get();    
        return $headboards;
    }
    public function getReferencias() {
        return ReferenciaModel::all();
    }
    public function getPatients() {
        return PatientModel::all();
    }
    public function getAnalysis() {
        return AnalysisModel::all();
    }
    public function store(Request $request)
    {
        //if (!$request->ajax()) return redirect('/');

           $request->validate([
                'id_referencia'=>'required',
                'id_patient'=>'required',
                'total'=>'required',
                ]);
            $headboard = new HeadboardsModel([
                'id_referencia'=>$request->post('id_referencia'),
                'id_patient'=>$request->post('id_patient'),
                'total'=>$request->post('total'),
            ]);
            $headboard->save();

            $detalles = $request->datos;//Array de detalles
            //Recorro todos los elementos
 
            foreach($detalles as $det)
            {
                
                $detalle = new DetailsModel();
                $detalle->id_headboards = $headboard->id_headboards;
                $detalle->id_analysis = $det['id_analysis'];
                $detalle->price = $det['price'];    
                
                if($detalle->id_analysis == null){
                    dd($detalle); 
                }
                
                
                $detalle->save();
            }
        
    }
    public function cargarPdfHeadboards(Request $request) 
    {     
        $id_headboards = $request->id_headboards;
        
        $ficha_estudiante = json_decode(Reporte::where('id_headboards', '=', $id_headboards)->firstOrFail());
               
        $pdf = \PDF::loadView('pdf.solicitud', 
            [                   
                'solicitud_analysis' => $solicitud_analysis,                           
            ]
        );       
        return $pdf->stream("solicitud_analysis.pdf", array("Attachment" => false));
    }

}
