@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                @if(session('message'))
                    <h4 class="alert alert success">{{ session('message') }}</h4>
                @endif
                <div class="card">
                    <div class="card-header">
                        <h4>Lista de Clientes
                            <a class="btn btn-primary float-end" href="{{ url('customers/create') }}">Cadastrar Cliente</a>
                        </h4>
                    </div>
                    <div class="card-body">
                     <table class="table table-responsive">
                        <thead>
                            <tr>
                                <th>Avatar:</th>
                                <th>Nome:</th>
                                <th>Email:</th>
                                <th>Telefone:</th>
                                <th>Endereço:</th>
                                <th>Ações:</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($customers as $customer)
                                <tr>
                                    <td><img src="{{ asset('images/' . $customer->avatar) }}" width="48px" height="48px"></td>
                                    <td>{{ $customer->name }}</td>
                                    <td>{{ $customer->email }}</td>
                                    <td>{{ $customer->phone }}</td>
                                    <td>{{   $customer->address->street . ", "
                                           . $customer->address->number . ", "
                                           . $customer->address->district . ", "
                                           . $customer->address->city . "-"  
                                           . $customer->address->state 
                                           . ". Cep: " . $customer->address->cep}}</td>
                                    <td>
                                        <a href="{{ url('customers/' . $customer->id . '/edit') }}" class="btn btn-primary btn-sm">Editar</a>
                                        <form class="d-inline" action="{{ route('customers.destroy', ['customer' => $customer->id]) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm">Deletar</button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <div class="card-body">
                                    Não há clientes cadastrados, quando houver, eles serão aprentados como abaixo:
                                </div>
                            @endforelse
                        </tbody>
                     </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection