<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Entreprise extends Model
{
    use HasFactory;

    protected $table = 'entreprises';

    protected $fillable = [
        'nom',
        'description',
        'adress',
        'telephone',
        'email',
        'site_web',
        'Réseaux_sociaux',
        'photo',
        'presentation',
        'services',
        'id_categorie',
        'user_id',  // Ajoute le user_id ici
    ];

    public function categorie()
    {
        return $this->belongsTo(Categorie::class, 'id_categorie');
    }

    public function horaires()
    {
        return $this->hasMany(Horaire::class, 'id_entreprise');
    }

    public function avis()
    {
        return $this->hasMany(Avis::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
