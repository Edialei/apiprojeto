@extends('master')

@section('content')

    <a href="{{route('home')}}">Home</a>

    <h2>Login</h2>

    @if (session()->has('success'))
        {{session()->get('success')}} 
    @endif


    @error('error')
        <span>{{$message}}</span>
    @enderror

    <form action="{{route('login.store')}}" method="post">
        @csrf
        <input type="text" name="usuario" value="contato@eduardo.com">
        @error('usuario')
            <span>{{$message}}</span>
        @enderror
        <input type="password" name="password" value="123">
        @error('password')
            <span>{{$message}}</span>
        @enderror
        <button type="submit">Login</button>
    </form>
@endsection