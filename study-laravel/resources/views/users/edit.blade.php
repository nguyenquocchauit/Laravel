@extends('layouts.app')

@section('content')
    <div class="container">
        <h2 style="text-align: center">Edit User {{ $user->name }}</h2>
        <form id="updateForm{{ $user->id }}" action="{{ route('users.update', $user->id) }}" method="post">
            @csrf
            @method('PUT')
            <div class="mb-3">
                <label for="name" class="form-label">Name</label>
                <input type="text" value="{{ old('name') ?? $user->name }}" name="name" class="form-control"
                    id="name" aria-describedby="emailHelp">
            </div>
            @error('name')
                <div class="text-danger">{{ $message }}</div>
            @enderror
            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" value="{{ old('email') ?? $user->email }}" name="email" class="form-control"
                    id="email" aria-describedby="emailHelp">
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
                <textarea name="address" id="address" cols="30" rows="10" class="form-control">{{ old('address') ?? $user->address }}</textarea>
            </div>
            @error('address')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </form>
        <button data-form="updateForm{{ $user->id }}" class="btn btn-primary btn-update">Update</button>

    </div>
@endsection

@section('script')
    <script>
        $(document).ready(function() {
            $('.btn-update').on('click', function() {

                let dataForm = $(this).data('form');
                Swal.fire({
                    icon: 'success',
                    title: 'Update successful!',
                    timer: 1200,
                    timerProgressBar: true,
                }).then((result) => {
                    if (result.dismiss === Swal.DismissReason.timer) {
                        $(`#${dataForm}`).submit()
                    }
                })
            });
        })
    </script>
@endsection
