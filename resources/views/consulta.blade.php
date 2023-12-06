@extends('master')

@section('content')

@if (auth()->check())
    Already logged in | {{ auth()->user()->firstName }} | - <a href="{{ route('login.destroy') }}">Logout</a>
@endif


    <h1>Escolha um Médico</h1>

    @foreach ($medicos as $medico)
        <div>
            <h2>{{ $medico->user->firstName }} {{$medico->user->lastName}}</h2>
            <p>Especialidade: {{ $medico->especialidade->nome }}</p>
            <!-- Outras informações do médico, se necessário -->
            <form action="{{ route('consulta') }}" method="post">
                @csrf
                <input type="hidden" name="id_medico" value="{{ $medico->id }}">

                <label for="horario_inicio">Horário de Início:</label>
                <input type="time" name="horario_inicio" id="horario_inicio">

                <!-- Campo para horário de término -->
                <label for="horario_termino">Horário de Término:</label>
                <input type="time" name="horario_termino" id="horario_termino">

                <!-- Campo para a duração -->
                <label for="duracao">Duração (em minutos):</label>
                <input type="number" name="duracao" id="duracao" min="1">

                <!-- Campo para a data -->
                <label for="data">Data:</label>
                <input type="date" name="data" id="data">

                <!-- Botão de envio -->
                <button type="submit">Salvar Consulta</button>
            </form>
            
        </div>
    @endforeach


@endsection

