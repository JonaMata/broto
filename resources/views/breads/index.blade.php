@extends('layouts.app')

@section('title')
    Bruotes
@endsection

@section('content')
    <div class="d-flex justify-content-between">
        <h1>Bread Ratings</h1>
        @auth('web')
            <div class="float-end">
            <a class="btn btn-primary float-end" href="{{ route('breads::create') }}"><i class="bi bi-plus"></i>Add
                Bread</a>
            </div>
        @endauth
    </div>
    <div class="table-responsive">
    <table class="table">
        <thead>
        <tr>
            <th scope="col">Photo</th>
            <th scope="col">Name</th>
            <th scope="col">Special Ingredient</th>
            <th scope="col">Huts</th>
            <th scope="col">Date baked</th>
            @auth('web')
                <th scope="col">Actions</th>
            @endauth
        </tr>
        </thead>
        <tbody class="table-striped table-hover">
        @foreach($breads as $bread)
            <tr class="align-middle">
                <td>
                    @if($bread->photo())
                        <img class="img-fluid" style="min-width: 100px;" width="200" src="{{ $bread->photo() }}"/>
                    @else
                        No Photo
                    @endif
                </td>
                <th scope="row">{{ $bread->name }}</th>
                <td>{{ $bread->special_ingredient }}</td>
                <td>{{ $bread->huts }}</td>
                <td>{{ $bread->bake_date->format('j F Y') }}</td>
                @auth('web')
                    <td class="text-nowrap">
                        <a class="btn btn-secondary" href="{{ route('breads::edit', ['bread' => $bread]) }}">
                            <i class="bi bi-pen"></i>
                        </a>
                        <a class="btn btn-danger" href="{{ route('breads::delete', ['bread' => $bread]) }}">
                            <i class="bi bi-trash"></i>
                        </a>
                    </td>
                @endauth
            </tr>
        @endforeach
        </tbody>
    </table>
    </div>

@endsection
