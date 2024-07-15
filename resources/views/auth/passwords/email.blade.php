@extends('general')

@section('content')
    <div class="container">
        <div class="row">
            <div class="row justify-content-center mt-5">
                <div class="col-md-5">
                    <div class="card card-custom">
                        <div class="card-body card-body-home card-text text-center " style="margin: 0 auto">
                            <img class="logo" src="{{ asset('images/logo.png') }}" alt="árvore lúdica e colorida">
                            <div class="card-text text-center fs-2 mt-4 ">{{ __('Recuperar senha') }}</div>
                                
                            <div class="card-body">
                                @if (session('status'))
                                    <div class="alert alert-success" role="alert">
                                        {{ session('status') }}
                                    </div>
                                @endif

                                <form method="POST" action="{{ route('password.email') }}">
                                    @csrf

                                    <div class="mb-3 mt-3">
                                        <input placeholder="Email" id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
        
                                        @error('email')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
        
                                    </div>

                                    <div class="row mb-0">
                                        <center>
                                            <div class="col-md-8">
                                                <button type="submit" class="btn btn-custom">
                                                    {{ __('Recuperar') }}
                                                </button>
                                            </div>
                                        </center>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
