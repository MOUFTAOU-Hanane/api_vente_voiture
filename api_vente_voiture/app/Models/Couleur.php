<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Couleur
 * 
 * @property int $id
 * @property string $libelle
 * @property string $code
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 *
 * @package App\Models
 */
class Couleur extends Model
{
	protected $table = 'couleurs';

	protected $fillable = [
		'libelle',
		'code'
	];
}
