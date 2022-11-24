@extends('layouts.app')

@section('content')
    <div class="container">
        <h2 style="text-align: center">Create User</h2>
        <form action="{{ route('users.store') }}" method="post">
            @csrf
            <div class="mb-3">
                <label for="name" class="form-label">Name</label>
                <input type="text" value="{{ old('name') }}" name="name" class="form-control" id="name" aria-describedby="emailHelp">
            </div>
            @error('name')
                <div class="text-danger">{{ $message }}</div>
            @enderror
            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" value="{{ old('email') }}" name="email" class="form-control" id="email" aria-describedby="emailHelp">
            </div>
            @error('email')
                <div class="text-danger">{{ $message }}</div>
            @enderror
            <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <input type="password" name="password" class="form-control" id="password">
            </div>
            @error('password')
                <div class="text-danger">{{ $message }}</div>
            @enderror
            <div class="mb-3">
                <label for="address" class="form-label">Address</label>
                <textarea name="address" id="address" cols="30" rows="10" class="form-control">{{ old('address') }}</textarea>
            </div>
            @error('address')
                <div class="text-danger">{{ $message }}</div>
            @enderror
            <button type="submit" class="btn btn-primary">Create</button>
        </form>
    </div>
@endsection
