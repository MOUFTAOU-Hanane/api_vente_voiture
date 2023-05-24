<?php

namespace App\Services;
use Exception;


use App\Repositories\OperationRepository;

class OperationService
{
    protected OperationRepository $_operationRepository;
    public function __construct(OperationRepository $operationRepository ){
     $this->_operationRepository = $operationRepository;}
    //

     //listing marque
    public function getMarque(){
        try{
            return  $this->_operationRepository->getMarque();

        }catch(Exception $ex){
            throw new Exception($ex);
        }

    }

     //listing modele
    public function getModele(){
        try{
            return  $this->_operationRepository->getModele();

        }catch(Exception $ex){
            throw new Exception($ex);
        }

    }

    //listing categorie vehicule
    public function getTypeVehicule(){
        try{
            return  $this->_operationRepository->getTypeVehicule();

        }catch(Exception $ex){
            throw new Exception($ex);
        }

    }

     //listing couleur vehicule
    public function getCouleur(){
        try{
            return  $this->_operationRepository->getCouleur();

        }catch(Exception $ex){
            throw new Exception($ex);
        }

    }

     //lsave vehicule
    public function saveVehicule($type_vehicule, $marque ,  $annee , $modele ){
        try{
            return  $this->_operationRepository->saveVehicule($type_vehicule, $marque ,  $annee , $modele);

        }catch(Exception $ex){
            throw new Exception($ex);
        }

    }

     //update vehicule
    public function updateVehicule($idVehicule, $type_vehicule, $marque ,  $annee , $modele ){
        try{
            return  $this->_operationRepository->updateVehicule($idVehicule, $type_vehicule, $marque, $annee, $modele );

        }catch(Exception $ex){
            throw new Exception($ex);
        }

    }

     //listing all vehicule
    public function getVehicules(){
        try{
            return  $this->_operationRepository->getVehicules();

        }catch(Exception $ex){
            throw new Exception($ex);
        }

    }

    public function deleteVehicule($idVehicule){
        try{
            return  $this->_operationRepository->deleteVehicule($idVehicule);

        }catch(Exception $ex){
            throw new Exception($ex);
        }

    }

    public function createModel($libelle, $code){
        try{
            return  $this->_operationRepository->createModel($libelle, $code);

        }catch(Exception $ex){
            throw new Exception($ex);
        }

    }

    public function createMarque($libelle, $code){
        try{
            return  $this->_operationRepository->createMarque($libelle, $code);

        }catch(Exception $ex){
            throw new Exception($ex);
        }

    }

    public function createCategory($libelle, $code){
        try{
            return  $this->_operationRepository->createCategory($libelle, $code);

        }catch(Exception $ex){
            throw new Exception($ex);
        }

    }


    public function detailVehicule($idVehicule){
        try{
            return  $this->_operationRepository->detailVehicule($idVehicule);

        }catch(Exception $ex){
            throw new Exception($ex);
        }

    }
}
