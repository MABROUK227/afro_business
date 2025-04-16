@extends('layouts.custom-layout')
@section('title', 'Accueil')

@section('header')
    @include('components.header')
@endsection

@section('content')
    <!DOCTYPE html>
    <html lang="fr">
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css">
            <link rel="stylesheet" href="css\filament\index.css">
        </head>
        <body>
            <div class="container">
                <div class="container mt-4">
                    <div class="row g-3">
                        <div class="col-md-8">
                            <div class="section-left">
                                <h2><span class="highlight">On vous accompagne</span></h2>
                                <div style=" font-weight: bold; font-size:32px; color: #050505;  ">
                                    <h3 class="lefty">Conseils, astuces ?</h3>
                                    <p style="background-color: rgba(211, 189, 189, 0.774)" >Nos conseils pour répondre à vos questions du quotidien</p>
                                </div>
                                <button class="btn btn" style="color: #f1f1f1">Je découvre</button>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="section-right text-center" style="height: 100%">
                                <h3>PROFESSIONNELS, RAPPROCHEZ-VOUS DE VOS CLIENTS !</h3>
                                <p> Référencer gratuitement votre entreprise en envoyant vos informations, vos publications et bien plus encore directement depuis notre plateforme</p>
                                <a href="{{ route('entreprise.entreprise') }}" class="btn btn-blue">Créer mon compte entreprise</a>
                            </div>
                        </div>
                    </div>
                </div>
                <br><br>
                <div class="main-container">
                    <div class="slider-container">
                        <div class="flex items-center case1">
                            <div ><img src="icon\entreprise.png" alt="" width="80px"></div>
                                <h3 class="relative"><strong>Entreprise mieux notée</strong></h3>
                                <div class="blue-underlinex"></div>
                        </div>  

                        <div>
                            <center>  <strong> Les annonces seront ajoutées dynamiquement </strong></center>
                        </div>
                    </div>
                </div>
                <br><br>

                <div class="main-container">
                    <div class="slider-container">
                        <div class="flex items-center case1">
                            <div ><div ><img src="icon\medecin.png" alt="" width="60px"></div></div>
                            <h3> <strong>Santé & médicale</strong></h3>
                        </div>  

                        <div class="swiper mySwiper">
                            <div class="swiper-wrapper">
                                @foreach($entreprises as $entreprise)
                                    @if($entreprise->id_categorie == 2) 
                                        @php
                                            $photos = json_decode($entreprise->photo, true);
                                        @endphp
                                        <div class="swiper-slide">
                                            @if(isset($photos['photo1']))
                                                <img src="{{ Storage::url($photos['photo1']) }}" alt="{{ $entreprise->nom }}" class="img-fluid">
                                            @endif
                                            
                                            <div class="carousel-title text-truncate w-100" style="max-width: 100%;">{{ $entreprise->nom }}</div>
                                            <div style="align-items: center; gap: 10px;">
                                                <div style="display: flex">
                                                    <div class="carousel-title adresse truncate-2-lines" style="max-width: 100%;">{{ $entreprise->adresse }}</div>
                                                </div>
                                                <div class="carousel-title adresse truncate-2-lines" style="max-width: 100%;">
                                                    @if ($entreprise->isOpen)
                                                        Actuellement :
                                                        <span style="color: green; font-size:13px"><strong>Ouvert</strong></span>
                                                    @else
                                                        Actuellement :
                                                        <span style="color: red;  font-size:13px"><strong>Fermé</strong></span>
                                                    @endif
                                                </div>

                                                <button class="voir-plus-btn">
                                                    <a class="lien" href="{{ route('entreprise.show', ['id' => $entreprise->id]) }}">Voir plus</a>
                                                </button>
                                            </div>                                                                            
                                        </div>
                                    @endif
                                @endforeach
                            </div>
                            <br><br>

                            <div class="swiper-pagination"></div>
                        </div>
                    </div>
                </div>
                <br><br>

                <div class="main-container">
                    <div class="slider-container">
                        <div class="flex items-center case1">
                            <div ><div ><img src="icon\appartement.png" alt="" width="40px"></div></div>
                            <h3> <strong>Appartement & Logements</strong></h3>
                        </div>  

                        <div class="swiper mySwiper">
                            <div class="swiper-wrapper">
                                @foreach($entreprises as $entreprise)
                                    @if($entreprise->id_categorie == 4) 
                                        @php
                                            $photos = json_decode($entreprise->photo, true);
                                        @endphp
                                        <div class="swiper-slide">
                                            @if(isset($photos['photo1']))
                                                <img src="{{ Storage::url($photos['photo1']) }}" alt="{{ $entreprise->nom }}" class="img-fluid">
                                            @endif
                                            
                                            <div class="carousel-title text-truncate w-100" style="max-width: 100%;">{{ $entreprise->nom }}</div>
                                            <div style="align-items: center; gap: 10px;">
                                                <div style="display: flex">
                                                    <div class="carousel-title adresse truncate-2-lines" style="max-width: 100%;">{{ $entreprise->adresse }}</div>
                                                </div>
                                                <div class="carousel-title adresse truncate-2-lines" style="max-width: 100%;">
                                                    @if ($entreprise->isOpen)
                                                    Actuellement :
                                                    <span style="color: green; font-size:13px">Ouvert</span>
                                                    @else
                                                    Actuellement :
                                                    <span style="color: red;  font-size:13px">Fermé</span>
                                                    @endif
                                                </div>

                                                <button class="voir-plus-btn">
                                                    <a class="lien" href="{{ route('entreprise.show', ['id' => $entreprise->id]) }}">Voir plus</a>
                                                </button>
                                            </div>                                                                            
                                        </div>
                                    @endif
                                @endforeach
                            </div>
                            <br><br>

                            <div class="swiper-pagination"></div>
                        </div>
                    </div>
                </div> <br><br>

                <div class="main-container">
                    <div class="slider-container">
                        <div class="flex items-center case1">
                            <div ><div ><img src="icon\vehicule.png" alt="" width="75px"></div></div>
                            <h3> <strong>Déplacements</strong></h3>
                        </div>  

                        <div class="swiper mySwiper">
                            <div class="swiper-wrapper">
                                @foreach($entreprises as $entreprise)
                                    @if($entreprise->id_categorie == 4) 
                                        @php
                                            $photos = json_decode($entreprise->photo, true);
                                        @endphp
                                        <div class="swiper-slide">
                                            @if(isset($photos['photo1']))
                                                <img src="{{ Storage::url($photos['photo1']) }}" alt="{{ $entreprise->nom }}" class="img-fluid">
                                            @endif
                                            
                                            <div class="carousel-title text-truncate w-100" style="max-width: 100%;">{{ $entreprise->nom }}</div>
                                            <div style="align-items: center; gap: 10px;">
                                                <div style="display: flex">
                                                    <div class="carousel-title adresse truncate-2-lines" style="max-width: 100%;">{{ $entreprise->adresse }}</div>
                                                </div>
                                                <div class="carousel-title adresse truncate-2-lines" style="max-width: 100%;">
                                                    @if ($entreprise->isOpen)
                                                        Actuellement :
                                                        <span style="color: green; font-size:13px">Ouvert</span>
                                                    @else
                                                        Actuellement :
                                                        <span style="color: red;  font-size:13px">Fermé</span>
                                                    @endif
                                                </div>

                                                <button class="voir-plus-btn">
                                                    <a class="lien" href="{{ route('entreprise.show', ['id' => $entreprise->id]) }}">Voir plus</a>
                                                </button>
                                            </div>                                                                            
                                        </div>
                                    @endif
                                @endforeach
                            </div><br><br>

                            <div class="swiper-pagination"></div>
                        </div>
                    </div>
                </div>
            </div>
            
            <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>

            <script>
                document.addEventListener("DOMContentLoaded", function() {
                    const entreprises = [
                        // Ajoute tes entreprises ici
                    ];

                    const swiperWrapper = document.querySelector(".swiper-wrapper");

                    entreprises.forEach(entreprise => {
                        const slide = document.createElement("div");
                        slide.classList.add("swiper-slide");

                        slide.innerHTML = `
                            <img src="${entreprise.img}" alt="${entreprise.name}">
                            <div class="text-truncate w-100" style="max-width: 100%;">${entreprise.name}</div>
                            <div class="carousel-text">${entreprise.desc}</div>
                            <button class="btn btn-primary">Y aller</button>
                        `;

                        swiperWrapper.appendChild(slide);
                    });

                    var swiper = new Swiper(".mySwiper", {
                        slidesPerView: 3,  
                        spaceBetween: 15,  
                        loop: true,        
                        // autoplay: {
                        //     delay: 3000,   
                        //     disableOnInteraction: true
                        // },
                        navigation: {
                            nextEl: ".swiper-button-next",
                            prevEl: ".swiper-button-prev"
                        },
                        pagination: {
                            el: ".swiper-pagination",
                            clickable: true
                        },
                        breakpoints: {
                            768: {  // Tablette et plus grand
                                slidesPerView: 3,
                                spaceBetween: 15
                            },
                            0: {  // Mobile
                                slidesPerView: 1,
                                spaceBetween: 10
                            }
                        }
                    });
                });
            </script>

            <div class="container text-center my-5">
                <h2 class="fw-bold">Avec Afrobiz, rencontrez la meilleur entreprise qu'il vous faut !</h2>
                <div class="row mt-4">
                    <div class="col-md-3">
                        <div class="feature-card">
                            <div class="d-flex justify-content-center align-items-center">
                                <svg xmlns="http://www.w3.org/2000/svg" width="50" height="50" fill="currentColor" class="bi bi-search mb-8" viewBox="0 0 16 16">
                                    <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001q.044.06.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1 1 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0"/>
                                </svg>
                            </div>
                            <h5 class="fw-bold" style="padding-top: 8%">La référence des pros au Canada</h5>
                            <p>95% des professionnels inscrits, partout au Canada</p>
                        </div>
                    </div> <br><br>

                    <div class="col-md-3">
                        <div class="feature-card">
                            <div class="d-flex justify-content-center align-items-center">
                                <svg xmlns="http://www.w3.org/2000/svg" width="50" height="50" fill="currentColor" class="bi bi-megaphone" viewBox="0 0 16 16">
                                    <path d="M13 2.5a1.5 1.5 0 0 1 3 0v11a1.5 1.5 0 0 1-3 0v-.214c-2.162-1.241-4.49-1.843-6.912-2.083l.405 2.712A1 1 0 0 1 5.51 15.1h-.548a1 1 0 0 1-.916-.599l-1.85-3.49-.202-.003A2.014 2.014 0 0 1 0 9V7a2.02 2.02 0 0 1 1.992-2.013 75 75 0 0 0 2.483-.075c3.043-.154 6.148-.849 8.525-2.199zm1 0v11a.5.5 0 0 0 1 0v-11a.5.5 0 0 0-1 0m-1 1.35c-2.344 1.205-5.209 1.842-8 2.033v4.233q.27.015.537.036c2.568.189 5.093.744 7.463 1.993zm-9 6.215v-4.13a95 95 0 0 1-1.992.052A1.02 1.02 0 0 0 1 7v2c0 .55.448 1.002 1.006 1.009A61 61 0 0 1 4 10.065m-.657.975 1.609 3.037.01.024h.548l-.002-.014-.443-2.966a68 68 0 0 0-1.722-.082z"/>
                                </svg>
                            </div>
                            <h5 class="fw-bold" style="padding-top: 8%">Les informations enrichies par les professionnels...</h5>
                            <p>Horaires, prestations, actus, coordonnées, itinéraire... 100 000 mises à jour quotidiennes</p>
                        </div>
                    </div><br><br><br>

                    <div class="col-md-3">
                        <div class="feature-card">
                            <div class="d-flex justify-content-center align-items-center">
                                <svg xmlns="http://www.w3.org/2000/svg" width="50" height="50" fill="currentColor" class="bi bi-star" viewBox="0 0 16 16">
                                    <path d="M2.866 14.85c-.078.444.36.791.746.593l4.39-2.256 4.389 2.256c.386.198.824-.149.746-.592l-.83-4.73 3.522-3.356c.33-.314.16-.888-.282-.95l-4.898-.696L8.465.792a.513.513 0 0 0-.927 0L5.354 5.12l-4.898.696c-.441.062-.612.636-.283.95l3.523 3.356-.83 4.73zm4.905-2.767-3.686 1.894.694-3.957a.56.56 0 0 0-.163-.505L1.71 6.745l4.052-.576a.53.53 0 0 0 .393-.288L8 2.223l1.847 3.658a.53.53 0 0 0 .393.288l4.052.575-2.906 2.77a.56.56 0 0 0-.163.506l.694 3.957-3.686-1.894a.5.5 0 0 0-.461 0z"/>
                                </svg>
                            </div>
                            <h5 class="fw-bold"  style="padding-top: 8%">Des recommandations pour décider</h5>
                            <p>18 M d’avis et notes des utilisateurs, photos, labels qualité, badges et certifications...</p>
                        </div>
                    </div><br><br><br>

                    <div class="col-md-3">
                        <div class="feature-card">
                            <div class="d-flex justify-content-center align-items-center">
                                <svg xmlns="http://www.w3.org/2000/svg" width="50" height="50" fill="currentColor" class="bi bi-laptop" viewBox="0 0 16 16">
                                    <path d="M13.5 3a.5.5 0 0 1 .5.5V11H2V3.5a.5.5 0 0 1 .5-.5zm-11-1A1.5 1.5 0 0 0 1 3.5V12h14V3.5A1.5 1.5 0 0 0 13.5 2zM0 12.5h16a1.5 1.5 0 0 1-1.5 1.5h-13A1.5 1.5 0 0 1 0 12.5"/>
                                </svg>
                            </div>
                            <h5 class="fw-bold" style="padding-top: 8%">Des services en ligne pour vous faciliter la vie</h5>
                            <p>Demande de devis, prise de rendez-vous, réservation, messagerie...</p>
                        </div>
                    </div><br><br><br>
                </div>
            </div>
        </body>
    </html>
@endsection

