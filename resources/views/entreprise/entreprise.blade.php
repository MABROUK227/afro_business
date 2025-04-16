@extends('layouts.custom-layout')
@section('title', 'Inscription Entreprise')

@section('header')
    @include('components.header')
@endsection

@section('content')
<style>
    body {
        font-family: Arial, sans-serif !important;
        background: #f9f9f9;
        margin: 0;
        padding: 20px;
    }
</style>
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
                @if(session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif
                <div class="card" style="box-shadow: darkslategray">
                    <div class="card-header text-center">
                        <h3 class="mt-2"> <strong>INSCRIVEZ VOTRE ENTREPRISE</strong></h3>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('entreprise.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf

                            <div class="mb-3">
                                <label for="nomEntreprise" class="form-label">Nom de l'entreprise</label>
                                <input type="text" class="form-control" id="nomEntreprise" name="nomEntreprise" required placeholder="Entrer le nom de votre entreprise"> 
                            </div>

                            <div class="mb-3">
                                <label for="description" class="form-label">Description</label>
                                <textarea class="form-control" id="description" name="description" rows="3" required placeholder="Entrer une description pour votre entreprise"></textarea>
                            </div>

                            <div class="mb-3">
                                <label for="adresse" class="form-label">Adresse</label>
                                <input type="text" class="form-control" id="adresse" name="adresse" required placeholder="Entrer l'adresse de votre entreprise">
                            </div>

                            <div class="mb-3">
                                <label for="telephone" class="form-label">Téléphone</label>
                                <input type="text" class="form-control" id="telephone" name="telephone" required placeholder="Entrer le numéro de Telephone">
                                <p id="telephone-error" class="text-danger"></p>
                            </div>

                            <div class="mb-3">
                                <label for="email" class="form-label">Email</label>
                                <input type="email" class="form-control" id="email" name="email" required placeholder="Entrer le mail">
                                <p id="email-error" class="text-danger"></p>
                            </div>

                            <div class="mb-3">
                                <label for="site" class="form-label">Site Web</label>
                                <input type="text" class="form-control" id="site" name="site" placeholder="Entrer le site de votre entreprise">
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Réseaux sociaux</label>
                                <input type="text" class="form-control mb-2" id="facebook" name="facebook" placeholder="Lien Facebook">
                                <input type="text" class="form-control mb-2" id="linkedin" name="linkedin" placeholder="Lien LinkedIn">
                                <input type="text" class="form-control mb-2" id="twitter" name="twitter" placeholder="Lien Twitter">
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Ajouter des photos</label>
                                <input type="file" class="form-control mb-2" name="photo1">
                                <input type="file" class="form-control mb-2" name="photo2">
                                <input type="file" class="form-control mb-2" name="photo3">
                            </div>

                            <div class="mb-3">
                                <label for="presentation" class="form-label">Présentation</label>
                                <input type="text" class="form-control" id="presentation" name="presentation" placeholder="Saisissez une présentation">
                            </div>

                            <div class="mb-3">
                                <label for="services" class="form-label">Services</label>
                                <input type="text" class="form-control" id="services" name="services" placeholder=" Entrer vos services ">
                            </div>

                            <div class="mb-3">
                                <label for="categorie">Catégorie:</label><br><br>
                                <select name="categorie" class="form-control" id="categorie" required>
                                    <option value="">Selectionnez la catégorie de votre entreprise</option>
                                    @foreach($categories as $categorie)
                                        <option value="{{ $categorie->id }}">{{ $categorie->libelle }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Jours et horaires d'ouverture</label>
                                <div class="row">
                                    @foreach(['Lundi', 'Mardi', 'Mercredi', 'Jeudi', 'Vendredi', 'Samedi', 'Dimanche'] as $jour)
                                        <div class="col-12 col-md-6 mb-2">
                                            <div class="d-flex justify-content-between">
                                                <!-- Jour -->
                                                <div class="d-flex align-items-center" style="flex: 1;">
                                                    <label class="me-1 w-100 text-center">{{ $jour }}</label>
                                                </div>
                            
                                                <!-- Ouverture -->
                                                <div class="d-flex align-items-center mx-2" style="flex: 1;">
                                                    <input type="time" class="form-control" name="horaire[{{ $jour }}][ouverture]" style="width: 100%;" id="ouverture-{{ $jour }}">
                                                </div>
                            
                                                <!-- Fermeture -->
                                                <div class="d-flex align-items-center mx-2" style="flex: 1;">
                                                    <input type="time" class="form-control" name="horaire[{{ $jour }}][fermeture]" style="width: 100%;" id="fermeture-{{ $jour }}">
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                            
                            <script>
                                document.addEventListener('DOMContentLoaded', function () {
                                    @foreach(['Lundi', 'Mardi', 'Mercredi', 'Jeudi', 'Vendredi', 'Samedi', 'Dimanche'] as $jour)
                                        const ouverture = document.getElementById('ouverture-{{ $jour }}');
                                        const fermeture = document.getElementById('fermeture-{{ $jour }}');
                            
                                        ouverture.addEventListener('input', function () {
                                            if (ouverture.value === fermeture.value) {
                                                alert("L'heure d'ouverture et de fermeture ne peuvent pas être identiques pour {{ $jour }}.");
                                                fermeture.setCustomValidity("L'heure d'ouverture et de fermeture ne peuvent pas être identiques.");
                                            } else {
                                                fermeture.setCustomValidity(""); // Si les heures sont différentes, on supprime l'alerte
                                            }
                                        });
                            
                                        fermeture.addEventListener('input', function () {
                                            if (ouverture.value === fermeture.value) {
                                                alert("L'heure d'ouverture et de fermeture ne peuvent pas être identiques pour {{ $jour }}.");
                                                ouverture.setCustomValidity("L'heure d'ouverture et de fermeture ne peuvent pas être identiques.");
                                            } else {
                                                ouverture.setCustomValidity(""); // Si les heures sont différentes, on supprime l'alerte
                                            }
                                        });
                                    @endforeach
                                });
                            </script>
                            <button type="submit" class="btn btn-primary" id="submit-btn">Enregistrer l'entreprise</button>
                            <p id="email-error" class="text-danger"></p>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <script>
            $(document).ready(function(){
                function checkField(field, route, errorElement, inputElement) {
                    var value = $(inputElement).val();
                    $.ajax({
                        url: route,
                        method: 'POST',
                        data: {
                            value: value,
                            _token: '{{ csrf_token() }}'
                        },
                        success: function(response){
                            if(response.exists){
                                $(inputElement).addClass('is-invalid');
                                $(errorElement).text(response.message);
                                $('#submit-btn').prop('disabled', true);
                            } else {
                                $(inputElement).removeClass('is-invalid');
                                $(errorElement).text('');
                                checkIfAllValid();
                            }
                        }
                    });
                }

                function checkIfAllValid() {
                    if (!$('#email').hasClass('is-invalid') && !$('#telephone').hasClass('is-invalid')) {
                        $('#submit-btn').prop('disabled', false);
                    }
                }

                $('#email').on('blur', function(){
                    checkField('email', '{{ route("check.email.entreprise") }}', '#email-error', '#email');
                });

                $('#telephone').on('blur', function(){
                    checkField('telephone', '{{ route("check.telephone.entreprise") }}', '#telephone-error', '#telephone');
                });
            });
        </script>
    </div>
@endsection
