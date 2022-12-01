@extends('layouts.app')

@section('content')
    <div class="container">
        @if (session('message'))
            <input type="hidden" name="" id="message" value="{{ session('message') }}">
        @endif
        <h2 style="text-align:center">List User</h2>
        <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#form-create-user">Create</button>

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
                                <button class="btn btn-warning btn-edit-user" data-id="{{ $user->id }}"
                                    data-bs-toggle="modal" data-bs-target="#form-edit-user">Edit</button>

                            </td>
                            <td>
                                {{-- <form id="deleteForm{{ $user->id }}" action="{{ route('users.destroy', $user->id) }}"
                                    method="post">
                                    @method('DELETE')
                                    @csrf
                                </form> --}}
                                {{-- data-url="{{ route('users.destroy', $user->id) }}" --}}
                                <button data-id="{{ $user->id }}" class="btn btn-danger btn-delete-user">Delete</button>
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
@include('models/modaluser')
@section('script')
    <script>
        $(document).ready(function() {
            //Pass Header Token
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            let _token = $('meta[name="csrf-token"]').attr('content');

            function isEmpty(str) {
                return (!str || str.length === 0);
            }
            $('.btn-submit-create-user').on('click', function() {
                var _name = $(this).parent('.footer-submit').parent('.modal-content').find('.modal-body')
                    .find('.body-name').find('#create_name').val();
                var _email = $(this).parent('.footer-submit').parent('.modal-content').find('.modal-body')
                    .find('.body-email').find('#create_email').val();
                var _password = $(this).parent('.footer-submit').parent('.modal-content').find(
                    '.modal-body').find('.body-password').find('#create_password').val();
                var _address = $(this).parent('.footer-submit').parent('.modal-content').find('.modal-body')
                    .find('.body-address').find('#create_address').val();
                if (isEmpty(_name) && isEmpty(_email) && isEmpty(_address) && isEmpty(_password)) {
                    Swal.fire({
                        icon: 'warning',
                        title: 'Please enter full information!',
                        timer: 1500,
                        timerProgressBar: true,
                    })
                } else if (isEmpty(_name)) {
                    Swal.fire({
                        icon: 'warning',
                        title: 'Please enter your name!',
                        timer: 1500,
                        timerProgressBar: true,
                    })
                } else if (isEmpty(_email)) {
                    Swal.fire({
                        icon: 'warning',
                        title: 'Please enter your email!',
                        timer: 1500,
                        timerProgressBar: true,
                    })
                } else if (isEmpty(_password)) {
                    Swal.fire({
                        icon: 'warning',
                        title: 'Please enter your password!',
                        timer: 1500,
                        timerProgressBar: true,
                    })
                } else if (isEmpty(_address)) {
                    Swal.fire({
                        icon: 'warning',
                        title: 'Please enter your address!',
                        timer: 1500,
                        timerProgressBar: true,
                    })
                } else if (_password.length < 6) {
                    Swal.fire({
                        icon: 'warning',
                        title: 'Please enter a password of at least 6 characters!',
                        timer: 1500,
                        timerProgressBar: true,
                    })
                } else {
                    $.ajax({
                        type: "POST",
                        url: "/api/store",
                        data: {
                            token: _token,
                            name: _name,
                            email: _email,
                            password: _password,
                            address: _address,
                        },
                        success: function(response) {
                            if (response.status.email == 'The email has already been taken.') {
                                Swal.fire({
                                    icon: 'warning',
                                    title: 'The email has already been taken!',
                                    timer: 1500,
                                    timerProgressBar: true,
                                })
                            } else if (response.status == 'Create successfully!') {
                                Swal.fire({
                                    icon: 'success',
                                    title: 'Create successfully!',
                                    timer: 1500,
                                    timerProgressBar: true,
                                }).then((result) => {
                                    // done then reload page
                                    if (result.dismiss === Swal
                                        .DismissReason.timer) {
                                        location.reload();
                                    }
                                })
                            }
                        },
                        error: function(response) {}
                    })
                }
            })

            $('.btn-edit-user').on('click', function() {
                var _id = $(this).data('id');
                $.ajax({
                    type: "GET",
                    url: "/api/edit/" + _id,
                    data: {
                        token: _token,
                    },
                    success: function(data) {
                        $('#edit_name').val(data.user.name);
                        $('#edit_email').val(data.user.email);
                        $('#edit_password').val(data.user.password);
                        $('#edit_address').val(data.user.address);
                        $('#edit_id').val(data.user.id);
                    }
                });
            })

            $('.btn-submit-update-user').on('click', function() {
                var _id = $(this).parent('.footer-submit').find('#edit_id').val();
                var _name = $(this).parent('.footer-submit').parent('.modal-content').find('.modal-body')
                    .find('.body-name').find('#edit_name').val();
                var _email = $(this).parent('.footer-submit').parent('.modal-content').find('.modal-body')
                    .find('.body-email').find('#edit_email').val();
                var _password = $(this).parent('.footer-submit').parent('.modal-content').find(
                        '.modal-body')
                    .find('.body-password').find('#edit_password').val();
                var _address = $(this).parent('.footer-submit').parent('.modal-content').find('.modal-body')
                    .find('.body-address').find('#edit_address').val();

                if (isEmpty(_name) && isEmpty(_email) && isEmpty(_address)) {
                    Swal.fire({
                        icon: 'warning',
                        title: 'Please enter full information!',
                        timer: 1500,
                        timerProgressBar: true,
                    })
                } else if (isEmpty(_name)) {
                    Swal.fire({
                        icon: 'warning',
                        title: 'Please enter your name!',
                        timer: 1500,
                        timerProgressBar: true,
                    })
                } else if (isEmpty(_email)) {
                    Swal.fire({
                        icon: 'warning',
                        title: 'Please enter your email!',
                        timer: 1500,
                        timerProgressBar: true,
                    })
                } else if (isEmpty(_address)) {
                    Swal.fire({
                        icon: 'warning',
                        title: 'Please enter your address!',
                        timer: 1500,
                        timerProgressBar: true,
                    })
                } else if (_password.length != 0 || _password != "") {
                    if (_password.length < 6)
                        Swal.fire({
                            icon: 'warning',
                            title: 'Please enter a password of at least 6 characters!',
                            timer: 1500,
                            timerProgressBar: true,
                        })
                } else {
                    $.ajax({
                        type: "PUT",
                        url: "/api/update/" + _id,
                        data: {
                            token: _token,
                            name: _name,
                            email: _email,
                            password: _password,
                            address: _address,
                        },
                        success: function(response) {
                            console.log(response);
                            if (response.status.email == 'The email has already been taken.') {
                                Swal.fire({
                                    icon: 'warning',
                                    title: 'The email has already been taken!',
                                    timer: 1500,
                                    timerProgressBar: true,
                                })
                            } else if (response.status == 'Update successfully!') {
                                Swal.fire({
                                    icon: 'success',
                                    title: 'Update successfully!',
                                    timer: 1500,
                                    timerProgressBar: true,
                                }).then((result) => {
                                    // done then reload page
                                    if (result.dismiss === Swal
                                        .DismissReason.timer) {
                                        location.reload();
                                    }
                                })
                            }
                        }
                    })
                }
            })

            $('.btn-delete-user').on('click', function() {
                var _id = $(this).data('id')
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
                                token: _token,
                            },
                            success: function(response) {
                                if (response.status == '1' && response.msg ==
                                    'Success') {
                                    Swal.fire({
                                        icon: 'success',
                                        title: 'Deleted!',
                                        timer: 1200,
                                        timerProgressBar: true,
                                    }).then((result) => {
                                        // done then reload page
                                        if (result.dismiss === Swal
                                            .DismissReason.timer) {
                                            location.reload();
                                        }
                                    })
                                } else if (response.status == '0' && response.msg ==
                                    'Fail') {
                                    Swal.fire({
                                        icon: 'warning',
                                        title: 'An error has occurred. ID not found!',
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
