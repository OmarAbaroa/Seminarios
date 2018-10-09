@extends('plantilla')

@section('titulo', 'Catálogos')

@section('contenido')
    <div class="ui center aligned container">
        <h1 class="ui blue header">Catálogos</h1>
    </div>
    <br/>
    <div class="ui raised segments">
        <a href="{{route('sexos')}}">
            <div class="ui segment">
                <p>Sexos de alumnos</p>
            </div>
        </a>
        <a href="{{route('areas')}}">
            <div class="ui segment">
                <p>Áreas de Unidades Académica</p>
            </div>
        </a>
        <a href="{{route('unidades_academicas')}}">
            <div class="ui segment">
                <p>Unidades Académicas</p>
            </div>
        </a>
        
        <a href="{{route('programas_academicos')}}">
            <div class="ui segment">
                <p>Programas Académicos</p>
            </div>
        </a>
        <a href="{{route('funcionarios')}}">
            <div class="ui segment">
                <p>Funcionarios</p>
            </div>
        </a>
        <a href="{{route('directores')}}">
            <div class="ui segment">
                <p>Directores</p>
            </div>
        </a>
        <a href="{{route('escolaridades')}}">
            <div class="ui segment">
                <p>Escolaridad</p>
            </div>
        </a>
    </div>
@endsection