<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Marque
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
class Marque extends Model
{
	protected $table = 'marques';

	protected $fillable = [
		'libelle',
		'code'
	];

	public function vehicules()
	{
		return $this->hasMany(Vehicule::class);
	}
}
