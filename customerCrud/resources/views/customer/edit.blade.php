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
                    <div class="card-body">
                        <form action="{{ url('customers/' . $customer->id) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <div class="card-header">
                                <h4>Informações Gerais:</h4>
                              </div>
                            <div class="mb-3">
                                <label for="name" class="form-label">Nome:</label>
                                <input value="{{ $customer->name }}" type="text" class="form-control" id="name" placeholder="Nome">
                            </div>
                            <div class="mb-3">
                                <label for="email" class="form-label">Email:</label>
                                <input value="{{ $customer->email }}" type="email" class="form-control" id="email" placeholder="cliente@exemplo.com">
                            </div>
                            <div class="mb-3">
                                <label for="phone" class="form-label">Telefone:</label>
                                <input value="{{ $customer->phone }} "type="tel" class="form-control" id="phone" maxlength="11" placeholder="(XX) XXXX-XXXX">
                            </div>
                            <div class="mb-3">
                                <label for="avatar" class="form-label">Avatar:</label>
                                <input value="{{ $customer->avatar }}" type="file" class="form-control" id="avatar" placeholder="Escolha sua imagem">
                            </div>
                            <div class="card-header">
                                <h4>Endereço:</h4>
                            </div>
                            <div class="mb-3">
                                <label for="cep" class="form-label">Cep:</label>
                                <input value="{{ $customer->customerAddress()->cep }}" onblur="findCep(this.value)" type="text" name="cep" maxlength="8" class="form-control" id="cep" placeholder="XXXXXXXX" >
                            </div>
                            <div class="mb-3">
                                <label for="state" class="form-label">Estado:</label>
                                <input value="{{ $customer->customerAddress()->state }}" type="text" class="form-control" id="state" placeholder="Estado">
                            </div>
                            <div class="mb-3">
                              <label for="city" class="form-label">Cidade:</label>
                              <input value="{{ $customer->customerAddress()->city }}" type="text" class="form-control" id="city" maxlength="11" placeholder="Cidade">
                            </div>
                            <div class="mb-3">
                                <label for="district" class="form-label">Bairro:</label>
                                <input value="{{ $customer->customerAddress()->district }}" type="text" class="form-control" id="district" maxlength="11" placeholder="Bairro Exemplo">
                            </div>
                            <div class="mb-3">
                                <label for="street" class="form-label">Rua:</label>
                                <input value="{{ $customer->customerAddress()->street }}" type="text" class="form-control" id="street" placeholder="Rua Exemplo">
                            </div>
                            <div class="mb-3">
                                <label for="number" class="form-label">Nº:</label>
                                <input value="{{ $customer->customerAddress()->number }}" type="text" class="form-control" id="number" placeholder="XX">
                            </div>
                        </form>
                    </div>
                    <button type="submit" class="btn btn-primary text-uppercase">Atualizar</button>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        const VIACEP_API = 'https://viacep.com.br/ws/';
        const format = '/json/';

        function findCep(cepValue) {
            var cep = cepValue.replace(/\D/g, '');

            if (cep != "") {
                var validacep = /^[0-9]{8}$/;
                if(validacep.test(cep)) {
                    document.getElementById('state').value=("...");
                    document.getElementById('city').value=("...");
                    document.getElementById('district').value=("...");
                    document.getElementById('street').value=("...");

                    var script = document.createElement('script');
                    script.src = VIACEP_API + cep + format + '?callback=callback';
                    document.body.appendChild(script);
                }
                else {
                    clearAddressForm();
                    alert("Formato de CEP inválido.");
                }
            } 
            else {clearAddressForm();}
        };

        function clearAddressForm() {
                document.getElementById('state').value=("");
                document.getElementById('city').value=("");
                document.getElementById('district').value=("");
                document.getElementById('street').value=("");
        }

        function callback(content) {
            if (!("erro" in content)) {
                document.getElementById('state').value=(content.uf);
                document.getElementById('city').value=(content.localidade);
                document.getElementById('district').value=(content.bairro);
                document.getElementById('street').value=(content.logradouro);
            } 
            else {
                clearAddressForm();
                alert("CEP não encontrado.");
            }
        }

    </script>
@endpush