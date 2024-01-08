@extends('layouts.app_admin')

@section('content_admin')
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header  text-center">
                        <h1>{{ __('Cambiar mi contraseña') }}</h1>
                </div>

                <div class="card-body">
                    <form method="POST" action="{{ route('cambiar_mi_password') }}">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <div class="form-group row">
                            <label for="contrasena" class="col-md-4 col-form-label text-md-right">Nueva Contraseña</label>
                            <div class="col-md-6">
                                <input type="password" name="contrasena" class="form-control">
                                @if ($errors->has('contrasena'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('contrasena') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="contrasena_confirmation" class="col-md-4 col-form-label text-md-right">Confirmar Contraseña</label>
                            <div class="col-md-6">
                                <input type="password" name="contrasena_confirmation" class="form-control">
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-dark btn-lg btn-block">
                                    <i class="far fa-edit"></i> {{ __('Cambiar') }}
                                </button>
                            </div>
                        </div>

                        <br>
                        <div class="form-group row ">
                            <label for="" class="col-md-4 col-form-label text-md-right"></label>
                            <div class="col-md-6 alert alert-danger">
                                <p class="font-weight-bold">Formato Obligatorio de Contrase&ntilde;a:</p>
                                <p>Debe tener:</p>
                                <ul>
                                    <li>8 caract&eacute;res m&iacute;nimo</li>
                                    <li>May&uacute;sculas</li>
                                    <li>Min&uacute;sculas</li>
                                    <li>N&uacute;meros</li>
                                    <li>S&iacute;mbolos</li>                                   
                                </ul>
                                <p class="font-weight-bold">Ej: Cambiar.9999</p>
                            </div>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
