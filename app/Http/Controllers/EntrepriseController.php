<?php

namespace App\Http\Controllers;

use Log;
use create;
use DateTime;
use App\Models\Avis;
use App\Models\Horaire;
use App\Models\Categorie;
use App\Models\Entreprise;
use Illuminate\Http\Request;
use PhpParser\Node\Stmt\While_;

class EntrepriseController extends Controller
{
    public function create()
    {   
        $categories = Categorie::all();
        return view('entreprise.entreprise', compact('categories'));
    }

    public function store(Request $request)
    {
        // Validation des données
        // $request->validate([
        //     'nomEntreprise' => 'required|string|max:255',
        //     'description' => 'required|string|max:500',
        //     'adresse' => 'required|string|max:255',
        //     'telephone' => 'required|string|max:15',
        //     'email' => 'required|email|max:255',
        //     'site' => 'nullable|url|max:255',
        //     'facebook' => 'nullable|url|max:255',
        //     'linkedin' => 'nullable|url|max:255',
        //     'twitter' => 'nullable|url|max:255',
        //     'photo1' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        //     'photo2' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        //     'photo3' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        //     'presentation' => 'nullable|string|max:500',
        //     'services' => 'nullable|string|max:500',
        //     'categorie' => 'required|exists:categories,id',
        //     'horaire' => 'required|array',
        //     'horaire.*.ouverture' => 'nullable|date_format:H:i',
        //     'horaire.*.fermeture' => 'nullable|date_format:H:i',
        // ]);

        // Traitement des fichiers (photos)
        // dd($request->all());

        $photoPaths = [];
        foreach (['photo1', 'photo2', 'photo3'] as $photo) {
            if ($request->hasFile($photo)) {
                $photoPaths[$photo] = $request->file($photo)->store('photos', 'public');
            }
        }

        $entreprise = new Entreprise();
        $entreprise->nom = $request->nomEntreprise;
        $entreprise->description = $request->description;
        $entreprise->adresse = $request->adresse;
        $entreprise->telephone = $request->telephone;
        $entreprise->email = $request->email;
        $entreprise->site_web = $request->site;
        
        $reseauxSociaux = json_encode([
            'facebook' => $request->facebook,
            'linkedin' => $request->linkedin,
            'twitter' => $request->twitter,
        ]);
        $entreprise->reseaux_sociaux = $reseauxSociaux;
        
        $photos = json_encode([
            'photo1' => $photoPaths['photo1'] ?? null,
            'photo2' => $photoPaths['photo2'] ?? null,
            'photo3' => $photoPaths['photo3'] ?? null,
        ]);

        $entreprise->photo = $photos;
        $entreprise->presentation = $request->presentation;

        $entreprise->services = $request->services;
        $entreprise->id_categorie = $request->categorie;

        $entreprise->user_id = auth()->id();
        $entreprise->save();

        $jours = ['Lundi', 'Mardi', 'Mercredi', 'Jeudi', 'Vendredi', 'Samedi', 'Dimanche'];

        foreach ($jours as $jour) {

            $horaire = $request->horaire[$jour] ?? null;

            Horaire::create([
                'id_entreprise' => $entreprise->id,
                'jour' => $jour,
                'ouverture' => $horaire['ouverture'] ?? '00:00', 
                'fermeture' => $horaire['fermeture'] ?? '00:00', 
            ]);
        }

            return redirect()->route('entreprise.entreprise')->with('success', 'Entreprise ajoutée avec succès');
    }

    public function index()
    {
        $entreprises = Entreprise::all();
        $currentDateTime = new DateTime();
        $currentDay = $currentDateTime->format('l');

        // Conversion du jour en français
        $joursEnFrancais = [
            'Monday' => 'Lundi',
            'Tuesday' => 'Mardi',
            'Wednesday' => 'Mercredi',
            'Thursday' => 'Jeudi',
            'Friday' => 'Vendredi',
            'Saturday' => 'Samedi',
            'Sunday' => 'Dimanche',
        ];
        $currentDay = $joursEnFrancais[$currentDay];

        foreach ($entreprises as $entreprise) {
            $horaire = $entreprise->horaires()->where('jour', $currentDay)->first();
            $isOpen = false;

            if ($horaire) {
                // Vérifier si l'horaire est à "00:00" (cas "Non disponible")
                if ($horaire->ouverture == "00:00" && $horaire->fermeture == "00:00") {
                    $entreprise->isOpen = false;
                    continue; 
                }

                $dateToday = $currentDateTime->format('Y-m-d');
                $ouverture = new DateTime($dateToday . ' ' . $horaire->ouverture);
                $fermeture = new DateTime($dateToday . ' ' . $horaire->fermeture);

                if ($horaire->fermeture == "00:00") {
                    $fermeture->modify('+1 day');
                }
                if ($currentDateTime >= $ouverture && $currentDateTime <= $fermeture) {
                    $isOpen = true;
                }
            }
            $entreprise->isOpen = $isOpen;
        }

        return view('index', compact('entreprises'));
    }


