@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <!-- Profile Section -->
        <div class="col-md-3">
            <div class="card p-3">
                <h4>Profile</h4>
                <p>
                    <span class="fw-bold">{{ Auth::user()->name }}</span>
                    <br>
                    <small>{{ Auth::user()->email }}</small>
                </p>
                <a href="{{ route('profile', Auth::user()->id) }}" class="btn btn-primary btn-sm">My Profile</a>
                <hr>
                <button onclick="event.preventDefault(); document.getElementById('logout-form').submit();"
                    class="btn btn-light btn-sm">← Logout</button>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                    @csrf
                </form>
            </div>
        </div>
        <!-- Twats Section -->
        <div class="col-md-9">
            @if(session('success'))
            <div class="alert alert-primary" role="alert">
            {{session('success')}}
            </div>
            @endif
            <!-- Write Twat -->
            <div class="card p-3 mb-3">
                <p class="fw-bold">Write a Twat</p>
                <form action="{{ route('createtwat') }}" method="POST">
                    @csrf
                    <div class="row">
                        <div class="col-10">
                            <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">
                            <input class="form-control" placeholder="Say anything you want..." type="text" name="content">
                        </div>
                        <div class="col-2">
                            <button type="submit" class="btn btn-primary">
                                ➡
                            </button>
                        </div>
                    </div>
                </form>
            </div>
            <div class="card">
                <div class="card-body">
                    <h2 class="fw-bold mb-3">Recent Twats</h2>
                    <!-- Twat Area -->
                    @foreach($twats as $twat)
                    <div class="card my-2">
                        <div class="card-body">
                            <h6 class="fw-bold">
                                <a href="{{ route('profile', $twat->user->id) }}" style="text-decoration:none">{{ $twat->user->name }}</a>
                                @if($twat->user_id == Auth::user()->id)
                                <a href="#" class="float-end dropdown-toggle" style="text-decoration:none" data-bs-toggle="dropdown"></a>
                                <ul class="dropdown-menu">
                                    <li><a class="dropdown-item" href="{{ route('deletetwat', $twat->id) }}">Delete</a></li>
                                </ul>
                                @endif
                            </h6>
                            
                            <p>
                                {{ $twat->content}}
                            </p>
                            <small class="text-muted float-end">{{ $twat->created_at->diffForHumans() }}</small>
                        </div>
                    </div>
                    @endforeach

                    {{ $twats->links() }}
                    
                </div>
            </div>
        </div>
    </div>
</div>
@endsection