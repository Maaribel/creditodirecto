@extends('layouts.app_admin')

@section('content_admin')

<div class="container">
    <div class="row justify-content-center">
        @if(Auth::user()->U_cambiar_contrasena == 1)
        <div class="col-md-7">
                <h5 class="alert alert-danger font-weight-bold" align="center">POR FAVOR CAMBIAR CONTRASE&Ntilde;A EN {{ Auth::user()->U_nombres . ' ' . Auth::user()->U_apellidos }} > </h5>
        </div>
        @endif
        <br>
        <div class="col-md-8">
            <div class="card" style="opacity: .7;">
                <div class="card-body msj-bienvenida">
                    <h1>
                    BIENVENIDO AL SISTEMA
                    <br>DE
                    <br>CRÉDITO DIRECTO
                    </h1>
                </div>
            </div>
        </div>
    </div>
</div>
	
@endsection