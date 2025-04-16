<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" integrity="sha512-..." crossorigin="anonymous" />
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css\filament\header.css') }}" rel="stylesheet">
</head>
<body>
    <nav class="navbar navbar-expand-lg bg-white shadow-sm">
        <div class="container">
            <a class="navbar-brand fw-bold" href="{{ route("index") }}">
                <img src="{{ asset('icon\logo-afrobiz-fin.png')}} " alt="AfroBiz" width="150px">
            </a>

            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>

            <!-- Menu -->
            <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link text-dark" href="{{ route('index') }}" role="button">
                            Accueil
                        </a>
                    </li>

                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle text-dark" href="#" role="button" data-bs-toggle="dropdown">
                            Catégorie
                        </a>
                        
                        <ul class="dropdown-menu dropdown-large p-3">
                            <div class="row"> 
                                @foreach($categories as $index => $categorie)
                                    <div class="col-md-4">
                                        <li class="mb-2"> 
                                            <a class="dropdown-item p-2" href="{{ route('resultats-recherche', ['categorie' => $categorie->libelle]) }}">
                                                {{ $categorie->libelle }}
                                            </a>
                                        </li>
                                    </div>
                                    @if(($index + 1) % 3 === 0)
                                        <div class="w-100"></div> 
                                    @endif
                                @endforeach
                            </div>
                        </ul>
                    </li>
                    
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle text-dark" href="#" role="button" data-bs-toggle="dropdown">
                            Abonnement
                        </a> 
                    </li>

                    <li class="nav-item" id="navItem">
                        <a class="nav-link" href="#" onclick="toggleMenu()" >
                            <i class="fa-solid fa-face-smile account-icon" style=" font-size: 25px;  color: rgb(3, 0, 0)"> </i>
                        </a>
                        <div class="menu" id="menu" style="width: 20%">
                            <div style="margin-left: -10px">
                                <a href="{{ route('register') }}">Créer un compte</a>
                            </div>
                            <div style="margin-left: -10px">
                                <a href="{{ route('entreprise.entreprise') }}">Se connecter</a>
                            </div>
                            <hr>
                            <p style="font-size: 14px;  ">
                                Vous avez une entreprise ? Créez un compte pour être référencé sur notre site.
                            </p>
                        </div>
                    </li>

                    <li class="nav-item" id="navItem">
                        <a class="nav-link" style=" background-color: rgb(141, 31, 31); border-radius: 50px; font-size:14px; color : white; border: 1px solid rgb(141, 31, 31); margin-left: 25px" href="{{ route('entreprise.entreprise') }}" onclick="toggleMenu()" >
                            Se référencer
                        </a>
                        <div class="menu" id="menu" style="width: 20%">
                            <div style="margin-left: -10px">
                                <a href="{{ route('entreprise.entreprise') }}">Créer un compte</a>
                            </div>
                            <hr>
                            <p style="font-size: 14px;  ">
                                Vous avez une entreprise ? Créez un compte pour être référencé sur notre site.
                            </p>
                        </div>
                    </li>

                    @if(Auth::check())
                        <li class="nav-item" id="navItem">
                            <form action="{{ route('logout') }}" method="POST">
                                @csrf
                                <button type="submit" style="color: red"> 
                                    <svg xmlns="http://www.w3.org/2000/svg" width="30" height="25" fill="currentColor" class="bi bi-power" viewBox="0 0 16 16">
                                        <path d="M7.5 1v7h1V1z"/>
                                        <path d="M3 8.812a5 5 0 0 1 2.578-4.375l-.485-.874A6 6 0 1 0 11 3.616l-.501.865A5 5 0 1 1 3 8.812"/>
                                    </svg>
                                </button>
                            </form>
                        </li>
                    @endif
                </ul>
            </div>
        </div>
    </nav>

    <div style="margin-top: 2%">
        <form action="{{ route('resultats-recherche') }}" method="GET">
            @csrf
            <div class="d-flex bg-white shadow rounded-pill overflow-hidden align-items-center justify-content-between px-2 py-1 mx-auto" style="width: 80%; min-height: 50px;">
                <div class="d-flex align-items-center px-3 border-end flex-grow-1">
                    <i class="bi bi-search text-secondary"></i>
                    <input type="text" name="categorie" class="form-control border-0 shadow-none" placeholder="Rechercher domaine d'activité..." style="flex: 1;">
                </div>
            
                <div class="d-flex align-items-center px-3 flex-grow-1">
                    <input type="text" name="adresse" class="form-control border-0 shadow-none" placeholder="Entrez adresse..." style="flex: 1;">
                </div>
                
                <button type="submit" class="btn d-flex align-items-center justify-content-center" style="background-color: rgb(15, 15, 15); color: white; border-radius: 0px 50px 50px 0px; width: 50px; height: 50px;">
                    <svg xmlns="http://www.w3.org/2000/svg" width="80" height="60" fill="currentColor" class="bi bi-search" viewBox="0 0 16 16">
                        <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001q.044.06.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1 1 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0"/>
                    </svg></svg>                      
                </button>
            </div>
        </form>
    </div>

    <div class="icons-container">
        <a href="{{ route('resultats-recherche', ['categorie' => 'Beaute']) }}" class="icon-box">
            <img src="{{ asset('icon/beauty1.png') }}" alt="Icône" width="60px">
            <p class="dropdown-item p-2">Beauté</p>
        </a>
        <a href="{{ route('resultats-recherche', ['categorie' => 'Restaurant']) }}" class="icon-box">
            <img src="{{ asset('icon/house.png') }}" alt="Icône" width="60px">
            <p class="dropdown-item p-2">Restaurant</p>
        </a>
        <a href="{{ route('resultats-recherche', ['categorie' => 'Plombier']) }}" class="icon-box">
            <img src="{{ asset('icon/robinet.png') }}" alt="Icône" width="60px">
            <p class="dropdown-item p-2">Plombier</p>
        </a>
        <a href="{{ route('resultats-recherche', ['categorie' => 'Comptable']) }}" class="icon-box">
            <img src="{{ asset('icon/calculate.png') }}" alt="Icône" width="60px">
            <p class="dropdown-item p-2">Comptable</p>
        </a>
        <a href="{{ route('resultats-recherche', ['categorie' => 'Mecanique']) }}" class="icon-box">
            <img src="{{ asset('icon/mecanique.png') }}" alt="Icône" width="60px">
            <p class="dropdown-item p-2">Mecanique</p>
        </a>
        <a href="{{ route('resultats-recherche', ['categorie' => 'Pharmacie']) }}" class="icon-box">
            <img src="{{ asset('icon/pharmacie.png') }}" alt="Icône" width="60px">
            <p class="dropdown-item p-2">Pharmacie</p>
        </a>
        <a href="{{ route('resultats-recherche', ['categorie' => 'Notaire']) }}" class="icon-box">
            <img src="{{ asset('icon/notaire.png') }}" alt="Icône" width="60px">
            <p class="dropdown-item p-2">Notaire</p>
        </a>
        <a href="{{ route('resultats-recherche', ['categorie' => 'Electricien']) }}" class="icon-box">
                <img src="{{ asset('icon/electricien.png') }}" alt="Icône" width="60px">
            <p class="dropdown-item p-2">Electricien</p>
        </a>
    </div>
    
    <script>
        function toggleMenu() {
            var menu = document.getElementById("menu");
            var navItem = document.getElementById("navItem"); 

            if (menu.style.display === "block") {
                menu.style.display = "none";  
                navItem.classList.remove('active');  
            } else {
                menu.style.display = "block"; 
                navItem.classList.add('active');
            }
        }

        document.addEventListener("click", function(event) {
            var menu = document.getElementById("menu");
            var icon = document.querySelector(".account-icon");
            var navItem = document.getElementById("navItem"); 

            if (!menu.contains(event.target) && !icon.contains(event.target) && !navItem.contains(event.target)) {
                menu.style.display = "none"; 

                navItem.classList.remove('active'); 

            }
        });
    </script>
    </div>

</body>
</html>
