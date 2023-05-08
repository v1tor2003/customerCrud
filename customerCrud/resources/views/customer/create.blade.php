@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card my-4" style="max-width: 500px; margin: 0 auto;">
                    <div class="card-header">
                      <h4>Informações Gerais 
                          <a class="btn btn-primary float-end" href="{{url('customers')}}">Back</a>
                      </h4>
                    </div>
                    <div class="card-body">
                        <form>
                            <div class="mb-3">
                                <label for="name" class="form-label">Nome:</label>
                                <input type="text" class="form-control" id="name" placeholder="Nome">
                            </div>
                            <div class="mb-3">
                                <label for="email" class="form-label">Email:</label>
                                <input type="email" class="form-control" id="email" placeholder="cliente@exemplo.com">
                            </div>
                            <div class="mb-3">
                                <label for="phone" class="form-label">Telefone:</label>
                                <input type="tel" class="form-control" id="phone" maxlength="11" placeholder="(XX) XXXX-XXXX">
                            </div>
                            <div class="mb-3">
                                <label for="avatar" class="form-label">Avatar:</label>
                                <input type="file" class="form-control" id="avatar" placeholder="Escolha sua imagem">
                            </div>
                        </form>
                    </div>
                    <div class="card-header">
                        <h4>Endereço </h4>
                    </div>
                    <div class="card-body">
                        <form>
                            <div class="mb-3">
                                <label for="cep" class="form-label">Cep:</label>
                                <input onblur="findCep(this.value)" type="text" name="cep" maxlength="8" class="form-control" id="cep" placeholder="XXXXXXXX" >
                            </div>
                            <div class="mb-3">
                                <label for="state" class="form-label">Estado:</label>
                                <input type="text" class="form-control" id="state" placeholder="Estado">
                            </div>
                            <div class="mb-3">
                                <label for="district" class="form-label">Bairro:</label>
                                <input type="text" class="form-control" id="district" maxlength="11" placeholder="Bairro Exemplo">
                            </div>
                            <div class="mb-3">
                                <label for="city" class="form-label">Cidade:</label>
                                <input type="text" class="form-control" id="city" maxlength="11" placeholder="Cidade">
                            </div>
                            <div class="mb-3">
                                <label for="street" class="form-label">Rua:</label>
                                <input type="text" class="form-control" id="street" placeholder="Rua Exemplo">
                            </div>
                            <div class="mb-3">
                                <label for="number" class="form-label">Nº:</label>
                                <input type="text" class="form-control" id="number" placeholder="XX">
                            </div>
                        </form>
                    </div>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
            </div>
        </div>
    </div>
@endsection

<script src="{{ asset('js/apiQueryAndFillerService.js') }}"></script>