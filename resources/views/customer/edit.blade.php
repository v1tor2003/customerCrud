@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card my-4" style="max-width: 500px; margin: 0 auto;">
                    <div class="card-header d-inline">
                        <h5>Editando Cliente... </h5> 
                        <a class="btn btn-primary float-end" href="{{url('customers')}}">Voltar</a>
                    </div>
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    <div class="card-body">
                        <form action="{{ route('customers.update', ['customer' => $customer->id]) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="card-header">
                                <h4>Informações Gerais:</h4>
                              </div>
                            <div class="mb-3">
                                <label for="name" class="form-label">Nome:</label>
                                <input value="{{ $customer->name }}" type="text" class="form-control" id="name" name="name" placeholder="Nome">
                            </div>
                            <div class="mb-3">
                                <label for="email" class="form-label">Email:</label>
                                <input value="{{ $customer->email }}" type="email" class="form-control" id="email" name="email" placeholder="cliente@exemplo.com">
                            </div>
                            <div class="mb-3">
                                <label for="phone" class="form-label">Telefone:</label>
                                <input value="{{ $customer->phone }} "type="tel" class="form-control" id="phone" maxlength="11" name="phone" placeholder="(XX) XXXX-XXXX">
                            </div>
                            <div class="mb-3">
                                <label for="avatar" class="form-label">Avatar:</label>
                                <input value="{{ $customer->avatar }}" type="file" class="form-control" id="avatar" name="avatar" placeholder="Escolha sua imagem">
                            </div>
                            <div class="card-header">
                                <h4>Endereço:</h4>
                            </div>
                            <div class="mb-3">
                                <label for="cep" class="form-label">Cep:</label>
                                <input value="{{ $customer->address->cep }}" onblur="findCep(this.value)" type="text" name="cep" maxlength="8" class="form-control" id="cep" placeholder="XXXXXXXX" >
                            </div>
                            <div class="mb-3">
                                <label for="state" class="form-label">Estado:</label>
                                <input value="{{ $customer->address->state }}" type="text" class="form-control" id="state" name="state" placeholder="Estado">
                            </div>
                            <div class="mb-3">
                              <label for="city" class="form-label">Cidade:</label>
                              <input value="{{ $customer->address->city }}" type="text" class="form-control" id="city" name="city" maxlength="11" placeholder="Cidade">
                            </div>
                            <div class="mb-3">
                                <label for="district" class="form-label">Bairro:</label>
                                <input value="{{ $customer->address->district }}" type="text" class="form-control" id="district" name="district" maxlength="11" placeholder="Bairro Exemplo">
                            </div>
                            <div class="mb-3">
                                <label for="street" class="form-label">Rua:</label>
                                <input value="{{ $customer->address->street }}" type="text" class="form-control" id="street" name="street" placeholder="Rua Exemplo">
                            </div>
                            <div class="mb-3">
                                <label for="number" class="form-label">Nº:</label>
                                <input value="{{ $customer->address->number }}" type="text" class="form-control" id="number" name="phone" placeholder="XX">
                            </div>
                            <button type="submit" class="btn btn-primary text-uppercase">Atualizar</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

<script src="{{ asset('js/cepInfoFiller.js') }}"></script>
