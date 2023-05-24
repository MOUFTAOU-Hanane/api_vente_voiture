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
            $result =  $this->_operationService->getMarque();
            return response()->json([
                'data' => $result,
                'status' => "success",  'message' => "success",
            ], 200);


        }catch(Exception $ex){
            throw new Exception($ex);
        }

    }
    //listing modele
    public function getModele(){
        try{
            $result = $this->_operationService->getModele();
            return response()->json([
                'data' => $result,
                'status' => "success",  'message' => "success",
            ], 200);

        }catch(Exception $ex){
            throw new Exception($ex);
        }

    }
    //listing categorie vehicule
    public function getTypeVehicule(){
        try{
            $result = $this->_operationService->getTypeVehicule();
            return response()->json([
                'data' => $result,
                'status' => "success",  'message' => "success",
            ], 200);

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
            $result =  $this->_operationService->getVehicules();
            return response()->json([
                'data' => $result,
                'status' => "success",  'message' => "success",
            ], 200);


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

   public function deleteVehicule(Request $request){
        try{
            $rData =  $request->only([
                "vehicule_id"
            ]);
              //data validation
        $validator = [
            'vehicule_id' => ['required',"exists:vehicules,id"],
        ];

        $validationMessages = [
            'vehicule_id.required' => "L'identifiant du véhicule est requis",
            'vehicule_id.exists' => "L'identifiant du véhicule n'est pas valide",
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
        $vehicule_id = $rData["vehicule_id"];

         //do operation
        $result = $this->_operationService->deleteVehicule($vehicule_id);
        if($result === false){
            return response()->json([
                'status' => "error",  'message' => "Une erreur est survenue lors de la suppression.",
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

    //
    public function createCategory(Request $request){
        try{
            $rData =  $request->only([
                'libelle',"code",
            ]);
              //data validation
        $validator = [
            'libelle' => ['required'],
            'code' => ['required'],

        ];

        $validationMessages = [
            'libelle.required' => "Le  libelle  est requis",
            'code.required' => "Le code est requis",


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
        $libelle = $rData["libelle"];
        $code = $rData["code"];


         //do operation
        $result = $this->_operationService->createCategory($libelle, $code);
        if($result === false){
            return response()->json([
                'status' => "error",  'message' => "Une erreur est survenue lors de la création d'une catégorie de véhicule.",
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

    public function createModel(Request $request){
        try{
            $rData =  $request->only([
                'libelle',"code",
            ]);
              //data validation
        $validator = [
            'libelle' => ['required'],
            'code' => ['required'],

        ];

        $validationMessages = [
            'libelle.required' => "Le  libelle  est requis",
            'code.required' => "Le code est requis",


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
        $libelle = $rData["libelle"];
        $code = $rData["code"];


         //do operation
        $result = $this->_operationService->createModel($libelle, $code);
        if($result === false){
            return response()->json([
                'status' => "error",  'message' => "Une erreur est survenue lors de la création d'un modele de véhicule.",
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


    public function createMarque(Request $request){
        try{
            $rData =  $request->only([
                'libelle',"code",
            ]);
              //data validation
        $validator = [
            'libelle' => ['required'],
            'code' => ['required'],

        ];

        $validationMessages = [
            'libelle.required' => "Le  libelle  est requis",
            'code.required' => "Le code est requis",


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
        $libelle = $rData["libelle"];
        $code = $rData["code"];


         //do operation
        $result = $this->_operationService->createMarque($libelle, $code);
        if($result === false){
            return response()->json([
                'status' => "error",  'message' => "Une erreur est survenue lors de la création d'une marque de véhicule.",
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



   public function detailVehicule(Request $request){
    try{
        $rData =  $request->only([
            "vehicule_id"
        ]);
          //data validation
    $validator = [
        'vehicule_id' => ['required',"exists:vehicules,id"],
    ];

    $validationMessages = [
        'vehicule_id.required' => "L'identifiant du véhicule est requis",
        'vehicule_id.exists' => "L'identifiant du véhicule n'est pas valide",
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
    $vehicule_id = $rData["vehicule_id"];

     //do operation
    $result = $this->_operationService->detailVehicule($vehicule_id);
    if($result === false){
        return response()->json([
            'status' => "error",  'message' => "Une erreur est survenue.",
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
