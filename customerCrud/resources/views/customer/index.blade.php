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
                                <th>Endereço:</th>
                                <th>Ações:</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($customers as $customer)
                                <tr>
                                    <td>{{ $customer->avatar }}</td>
                                    <td>{{ $customer->name }}</td>
                                    <td>{{ $customer->address()->city . ", "  
                                           . $customer->address()->state }}</td>
                                    <td>
                                        <a href="" class="btn btn-primary btn-sm">Ver</a>
                                        <a href="{{ url('customers/' . $customer->id . '/edit') }}" class="btn btn-success btn-sm">Editar</a>
                                        <a href="" class="btn btn-danger btn-sm">Deletar</a>
                                        <form class="d-inline" action="{{ url('customers/' . $customer->id) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm">Deletar</button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <div class="card-body">
                                    Ainda não há clientes cadastrados.
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