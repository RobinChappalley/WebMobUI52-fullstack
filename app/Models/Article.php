<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Article extends Model
{
    use HasFactory;

    // Les colonnes qui peuvent être assignées en masse (mass assignment)
    protected $fillable = [
        'name',
        'type',
        'brand',
        'state',
        'description'
    ];


    protected $casts = [
        'state' => 'string', // ou tu peux le virer, car enum string
    ];

    /**
     * Un article peut avoir plusieurs prêts (loans)
     */
    public function loans()
    {
        return $this->hasMany(Loan::class);
    }

    /**
     * Le prêt en cours (non rendu)
     * - Retourne le premier prêt où "returned_at" est null, ou null s'il n'y en a pas
     */
    public function currentLoan()
    {
        return $this->hasOne(Loan::class)->whereNull('returned_at');
        // on retourne la relation, pas l'objet, pour pouvoir l'utiliser avec "with"
    }
}
