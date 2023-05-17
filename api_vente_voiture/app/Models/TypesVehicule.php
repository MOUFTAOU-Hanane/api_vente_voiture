<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class TypesVehicule
 * 
 * @property int $id
 * @property string $libelle
 * @property string $code
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * 
 * @property Collection|Vehicule[] $vehicules
 *
 * @package App\Models
 */
class TypesVehicule extends Model
{
	protected $table = 'types_vehicule';

	protected $fillable = [
		'libelle',
		'code'
	];

	public function vehicules()
	{
		return $this->hasMany(Vehicule::class, 'type_vehicule_id');
	}
}
