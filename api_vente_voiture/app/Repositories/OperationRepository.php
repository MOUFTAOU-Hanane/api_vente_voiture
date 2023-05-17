<?php
namespace App\Repositories;
use App\Interfaces\OperationRepositoryInterface;
use Exception;
use App\Models\Marque;
use App\Models\Couleur;
use App\Models\Modele;
use App\Models\TypesVehicule;
use App\Models\Vehicule;


class OperationRepository implements OperationRepositoryInterface
{

    //listing marque
    public function getMarque(){
        try{
            $marques =Marque::all();
            return $marques;

        }catch(Exception $ex){
            throw new Exception($ex);
        }

    }
    //listing modele
    public function getModele(){
        try{
            $modeles =Modele::all();
            return $modeles;

        }catch(Exception $ex){
            throw new Exception($ex);
        }

    }
    //listing couleur vehicule
    public function getCouleur(){
        try{
            $couleurs =Couleur::all();
            return $couleurs;

        }catch(Exception $ex){
            throw new Exception($ex);
        }

    }
    //listing categorie vehicule
    public function getTypeVehicule(){
        try{
            $typeVehicule =TypesVehicule::all();
            return $typeVehicule;

        }catch(Exception $ex){
            throw new Exception($ex);
        }

    }

     // save vehicule
    public function saveVehicule($type_vehicule, $marque ,  $annee , $modele ){
        try{
            $vehicule =new Vehicule();
            $vehicule ->type_vehicule_id =$type_vehicule;
            $vehicule ->marque_id = $marque;
            $vehicule ->annee = $annee;
            $vehicule ->modele_id = $modele;
            $vehicule ->save();
            return true;

        }catch(Exception $ex){
            throw new Exception($ex);
        }

}

//listing all vehicule
public function getVehicules(){
    try{
        $vehicules =Vehicule::with('modele', 'marque', 'types_vehicule') ->get();
        return $vehicules;

    }catch(Exception $ex){
        throw new Exception($ex);
    }

}

//update  vehicule
public function updateVehicule($id, $type_vehicule, $marque ,  $annee , $modele ){
    try{
        $vehiculeFound = Vehicule::where('id','=',$id) ->first();
        $vehiculeFound ->type_vehicule_id =$type_vehicule;
        $vehiculeFound ->marque_id = $marque;
        $vehiculeFound ->annee = $annee;
        $vehiculeFound ->modele_id = $modele;
        $vehiculeFound ->save();

        return true;

    }catch(Exception $ex){
        throw new Exception($ex);
    }

}
}
