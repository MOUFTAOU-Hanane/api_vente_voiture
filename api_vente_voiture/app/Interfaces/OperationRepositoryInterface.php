<?php
namespace App\Interfaces;

interface OperationRepositoryInterface
{

    //listing marque
    public function getMarque();
    //listing modele
    public function getModele();
    //listing couleur
    public function getCouleur();
    //listing categorie vehicule
    public function getTypeVehicule();
    //save vehicule
    public function saveVehicule($type_vehicule, $marque ,  $annee , $modele);
    //update marque
    public function updateVehicule($id, $type_vehicule, $marque ,  $annee , $modele );
    //listing all vehicules
    public function getVehicules();
    //delete vehicule
    public function deleteVehicule($idVehicule);

    public function createModel($libelle, $code);
    public function createMarque($libelle, $code);
    public function createCategory($libelle, $code);
    public function detailVehicule($idVehicule);

}
