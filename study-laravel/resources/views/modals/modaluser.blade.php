{{-- modal create user --}}
<div class="modal fade text-center" id="form-create-user" aria-hidden="true" aria-labelledby="exampleModalToggleLabel"
    tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header mx-auto">
                <h3 class="modal-title" id="staticBackdropLabel">Create User</h3>
                <button type="button" class="btn-close btn-close-create-user" data-bs-dismiss="modal"
                    aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="mb-3 body-name">
                    <label for="create_name" class="form-label"><strong>Name</strong></label>
                    <input type="text" value="{{ old('name') }}" name="create_name" class="form-control"
                        id="create_name" aria-describedby="emailHelp">
                </div>
                <div class="mb-3 body-email">
                    <label for="create_email" class="form-label"><strong>Email</strong></label>
                    <input type="email" value="{{ old('email') }}" name="create_email" class="form-control"
                        id="create_email" aria-describedby="emailHelp">
                </div>
                <div class="mb-3 body-password">
                    <label for="create_password" class="form-label"><strong>Password</strong></label>
                    <input type="password" name="create_password" class="form-control" id="create_password">
                </div>
                <div class="mb-3 body-address">
                    <label for="create_address" class="form-label"><strong>Address</strong></label>
                    <textarea name="create_address" id="create_address" cols="30" rows="3" class="form-control">{{ old('address') }}</textarea>
                </div>
            </div>
            <div class="modal-footer footer-submit">
                <button href="#" class="btn btn-primary btn-block mt-3 w-100 btn-submit-create-user">Add</button>
            </div>
        </div>
    </div>
</div>

{{-- modal edit user  --}}
<div class="modal fade text-center" id="form-edit-user" aria-hidden="true" aria-labelledby="exampleModalToggleLabel"
    tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header mx-auto">
                <h3 class="modal-title" id="staticBackdropLabel">Edit User </h3>
                <button type="button" class="btn-close btn-close-edit-user" data-bs-dismiss="modal"
                    aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="mb-3 body-name">
                    <label for="edit_name" class="form-label"><strong>Name</strong></label>
                    <input type="text" value="{{ old('name') }}" name="edit_name" class="form-control"
                        id="edit_name" aria-describedby="emailHelp">
                </div>
                <div class="mb-3 body-email">
                    <label for="edit_email" class="form-label"><strong>Email</strong></label>
                    <input type="email" value="{{ old('email') }}" name="edit_email" class="form-control"
                        id="edit_email" aria-describedby="emailHelp">
                </div>
                <div class="mb-3 body-password">
                    <label for="edit_password" class="form-label"><strong>Password</strong></label>
                    <input type="password" name="edit_password" class="form-control" id="edit_password">
                </div>
                <div class="mb-3 body-address">
                    <label for="edit_address" class="form-label"><strong>Address</strong></label>
                    <textarea name="edit_address" id="edit_address" cols="30" rows="3" class="form-control">{{ old('address') }}</textarea>
                </div>
            </div>
            <div class="modal-footer footer-submit">
                <input type="hidden" class="form-control" id="edit_id" name="edit_id" value="">
                <button href="#"
                    class="btn btn-primary btn-block mt-3 w-100 btn-submit-update-user">Update</button>
            </div>
        </div>
    </div>
</div>
