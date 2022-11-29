@extends('layouts.app')

@section('content')
    <div class="container">
        @if (session('message'))
            <input type="hidden" name="" id="message" value="{{ session('message') }}">
        @endif
        <h2 style="text-align:center">List User</h2>
        <a href="{{ route('users.create') }}"> <button type="button" class="btn btn-success">Create</button></a>
        <div>
            <table class="table table hover">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Name</th>
                        <th>Address</th>
                        <th>Email</th>
                        <th colspan="2">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($users as $user)
                        <tr>
                            <td>
                                {{ $user->id }}
                            </td>
                            <td>
                                {{ $user->name }}
                            </td>
                            <td>
                                {{ $user->address }}
                            </td>
                            <td>
                                {{ $user->email }}
                            </td>
                            <td>
                                <a href="{{ route('users.edit', $user->id) }}"><button
                                        class="btn btn-warning">Edit</button></a>
                            </td>
                            <td>
                                {{-- <form id="deleteForm{{ $user->id }}" action="{{ route('users.destroy', $user->id) }}"
                                    method="post">
                                    @method('DELETE')
                                    @csrf
                                </form> --}}
                                {{-- data-url="{{ route('users.destroy', $user->id) }}" --}}
                                <button data-id="{{ $user->id }}" class="btn btn-danger btn-delete">Delete</button>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <div>
                {!! $users->links() !!}
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script>
        $(document).ready(function() {
            //Pass Header Token
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $('.btn-delete').on('click', function() {
                var _id = $(this).data('id')
                var _token = $('meta[name="csrf-token"]').attr('content');
                console.log(_id + _token);
                Swal.fire({
                    title: 'Are you sure you want to delete?',
                    text: "Deletion cannot be undone!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Sure',
                    cancelButtonText: "Cancel",
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            type: "DELETE",
                            url: "/api/delete/" + _id,
                            data: {
                                "_token": _token,
                            },
                            success: function(response) {
                                var response = JSON.parse(response);
                                console.log(response);
                                if (response.statusCode == 200) {
                                    Swal.fire({
                                        icon: 'success',
                                        title: 'Deleted!',
                                        timer: 1200,
                                        timerProgressBar: true,
                                    })
                                }

                            },
                            error: function(jqXHR, textStatus, errorThrown) {
                                // xử lý lỗi
                            }
                        })

                    }
                });
            });
        })
    </script>
@endsection
