<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Avis;
use App\Models\Entreprise;
use Illuminate\Support\Facades\Auth;

class AvisController extends Controller
{
    public function store(Request $request)
    {
        if (!Auth::check()) {
            return back()->with('error', 'Vous devez être connecté pour laisser un avis.');
        }
    
        $request->validate([
            'entreprise_id' => 'required|exists:entreprises,id',
            'note' => 'required|integer|min:1|max:5',
            'commentaire' => 'nullable|string',
            'date_experience' => 'nullable|date',
        ]);
        
        
        
        
        Avis::create([
            'user_id' => Auth::id(),
            'entreprise_id' => $request->entreprise_id,
            'note' => $request->note,
            'commentaire' => $request->commentaire,
            'date_experience' => $request->date_experience,
        ]);
    
        return back()->with('success', 'Avis enregistré avec succès !');
    }
    

  
}
