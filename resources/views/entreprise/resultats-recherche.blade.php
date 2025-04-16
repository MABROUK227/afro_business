@extends('layouts.custom-layout')

@section('title', 'Resultats- Recherche Entreprise')

@section('header')
    @include('components.header')
@endsection

@section('content')
<style>
    .swiper-slide {
        width: 100% !important; 
        display: flex !important;
        justify-content: center !important;
    }

    .custom-card {
        max-width: 600px; 
        width: 100%; 
    }

    .custom-card img {
        object-fit: cover;
        min-height: 200px;
        max-height: 250px;
    }
</style>

<div class="container bg-light py-5">
    <h4 class="text-center mb-4" style="display: flex; justify-content:center">
        <img src="icon/recherche.png" alt="" width="30px">
        <strong><u>Résultats de Recherche</u></strong>
    </h4> 

    <div class="container">
        <div class="row justify-content-center">
            @if($entreprises->count() > 0)
                <div class="col-12">
                    <div class="swiper mySwiper">
                        <div class="swiper-wrapper">
                            @foreach($entreprises as $entreprise)
                                @php
                                    $photos = json_decode($entreprise->photo, true);
                                @endphp
                                <div class="swiper-slide">
                                    
                                    <div class="row g-0 shadow-lg bg-white rounded overflow-hidden custom-card">
                                        <!-- Image -->
                                        <div class="col-md-4">
                                            @if(isset($photos['photo1']))
                                                <img src="{{ Storage::url($photos['photo1']) }}" alt="{{ $entreprise->nom }}" 
                                                     class="img-fluid w-100 custom-card-img">
                                            @endif
                                        </div>

                                        <!-- Infos -->
                                        <div class="col-md-8 d-flex flex-column justify-content-center p-3">
                                            <h5 class="text-truncate">{{ $entreprise->nom }}</h5>
                                            <p class="text-muted text-truncate">{{ $entreprise->adresse }}</p>
                                            <a href="{{ route('entreprise.show', $entreprise->id) }}" 
                                               class="btn  btn-sm w-25">
                                                Voir plus
                                            </a>
                                            <span class="badge mt-2 w-25 {{ $entreprise->isOpen ? 'bg-success' : 'bg-danger' }}">
                                                {{ $entreprise->isOpen ? 'Ouvert' : 'Fermé' }}
                                            </span>
                                        </div>
                                    </div>

                                </div> <br>
                            @endforeach 
                        </div>
                        <div class="swiper-pagination"></div>
                    </div>
                </div>
            @else
                <div style="width: 40%; height: 20vh; display: flex; align-items: center; justify-content: center;">
                    <img src="https://www.icone-gif.com/gif/ecole/loupe/loupes004.gif" alt="" style="width: 40%; height: auto;">
                </div>

                <h3 class="text-center w-100 text-danger"><strong>Aucune entreprise trouvée.</strong></h3>                
            @endif
    
            <div class="col-12 d-flex justify-content-center mt-4">
                {{ $entreprises->hasPages() ? $entreprises->appends(request()->query())->links() : '' }}
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
<script>
    document.addEventListener("DOMContentLoaded", function() {
        var swiper = new Swiper(".mySwiper", {
            slidesPerView: 1, 
            spaceBetween: 20,
            loop: false,
            navigation: {
                nextEl: ".swiper-button-next",
                prevEl: ".swiper-button-prev"
            },
            pagination: {
                el: ".swiper-pagination",
                clickable: true
            },
            breakpoints: {
                768: { slidesPerView: 2 }, 
                1024: { slidesPerView: 3 } 
            }
        });
    });
</script>

@endsection



