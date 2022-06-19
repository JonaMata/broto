@extends('layouts.app')

@section('title')
    Bruotes
@endsection

@section('content')
    <h1>Bruote Corner</h1><br>
    <div class="row">
        @auth('web')
            <div class="col-lg-3 col-md-12 col-sm-12">
                <div class="card mb-4">
                    <div class="card-header">
                        Add Bruote
                    </div>
                    <form method="post" action="{{ route('bruotes::store') }}">
                        @csrf
                        <div class="card-body">
                            <div class="row mb-3">
                                <label for="bruote"
                                       class="col-md-4 col-form-label text-md-end">{{ __('Bruote') }}</label>

                                <div class="col-md-7">
                                    <input id="bruote" type="text"
                                           class="form-control @error('bruote') is-invalid @enderror" name="bruote"
                                           value="{{ old('bruote') }}" required autocomplete="bruote">

                                    @error('bruote')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="author"
                                       class="col-md-4 col-form-label text-md-end">{{ __('Author') }}</label>

                                <div class="col-md-7">
                                    <select id="author" class="form-select @error('author') is-invalid @enderror"
                                            name="author" required aria-label="Select Author">
                                        @foreach(\App\Models\User::all() as $user)
                                            <option
                                                value="{{ $user->id }}" {{ $user->id == old('author') ? 'selected' : '' }}>{{ $user->name }}</option>
                                        @endforeach
                                    </select>

                                    @error('author')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="card-footer">
                            <button class="btn btn-primary">Add Bruote</button>
                        </div>
                    </form>
                </div>
            </div>
        @endauth
        <div class="col-lg-9 col-md-12 col-sm-12">
            <div class="row">
                @foreach($bruotes as $bruote)
                    <div class="col-lg-4 col-md-6 col-sm-12">
                        <div class="card mb-4">
                            <div class="card-header">
                                {{ $bruote->created_at->format('j F Y') }}
                                @auth('web')
                                    <div class="float-end">
                                        <a class="btn btn-sm btn-danger" href="{{ route('bruotes::delete', ['id' => $bruote->id]) }}">
                                            <i class="bi bi-trash"></i>
                                        </a>
                                    </div>
                                @endauth
                            </div>
                            <div class="card-body">
                                <blockquote class="blockquote">
                                    {{ $bruote->bruote }}
                                </blockquote>
                                <figcaption class="blockquote-footer">
                                    {{ $bruote->author->name }}
                                </figcaption>
                            </div>
                        </div>
                    </div>

                @endforeach

            </div>
        </div>
    </div>
    <div class="d-flex justify-content-center">
        {{ $bruotes->links() }}
    </div>

@endsection
