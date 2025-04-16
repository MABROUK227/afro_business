@extends('layouts.custom-layout')

@section('title', 'Détail Entreprise')

@section('header')
    @include('components.header')
    <head>

        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    
        <style>
            body {
                background-color: #f4f4f4;
            }
            .profile-card {
                background: white;
                border-radius: 10px;
                box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1);
                overflow: hidden;
            }
            .cover-photo {
                background: url('{{ Storage::url(json_decode($entreprise->photo, true)['photo2'] ?? 'placeholder.jpg') }}') no-repeat center/cover;
                height: 200px;
            }
            .profile-picture {
                width: 100px;
                height: 100px;
                border-radius: 50%;
                border: 4px solid white;
                position: absolute;
                top: 130px;
                left: 20px;
            }
            .ads-section {
                background: white;
                border-radius: 10px;
                padding: 15px;
                box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1);
            }

            .dropdown-menu {
                z-index: 1050; 
                position: absolute;     
                min-width: 70vh;
            }

            .dropdown-menu .col-md-4 li {
                display: inline-block;
                margin-right: 10px;
            }
        </style>
    </head>
@endsection

@section('content')

<body>
    <div class="container mt-4">

        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert" id="success-alert">
                {{ session('success') }}
            </div>
        @endif

        @if(session('error'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                {{ session('error') }}
            </div>
        @endif

        <script>
            setTimeout(() => {
                let alert = document.getElementById("success-alert");
                if (alert) {
                    alert.style.transition = "opacity 0.5s";
                    alert.style.opacity = "0";
                    setTimeout(() => alert.remove(), 500);
                }
            }, 5000);
        </script>

        
        <div class="row">
            <!-- Section entreprise (75%) -->
            <div class="col-md-9">
                <div class="profile-card">
                    <div class="cover-photo position-relative">
                        <img src="{{ Storage::url(json_decode($entreprise->photo, true)['photo1'] ?? 'placeholder.jpg') }}" class="profile-picture" alt="Entreprise">
                    </div>
                    <div class="card-body" style="padding:4%; padding-top:8%;">
                        <h3>{{ $entreprise->nom }}</h3>
                        <div class="status fw-bold">
                            @if($isOpen)
                                <p class="text-success">L'entreprise est ouverte.</p>
                            @else
                                <p class="text-danger">L'entreprise est fermée.</p>
                            @endif
                        </div>
                        <div class="stars text-danger" >
                            <span class="text-danger" style="display: flex; gap:10px">  ★★★★★ (1 avis)  
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-chat" viewBox="0 0 16 16">
                                    <path d="M2.678 11.894a1 1 0 0 1 .287.801 11 11 0 0 1-.398 2c1.395-.323 2.247-.697 2.634-.893a1 1 0 0 1 .71-.074A8 8 0 0 0 8 14c3.996 0 7-2.807 7-6s-3.004-6-7-6-7 2.808-7 6c0 1.468.617 2.83 1.678 3.894m-.493 3.905a22 22 0 0 1-.713.129c-.2.032-.352-.176-.273-.362a10 10 0 0 0 .244-.637l.003-.01c.248-.72.45-1.548.524-2.319C.743 11.37 0 9.76 0 8c0-3.866 3.582-7 8-7s8 3.134 8 7-3.582 7-8 7a9 9 0 0 1-2.347-.306c-.52.263-1.639.742-3.468 1.105"/>
                                </svg>
                                <a href="#" id="write-review" data-bs-toggle="modal" data-bs-target="#avisModal">Écrivez un avis</a>
                            </span> 
                            <br>
                            <div class="modal fade" id="avisModal" tabindex="-1" aria-labelledby="avisModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title text-center" id="avisModalLabel">Donnez votre avis</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"  onclick="location.reload();"></button>
                                        </div>
                                        <div class="modal-body">
                                            <h6 style="color: black">{{ $entreprise->nom }}</h6>
                                            <p class="text-black">{{ $entreprise->adresse }}</p>
                            
                                            <!-- Formulaire -->
                                            <form action="{{ route('avis') }}" method="POST">
                                                @csrf
                                                <input type="hidden" name="entreprise_id" value="{{ $entreprise->id }}" required>
                                                <input type="hidden" name="note" id="selected-note">
                            
                                                <!-- Évaluation -->
                                                <label class="form-label">Évaluez votre expérience :</label>
                                                <div class="mb-3 d-flex align-items-center">
                                                    <div id="rating-stars">
                                                        <span class="star" data-value="1"><i class="far fa-star"></i></span>
                                                        <span class="star" data-value="2"><i class="far fa-star"></i></span>
                                                        <span class="star" data-value="3"><i class="far fa-star"></i></span>
                                                        <span class="star" data-value="4"><i class="far fa-star"></i></span>
                                                        <span class="star" data-value="5"><i class="far fa-star"></i></span>
                                                    </div>
                                                    <span id="rating-text" class="ms-2 text-black">Cliquez pour noter</span>
                                                </div>
                            
                                                <!-- Texte d'avis -->
                                                <div class="mb-3 text-black">
                                                    <label for="commentaire" class="form-label">Partagez votre expérience :</label>
                                                    <textarea class="form-control" name="commentaire" id="commentaire" rows="3" placeholder="Décrivez ici votre expérience..." required></textarea>
                                                </div>
                            
                                                <!-- Date -->
                                                <div class="mb-3 text-black">
                                                    <label for="dateExperience" class="form-label">Datez votre expérience :</label>
                                                    <input type="date" class="form-control" name="date_experience" id="dateExperience" required>
                                                    <script>
                                                        document.addEventListener("DOMContentLoaded", function () {
                                                            let today = new Date().toISOString().split("T")[0]; // Récupère la date du jour au format YYYY-MM-DD
                                                            document.getElementById("dateExperience").setAttribute("max", today);
                                                        });
                                                    </script>
                                                </div>
                                                <div style="display: flex; gap:25px">
                                                    <input type="checkbox" name="condition" id="condition" required>
                                                    <p style="font-size: 12px">
                                                        Le contenu de votre avis ne doit pas comporter de données à caractère personnel sensibles. <a href="">En savoir plus</a> 
                                                    </p>
                                                </div>
                            
                                                <div class="modal-footer text-black">
                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"  onclick="location.reload();">Fermer</button>
                                                    <button type="submit" class="btn btn-primary">Envoyer</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                            
                            <script>
                                document.addEventListener("DOMContentLoaded", function () {
                                    const stars = document.querySelectorAll("#rating-stars .star");
                                    const ratingText = document.getElementById("rating-text");
                                    const noteInput = document.getElementById("selected-note");
                                
                                    const ratingMessages = {
                                        1: "Pas content 😡",
                                        2: "Bof 😕",
                                        3: "Correct 🙂",
                                        4: "Bien 😀",
                                        5: "Excellent ! 😍"
                                    };
                                
                                    stars.forEach(star => {
                                        star.addEventListener("click", function () {
                                            let selectedRating = this.getAttribute("data-value");
                                            noteInput.value = selectedRating; 
                                            updateStars(selectedRating);
                                        });
                                    });
                                
                                    function updateStars(rating) {
                                        stars.forEach(star => {
                                            let value = star.getAttribute("data-value");
                                            star.innerHTML = value <= rating ? '<i class="fas fa-star"></i>' : '<i class="far fa-star"></i>';
                                        });
                                        ratingText.innerText = ratingMessages[rating] || "Cliquez pour noter";
                                    }
                                });
                            </script>
                            
                            <script>
                                document.addEventListener("DOMContentLoaded", function () {
                                    const writeReviewLink = document.getElementById("write-review");
                                
                                    writeReviewLink.addEventListener("click", function (event) {
                                        event.preventDefault(); 
                                        let userIsAuthenticated = {{ Auth::check() ? 'true' : 'false' }};
                                
                                        if (!userIsAuthenticated) {
                                            window.location.href = "{{ route('login') }}";
                                        } else {
                                            let modal = new bootstrap.Modal(document.getElementById('avisModal'));
                                            modal.show();
                                        }
                                    });
                                });
                            </script>                                 
                        </div>
                        <ul class="nav nav-tabs" id="entrepriseTabs">
                            <li class="nav-item">
                                <a class="nav-link active" id="presentation-tab" data-bs-toggle="tab" href="#presentation">Présentation</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="horaires-tab" data-bs-toggle="tab" href="#horaires">Horaires</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="avis-tab" data-bs-toggle="tab" href="#avis">Avis</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="contact-tab" data-bs-toggle="tab" href="#contact">Contact</a>
                            </li>
                        </ul>

                    <div class="tab-content mt-3">
                            <div class="tab-pane fade show active" id="presentation">
                                <div style="display: flex; width: 100%; ">
                                    <div>
                                        <svg xmlns="http://www.w3.org/2000/svg" width="15" height="28" fill="currentColor" class="bi bi-geo-alt-fill" viewBox="0 0 16 16">
                                            <path d="M8 16s6-5.686 6-10A6 6 0 0 0 2 6c0 4.314 6 10 6 10m0-7a3 3 0 1 1 0-6 3 3 0 0 1 0 6"/>
                                        </svg>
                                    </div>
                                    <div style="padding-left: 1%; font-size:20px">
                                        {{ $entreprise->adresse }}
                                    </div>
                                </div>
                                
                                <p style="padding-left: 1%; padding-top:3px">{{ $entreprise->description }}</p>
                                <p style="padding-left: 1%"><strong>Services :</strong> {{ $entreprise->services }}</p>
                            </div>
                            <div class="tab-pane fade" id="horaires" role="tabpanel">
                                <div class="opening-hours">
                                    <h3>Horaires d'ouverture</h3>
                                    <table>
                                        <thead style="background-color: #e68181;">
                                            <tr style="font-size: 24px">
                                                <th>Jours</th>
                                                <th>Heures</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($entreprise->horaires as $horaire)
                                                <tr style="background-color: #e7a7a7;">
                                                    <td style="border-bottom: 2px solid red; padding: 10px;">{{ $horaire->jour }}</td>
                                                    <td style="border-bottom: 2px solid red; padding: 10px;">
                                                        @if($horaire->ouverture == "00:00" && $horaire->fermeture == "00:00")
                                                            Non disponible
                                                        @else
                                                            {{ $horaire->ouverture }} - {{ $horaire->fermeture }}
                                                        @endif
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div> 
                            <div class="tab-pane fade" id="avis">
                                <p>Avis des clients récents :</p>

                                @if($entreprise->avis->count() > 0)
                                    @foreach($entreprise->avis as $avis)
                                        <div class="avis"> 
                                            <hr>
                                            <div style="display: flex; gap: 5px; font-size:12px">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-person" viewBox="0 0 16 16">
                                                    <path d="M8 8a3 3 0 1 0 0-6 3 3 0 0 0 0 6m2-3a2 2 0 1 1-4 0 2 2 0 0 1 4 0m4 8c0 1-1 1-1 1H3s-1 0-1-1 1-4 6-4 6 3 6 4m-1-.004c-.001-.246-.154-.986-.832-1.664C11.516 10.68 10.289 10 8 10s-3.516.68-4.168 1.332c-.678.678-.83 1.418-.832 1.664z"/>
                                                </svg>
                                                <strong>{{ $avis->user->name ?? 'Utilisateur anonyme' }}</strong>
                                                <p style="padding-left: 25px"> 
                                                    @if ($avis->note == 5)
                                                        ⭐⭐⭐⭐⭐
                                                    @endif
                                                    @if ($avis->note == 4)
                                                        ⭐⭐⭐⭐
                                                        @elseif($avis->note == 3)
                                                        ⭐⭐⭐
                                                        @elseif ($avis->note == 2)
                                                        ⭐⭐
                                                        @elseif ($avis->note == 1 )
                                                        ⭐
                                                    @endif
                                                </p>
                                            </div>
                                            <small class="text-danger ps-4">Posté le {{ $avis->created_at->format('d/m/Y') }}</small>
                                            <p class="ps-4">{{ $avis->commentaire }}</p>
                                        </div>
                                    @endforeach
                                @else
                                    <p>Aucun avis pour cette entreprise.</p>
                                @endif
                            </div>
                            <div class="tab-pane fade" id="contact">
                                <p>
                                    Envoyez un message ou téléphoner
                                </p>
                                <p><strong>Email :</strong> 
                                    <a href="mailto:{{ $entreprise->email }}">{{ $entreprise->email }}</a>
                                </p>
                                
                                <p><strong>Téléphone :</strong> 
                                    <a href="tel:{{ $entreprise->telephone }}">{{ $entreprise->telephone }}</a>
                                </p>
                            </div>
                        </div> 
                    </div>
                </div>
            </div>

            <div class="col-md-3">
                <div class="ads-section">
                    <h5>Publicités</h5>
                    <img src="{{ asset('images/ad-placeholder.jpg') }}" class="img-fluid rounded mb-2" alt="Pub">
                    <p>Annonce sponsorisée pour des services en relation avec {{ $entreprise->nom }}.</p>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>



@endsection