    public function show($id)
    {
        $entreprise = Entreprise::with('avis')->findOrFail($id);
    
        $currentDateTime = new DateTime();
        $currentDay = $currentDateTime->format('l');
    
        $joursEnFrancais = [
            'Monday' => 'Lundi',
            'Tuesday' => 'Mardi',
            'Wednesday' => 'Mercredi',
            'Thursday' => 'Jeudi',
            'Friday' => 'Vendredi',
            'Saturday' => 'Samedi',
            'Sunday' => 'Dimanche',
        ];
        $currentDay = $joursEnFrancais[$currentDay];
    
        $horaire = $entreprise->horaires()->where('jour', $currentDay)->first();
        $isOpen = false;
    
        if ($horaire) {
            if ($horaire->ouverture == "00:00" && $horaire->fermeture == "00:00") {
                return view('entreprise.detailEntreprise', compact('entreprise'))->with('isOpen', false);
            }
    
            $dateToday = $currentDateTime->format('Y-m-d');
            $ouverture = new DateTime($dateToday . ' ' . $horaire->ouverture);
            $fermeture = new DateTime($dateToday . ' ' . $horaire->fermeture);
    
            if ($horaire->fermeture == "00:00") {
                $fermeture->modify('+1 day');
            }
    
            if ($currentDateTime >= $ouverture && $currentDateTime <= $fermeture) {
                $isOpen = true;
            }
        }
    
        return view('entreprise.detailEntreprise', compact('entreprise', 'isOpen'));
    }
    

    public function show_avis($id)
    {
        $entreprise = Entreprise::with('avis')->findOrFail($id);
        return view('detailEntreprise', compact('entreprise'));
    }

    public function rechercher(Request $request)
    {
        $categorie = $request->input('categorie');
        $adresse = $request->input('adresse');

        if (empty($categorie) && empty($adresse)) {
            return redirect()->back()->with('error', 'Veuillez entrer un critère de recherche.');
        }

        $query = Entreprise::query()->with('categorie');

        if (!empty($categorie)) {
            $query->whereHas('categorie', function ($q) use ($categorie) {
                $q->where('libelle', 'LIKE', "%$categorie%");
            });
        }

        if (!empty($adresse)) {
            $query->where('adresse', 'LIKE', "%$adresse%");
        }

        $entreprises = $query->paginate(2);

        $currentDateTime = new DateTime();
        $joursEnFrancais = [
            'Monday' => 'Lundi',
            'Tuesday' => 'Mardi',
            'Wednesday' => 'Mercredi', 
            'Thursday' => 'Jeudi',
            'Friday' => 'Vendredi',
            'Saturday' => 'Samedi',
            'Sunday' => 'Dimanche',
        ];
        $currentDay = $joursEnFrancais[$currentDateTime->format('l')];

        foreach ($entreprises as $entreprise) {
            $horaire = $entreprise->horaires()->where('jour', $currentDay)->first();
            $isOpen = false;

            if ($horaire) {
                $dateToday = $currentDateTime->format('Y-m-d');
                $ouverture = new DateTime($dateToday . ' ' . $horaire->ouverture);
                $fermeture = new DateTime($dateToday . ' ' . $horaire->fermeture);

                if ($horaire->fermeture == "00:00") {
                    $fermeture->modify('+1 day');
                }

                if ($currentDateTime >= $ouverture && $currentDateTime <= $fermeture) {
                    $isOpen = true;
                }
            }

            $entreprise->isOpen = $isOpen;
        }

        return view('entreprise.resultats-recherche', compact('entreprises'));
    }

    public function checkEmail(Request $request) {
        $exists = Entreprise::where('email', $request->value)->exists();
        return response()->json([
            'exists' => $exists,
            'message' => $exists ? 'Cet email est déjà utilisé.' : ''
        ]);
    }
    
    public function checkTelephone(Request $request) {
        $exists = Entreprise::where('telephone', $request->value)->exists();
        return response()->json([
            'exists' => $exists,
            'message' => $exists ? 'Ce numéro de téléphone est déjà utilisé.' : ''
        ]);
    }

}

