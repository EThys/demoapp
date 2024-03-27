<?php

namespace App\Http\Controllers;

use App\Models\Visitor;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Storage;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class VisitorController extends Controller
{
    //
    
    public function index()
    {
        $visitors = Visitor::paginate(10);
        return view('dashboard', compact('visitors'));
    }


    public function state_status(Request $request)
    {
        $data               = json_decode($request->getContent());
        $id                 = (int)$data->id;
        $message            = "noscan";
        $verify = Visitor::find($id);
       
        if($verify){
            if($verify->status == 0){
                $update_data = [
                    'status' =>  true,
                    ];
                $verify->update($update_data);
                $message    = "scan";
            }
        }
        $response =[
            'message'=>$message
        ];
        return response($response,201);
    }

    // public function getQrCode() {

    //     $latestVisitor = Visitor::orderBy('created_at', 'desc')->first();
      
    //     if(!$latestVisitor) {
    //       return response()->json(['error' => 'No visitors found'], 404);
    //     }
      
    //     $qrCodePath = storage_path($latestVisitor->qrCode);
      

    //     $response = Response::make(Storage::get($qrCodePath), 200);

    //     $response->header('Content-Type', 'image/svg+xml');

    //     return $response;
 
      
    //   }

    public function getLatestVisitorId() {

        $latestVisitor = Visitor::orderBy('id', 'desc')->first();
      
        if(!$latestVisitor) {
          return response()->json(['error' => "Visiteur n'existe pas"], 404);
        }
      
        return response()->json([
          'id' => $latestVisitor->id
        ]);
      
      }


    public function store(Request $request) {

        $validatedData = $request->validate([
          'name' => 'required',
          'secondName' => 'required', 
          'phone' => 'required'
        ]);
        $phone=$validatedData['phone'];

      // Vérifier s'il existe déjà pour les enregistrements ultérieurs

        if(Visitor::where('phone', $phone)->exists()){
            return response()->json(['message' => 'Visiteur existe déjà'], 400);
        }
        else{
            $visitor = Visitor::create($validatedData);
        
            // Récupération de l'ID auto-généré
            $id = $visitor->id;  
        
            // Génération du QR code
            
            $qrCode = QrCode::generate($id);
        
            // Stockage du QR code
            $qrCodePath = "qrcodes/qrcode-$id.svg";
            Storage::put($qrCodePath, $qrCode);
            
            // Mise à jour de l'objet Visitor
            $visitor->qrCode = $qrCodePath;
        
            if(!$visitor->save()) {
            return response()->json(['errors' => $visitor->errors()], 400); 
            }
        
            return response()->json([
              'message' => 'Enregistré avec succès',
              'id'=>$id
            ], 201);
    
        }
      }


   
}
