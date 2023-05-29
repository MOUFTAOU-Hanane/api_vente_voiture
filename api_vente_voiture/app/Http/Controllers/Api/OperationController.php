<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\OperationService;
use Exception;
use Illuminate\Support\Facades\Validator;
use OpenApi\Annotations as OA;


class OperationController extends Controller
{

 protected OperationService $_operationService;
     public function __construct(OperationService $operationService){
      $this->_operationService = $operationService;}
    //

    //listing brand

        /**
         *  * @OA\Info(
 *      version="1.0.0",
 *      title=" OpenApi Documentation",
 *      description=" Swagger OpenApi description",
 * )
 * @OA\Get(
 *     path="/hanane/public/api/params/brand",
 *     summary="Get brand vehicle",
 *     tags={"brand vehicle"},
 *     @OA\Response(response="200", description=" listing brand vehicle"),
 *
 * )
 */
    public function getBrand(){
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
       /**
 * @OA\Get(
 *     path="/hanane/public/api/params/models",
 *     summary="listing models vehicle",
 *     tags={"Model vehicle"},
 *     @OA\Response(response="200", description="Listing vehicle model"),
 *
 * )
 */
    public function getModel(){
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

   /**
 * @OA\Post(
 *     path="/hanane/public/api/params/update-model",
 *     summary="update modele",
 *     tags={"update modele"},
 *     @OA\RequestBody(
 *         required=true,
 *         @OA\JsonContent(
 *             type="object",
 *             @OA\Property(property="modele_id", type="int", example=1),
 *             @OA\Property(property="libelle", type="string", example="hbqhnjbhb"),
 *             @OA\Property(property="code", type="string", example="hbqb"),
 *         )
 *     ),
 *     @OA\Response(response="200", description="model updated"),
 *
 * )
 */

 public function updateModel(Request $request){
    try{
        $rData =  $request->only([
            'libelle',"code", "modele_id"
        ]);
          //data validation
    $validator = [
        'libelle' => ['required'],
        'code' => ['required'],
        'modele_id' => ['required',"exists:modeles,id"],

    ];

    $validationMessages = [
        'libelle.required' => "Le  libelle  est requis",
        'code.required' => "Le code est requis",
        'modele_id.required' => "Le modele est requis",
        'modele_id.exists' => "Le modele n'est pas valide",


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
    $model = $rData["modele_id"];


     //do operation
    $result = $this->_operationService->updateModel( $model, $libelle, $code,);
    if($result === false){
        return response()->json([
            'status' => "error",  'message' => "Une erreur est survenue lors de la modification d'un modele de véhicule.",
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

    //listing type vehicule
    /**
 * @OA\Get(
 *     path="/public/hanane/public/api/params/vehicle-type",
 *     summary="Listing vehicle type",
 *     tags={"Vehicle Type"},
 *     @OA\Response(response="200", description="Listing vehicle type"),
 *
 * )
 */
    public function getVehicleType(){
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
    /**
 * @OA\Post(
 *     path="/hanane/public/api/offer/save-vehicle",
 *     summary="save vehicle",
 *     tags={"Vehicle"},
 *     @OA\RequestBody(
 *         required=true,
 *         @OA\JsonContent(
 *             type="object",
 *             @OA\Property(property="modele_id", type="int", example=1),
 *             @OA\Property(property="marque_id", type="int", example=1),
 *             @OA\Property(property="type_id", type="int", example=1),
 *             @OA\Property(property="annee", type="integer", example=2022)
 *         )
 *     ),
 *     @OA\Response(response="200", description="vehicle saved"),
 *
 * )
 */
    public function saveVehicle(Request $request){
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

    //listing all  vehicules
        /**
 * @OA\Get(
 *     path="/hanane/public/api/offer/vehicles",
 *     summary="vehicles",
 *     tags={"vehicules"},
 *     @OA\Response(response="200", description="Listing vehicles"),
 *
 * )
 */
    public function getVehicles(){
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
     /**
 * @OA\Post(
 *     path="/hanane/public/api/offer/update-vehicle",
 *     summary="update vehicle",
 *     tags={"update vehicle"},
 *     @OA\RequestBody(
 *         required=true,
 *         @OA\JsonContent(
 *             type="object",
 *             @OA\Property(property="vehicule_id", type="int", example=1),
 *             @OA\Property(property="modele_id", type="int", example=1),
 *             @OA\Property(property="marque_id", type="int", example=1),
 *             @OA\Property(property="type_id", type="int", example=1),
 *             @OA\Property(property="annee", type="integer", example=2022)
 *         )
 *     ),
 *     @OA\Response(response="200", description="vehicle updated"),
 *
 * )
 */
    public function updateVehicle(Request $request){
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


        /**
 * @OA\Post(
 *     path="/hanane/public/api/offer/delete-vehicle",
 *     summary="delete vehicle",
 *     tags={"delete vehicle"},
 *     @OA\RequestBody(
 *         required=true,
 *         @OA\JsonContent(
 *             type="object",
 *             @OA\Property(property="vehicule_id", type="int", example=1),
 *         )
 *     ),
 *     @OA\Response(response="200", description="vehicle updated"),
 *
 * )
 */
   public function deleteVehicle(Request $request){
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

    //create category
/**
 * @OA\Post(
 *     path="/hanane/public/api/params/create-category",
 *     summary="create category vehicle",
 *     tags={"create category vehicle"},
 *     @OA\RequestBody(
 *         required=true,
 *         @OA\JsonContent(
 *             type="object",
 *             @OA\Property(property="libelle", type="string", example="toyota"),
 *             @OA\Property(property="code", type="string", example="toyota"),
 *         )
 *     ),
 *     @OA\Response(response="200", description="category vehicle created"),
 *
 * )
 */
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


            /**
 * @OA\Post(
 *     path="/hanane/public/api/params/create-model",
 *     summary="create-model",
 *     tags={"create model vehicle"},
 *     @OA\RequestBody(
 *         required=true,
 *         @OA\JsonContent(
 *             type="object",
 *             @OA\Property(property="libelle", type="string", example="toyota"),
 *             @OA\Property(property="code", type="string", example="toyota"),
 *         )
 *     ),
 *     @OA\Response(response="200", description="model created"),
 *
 * )
 */

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

          /**
 * @OA\Post(
 *     path="/hanane/public/api/params/create-brand",
 *     summary="create brand",
 *     tags={"create brand vehicle"},
 *     @OA\RequestBody(
 *         required=true,
 *         @OA\JsonContent(
 *             type="object",
 *             @OA\Property(property="libelle", type="string", example="toyota"),
 *             @OA\Property(property="code", type="string", example="toyota"),
 *         )
 *     ),
 *     @OA\Response(response="200", description="brand created"),
 *
 * )
 */
    public function createBrand(Request $request){
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


    //update brand
     /**
 * @OA\Post(
 *     path="/hanane/public/api/params/update-brand",
 *     summary="update brand",
 *     tags={"update brand"},
 *     @OA\RequestBody(
 *         required=true,
 *         @OA\JsonContent(
 *             type="object",
 *             @OA\Property(property="marque_id", type="int", example=1),
 *             @OA\Property(property="libelle", type="string", example="hbqhnjbhb"),
 *             @OA\Property(property="code", type="string", example="hbqb"),
 *         )
 *     ),
 *     @OA\Response(response="200", description="brand updated"),
 *
 * )
 */

 public function updateBrand(Request $request){
    try{
        $rData =  $request->only([
            'libelle',"code", "marque_id"
        ]);
          //data validation
    $validator = [
        'libelle' => ['required'],
        'code' => ['required'],
        'marque_id' => ['required',"exists:marques,id"],

    ];

    $validationMessages = [
        'libelle.required' => "Le  libelle  est requis",
        'code.required' => "Le code est requis",
        'marque_id.required' => "Le modele est requis",
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
    $libelle = $rData["libelle"];
    $code = $rData["code"];
    $marque = $rData["marque_id"];


     //do operation
    $result = $this->_operationService->updateBrand( $marque, $libelle, $code);
    if($result === false){
        return response()->json([
            'status' => "error",  'message' => "Une erreur est survenue lors de la modification d'une marque de véhicule.",
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

      /**
 * @OA\Post(
 *     path="/hanane/public/api/params/delete-brand",
 *     summary="delete brand",
 *     tags={"delete brand"},
 *     @OA\RequestBody(
 *         required=true,
 *         @OA\JsonContent(
 *             type="object",
 *             @OA\Property(property="marque_id", type="int", example=1),
 *         )
 *     ),
 *     @OA\Response(response="200", description="brand deleted"),
 *
 * )
 */
public function deleteBrand(Request $request){
    try{
        $rData =  $request->only([
            "marque_id"
        ]);
          //data validation
    $validator = [
        'marque_id' => ['required',"exists:marques,id"],
    ];

    $validationMessages = [
        'marque_id.required' => "L'identifiant de la marque est requis",
        'marque_id.exists' => "L'identifiant de la marque n'est pas valide",
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
    $marque_id = $rData["marque_id"];

     //do operation
    $result = $this->_operationService->deleteBrand($marque_id);
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


      /**
 * @OA\Post(
 *     path="/hanane/public/api/params/delete-model",
 *     summary="delete model",
 *     tags={"delete model"},
 *     @OA\RequestBody(
 *         required=true,
 *         @OA\JsonContent(
 *             type="object",
 *             @OA\Property(property="modele_id", type="int", example=1),
 *         )
 *     ),
 *     @OA\Response(response="200", description="model deleted"),
 *
 * )
 */
public function deleteModel(Request $request){
    try{
        $rData =  $request->only([
            "modele_id"
        ]);
          //data validation
    $validator = [
        'modele_id' => ['required',"exists:modeles,id"],
    ];

    $validationMessages = [
        'modele_id.required' => "L'identifiant du modele est requis",
        'modele_id.exists' => "L'identifiant du modele n'est pas valide",
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
    $modele_id = $rData["modele_id"];

     //do operation
    $result = $this->_operationService->deleteModel($modele_id);
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


 /**
 * @OA\Post(
 *     path="/hanane/public/api/offer/detail-vehicle",
 *     summary="detail vehicle",
 *     tags={"detail vehicle"},
 *     @OA\RequestBody(
 *         required=true,
 *         @OA\JsonContent(
 *             type="object",
 *             @OA\Property(property="vehicule_id", type="int", example=1),
 *         )
 *     ),
 *     @OA\Response(response="200", description="vehicle detail"),
 *
 * )
 */
   public function detailVehicle(Request $request){
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
