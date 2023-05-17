<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Vehicule
 * 
 * @property int $id
 * @property int $marque_id
 * @property int $type_vehicule_id
 * @property int $modele_id
 * @property int $annee
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * 
 * @property Marque $marque
 * @property Modele $modele
 * @property TypesVehicule $types_vehicule
 *
 * @package App\Models
 */
class Vehicule extends Model
{
	protected $table = 'vehicules';

	protected $casts = [
		'marque_id' => 'int',
		'type_vehicule_id' => 'int',
		'modele_id' => 'int',
		'annee' => 'int'
	];

	protected $fillable = [
		'marque_id',
		'type_vehicule_id',
		'modele_id',
		'annee'
	];

	public function marque()
	{
		return $this->belongsTo(Marque::class);
	}

	public function modele()
	{
		return $this->belongsTo(Modele::class);
	}

	public function types_vehicule()
	{
		return $this->belongsTo(TypesVehicule::class, 'type_vehicule_id');
	}
}
