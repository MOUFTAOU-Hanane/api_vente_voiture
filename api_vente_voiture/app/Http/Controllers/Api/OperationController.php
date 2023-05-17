<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\OperationService;
use Exception;
use Illuminate\Support\Facades\Validator;

class OperationController extends Controller
{

 protected OperationService $_operationService;
     public function __construct(OperationService $operationService){
      $this->_operationService = $operationService;}
    //

    //listing marque
    public function getMarque(){
        try{
            return  $this->_operationService->getMarque();


        }catch(Exception $ex){
            throw new Exception($ex);
        }

    }
    //listing modele
    public function getModele(){
        try{
            return  $this->_operationService->getModele();

        }catch(Exception $ex){
            throw new Exception($ex);
        }

    }
    //listing categorie vehicule
    public function getTypeVehicule(){
        try{
            return  $this->_operationService->getTypeVehicule();

        }catch(Exception $ex){
            throw new Exception($ex);
        }

    }
    //listing couleur
    public function getCouleur(){
        try{
            return  $this->_operationService->getCouleur();

        }catch(Exception $ex){
            throw new Exception($ex);
        }

    }

    //save vehicule
    public function saveVehicule(Request $request){
        try{
            $rData =  $request->only([
                "modele_id", "marque_id","type_id","annee",
            ]);
              //data validation
        $validator = [
            'type_id' => ['required',"exists:types_vehicule,id"],
            'marque_id' => ['required',"exists:marques,id"],
            'modele_id' => ['required',"exists:modeles,id"],
            'annee' => ['required'],
        ];

        $validationMessages = [
            'type_id.required' => "Le  type  est requis",
            'marque_id.required' => "La marque est requise",
            'annee.required' => "L'année est requis",
            'modele_id.required' => "Le modele est requis",
             'type_id.exists' => "Le type n'est pas valide",
             'marque_id.exists' => "La marque n'est pas valide",

        ];
        $validatorResult = Validator::make($rData, $validator , $validationMessages);
        if ($validatorResult->fails()) {
            return response()->json([
                'data' => $validatorResult->errors()->first(),
                'status' => "error",
                'message' => "Veuillez fournir des informations valides",
            ], 400);
        }

       //get data as variables
        $type_vehicule = $rData["type_id"];
        $marque = $rData["marque_id"];
        $annee = $rData["annee"];
        $modele = $rData["modele_id"];

         //do operation
        $result = $this->_operationService->saveVehicule($type_vehicule, $marque, $annee, $modele );
        if($result === false){
            return response()->json([
                'status' => "error",  'message' => "Une erreur est survenue lors de la modification.",
            ], 400);


        }
        return response()->json([
            'data' =>$result,
            'status' => "success",  'message' => "succes",
        ], 200);

         }catch(Exception $ex){
            throw new Exception($ex);
        }
    }

    //listing alll  vehicules
    public function getVehicules(){
        try{
            return  $this->_operationService->getVehicules();

        }catch(Exception $ex){
            throw new Exception($ex);
        }

    }

    //update vehicule
    public function updateVehicule(Request $request){
        try{
            $rData =  $request->only([
                'vehicule_id',"modele_id", "marque_id", "type_id","annee",
            ]);
              //data validation
        $validator = [
            'vehicule_id' => ['required',"exists:vehicules,id"],
            'type_id' => ['required',"exists:types_vehicule,id"],
            'marque_id' => ['required',"exists:marques,id"],
            'modele_id' => ['required',"exists:modeles,id"],
            'annee' => ['required'],


        ];

        $validationMessages = [
            'type_id.required' => "Le  type  est requis",
            'vehicule_id.required' => "L'identifiant du vehicule est requis",
            'vehicule_id.exists' => "L'identifiant du vehicule n'est pas valide",
            'marque_id.required' => "La marque est requise",
            'annee.required' => "L'année est requis",
            'modele_id.required' => "Le modele est requis",
             'type_id.exists' => "Le type n'est pas valide",
             'marque_id.exists' => "La marque n'est pas valide",

        ];
        $validatorResult = Validator::make($rData, $validator , $validationMessages);
        if ($validatorResult->fails()) {
            return response()->json([
                'data' => $validatorResult->errors()->first(),
                'status' => "error",
                'message' => "Veuillez fournir des informations valides",
            ], 400);
        }

       //get data as variables
        $type_vehicule = $rData["type_id"];
        $marque = $rData["marque_id"];
        $annee = $rData["annee"];
        $modele = $rData["modele_id"];
        $vehiculeId = $rData["vehicule_id"];

         //do operation
        $result = $this->_operationService->updateVehicule($vehiculeId, $type_vehicule, $marque ,$annee , $modele);
        if($result === false){
            return response()->json([
                'status' => "error",  'message' => "Une erreur est survenue lors de la modification.",
            ], 400);


        }
        return response()->json([
            'data' =>$result,
            'status' => "success",  'message' => "succes",
        ], 200);

         }catch(Exception $ex){
            throw new Exception($ex);
        }
    }




}
