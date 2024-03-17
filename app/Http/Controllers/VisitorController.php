<?php

namespace App\Http\Controllers;

use App\Models\Visitor;
use Illuminate\Http\Request;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class VisitorController extends Controller
{
    //
    public function generate(int $id=0) {
        $qrCodes = [];
        $qrCodes['simple'] = QrCode::size(120)->generate('https://www.binaryboxtuts.com/');
        $qrCodes['changeColor'] = QrCode::size(120)->color(255, 0, 0)->generate('https://www.binaryboxtuts.com/');
        $qrCodes['changeBgColor'] = QrCode::size(120)->backgroundColor(255, 0, 0)->generate('https://www.binaryboxtuts.com/');
         
        $qrCodes['styleDot'] = QrCode::size(120)->style('dot')->generate('https://www.binaryboxtuts.com/');
        $qrCodes['styleSquare'] = QrCode::size(120)->style('square')->generate('https://www.binaryboxtuts.com/');
        $qrCodes['styleRound'] = QrCode::size(120)->style('round')->generate('https://www.binaryboxtuts.com/');
     
        //$qrCodes['withImage'] = QrCode::size(200)->format('png')->generate('https://www.binaryboxtuts.com/');    
        return view('visitor')->with('QrCode',base64_encode(Qrcode::format('png')->size(256)->generate('eth')));
    }
    public function state_status(Request $request)
    {
        $data               = json_decode($request->getContent());
        $id                 = $data->id;
        $message            = "Ce QRCode a déjà été scannez";
        $verify             = Visitor::find($id);
        if($verify){
            if($verify->status == 0){
                $update_data = [
                    'status' =>  true,
                    ];
                $verify->update($update_data);
                $message    = "QRCode Scannez avec succès";
            }
        }
        $response =[
            'message'=>$message
        ];
        return response($response,201);
    }
    public function store(Request $request)
    {
        $msg                = "Enregistrement réussie avec succès";
        $status             = 201;
        $data               = json_decode($request->getContent());
            $state_save = Visitor::create([
                'name' =>  $data->name,
                'secondName' =>  $data->secondName,
                'phone' =>  $data->phone,
            ]);
            if(!$state_save){
                $msg = "Echec de l'enregistrement";
                $status = 400;
            }
        return response()->json([
            "message"=>$msg,
            "id"=>$state_save->id
        ],$status);
    }
}
