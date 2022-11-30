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
                    <label for="name" class="form-label"><strong>Name</strong></label>
                    <input type="text" value="{{ old('name') }}" name="name" class="form-control" id="name"
                        aria-describedby="emailHelp">
                </div>
                <div class="mb-3 body-email">
                    <label for="email" class="form-label"><strong>Email</strong></label>
                    <input type="email" value="{{ old('email') }}" name="email" class="form-control" id="email"
                        aria-describedby="emailHelp">
                </div>
                <div class="mb-3 body-password">
                    <label for="password" class="form-label"><strong>Password</strong></label>
                    <input type="password" name="password" class="form-control" id="password">
                </div>
                <div class="mb-3 body-address">
                    <label for="address" class="form-label"><strong>Address</strong></label>
                    <textarea name="address" id="address" cols="30" rows="3" class="form-control">{{ old('address') }}</textarea>
                </div>
            </div>
            <div class="modal-footer footer-submit">
                <button href="#" class="btn btn-primary btn-block mt-3 w-100 btn-submit-create-user">Add</button>
            </div>
        </div>
    </div>
</div>

