@extends('layouts.app')

@section('title')
    {{ isset($bread) ? 'Edit Bread' : 'Add Bread' }}
@endsection

@section('content')
    <h1>{{ isset($bread) ? 'Edit Bread: '.$bread->name : 'Add Bread' }}</h1><br>
    <div class="row">
        <div class="col-md-10">
            <form method="post" enctype="multipart/form-data" action="{{ route('breads::store', ['bread' => $bread ?? null]) }}">
                @csrf
                <div class="row mb-3">
                    <label for="name"
                           class="col-md-4 col-form-label text-md-end">{{ __('Name') }}</label>

                    <div class="col-md-7">
                        <input id="name" type="text"
                               class="form-control @error('name') is-invalid @enderror" name="name"
                               value="{{ old('name') ? old('name') : ($bread->name ?? '') }}" required autocomplete="name">

                        @error('name')
                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                        @enderror
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="huts"
                           class="col-md-4 col-form-label text-md-end">{{ __('Huts') }}</label>

                    <div class="col-md-7">
                        <input id="huts" type="text"
                               class="form-control @error('huts') is-invalid @enderror" name="huts"
                               value="{{ old('huts') ? old('huts') : ($bread->huts ?? '') }}" required autocomplete="huts">

                        @error('huts')
                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                        @enderror
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="special_ingredient"
                           class="col-md-4 col-form-label text-md-end">{{ __('Special Ingredient') }}</label>

                    <div class="col-md-7">
                        <input id="special_ingredient" type="text"
                               class="form-control @error('special_ingredient') is-invalid @enderror" name="special_ingredient"
                               value="{{ old('special_ingredient') ? old('special_ingredient') : ($bread->special_ingredient ?? '') }}" required autocomplete="special_ingredient">

                        @error('special_ingredient')
                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                        @enderror
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="rating"
                           class="col-md-4 col-form-label text-md-end">{{ __('Rating') }}</label>

                    <div class="col-md-7">
                        <input id="rating" type="number" step="1" min="0" max="10"
                               class="form-control @error('rating') is-invalid @enderror" name="rating"
                               value="{{ old('rating') ? old('rating') : ($bread->rating ?? '')}}" required autocomplete="rating">

                        @error('rating')
                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                        @enderror
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="bake_date"
                           class="col-md-4 col-form-label text-md-end">{{ __('Bake date') }}</label>

                    <div class="col-md-7">
                        <input id="bake_date" type="date"
                               class="form-control @error('bake_date') is-invalid @enderror" name="bake_date"
                               value="{{ old('bake_date') ? old('bake_date') : (isset($bread) ? $bread->bake_date->format('Y-m-d') : '') }}" required autocomplete="bake_date">

                        @error('bake_date')
                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                        @enderror
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="photo"
                           class="col-md-4 col-form-label text-md-end">{{ __('Photo') }}</label>

                    <div class="col-md-7">
                        <input type="file" class="form-control" id="photo" name="photo">

                        @error('photo')
                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                        @enderror
                    </div>
                </div>
                @if($bread->photo_path ?? false)
                <div class="row mb-3">
                    <div class="col-md-4 text-md-end">
                        Current photo:
                    </div>
                    <div class="col-md-7">
                            <img class="img-fluid" src="{{ $bread->photo() }}"/>
                    </div>
                </div>
                @endif
                <div class="row mb-3">
                    <div class="col-md-4"></div>
                    <div class="col-md-7">
                        <button class="btn btn-primary" type="submit">{{ isset($bread) ? 'Save Bread' : 'Add Bread' }}</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

@endsection
