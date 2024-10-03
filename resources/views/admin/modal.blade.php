<!-- Add User Modal -->
<div class="modal fade" id="userAddModal" tabindex="-1" role="dialog" aria-labelledby="userAddModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="userAddModalLabel">Add New User</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <!-- Form for adding a new user -->
                <form id="addUserForm">
                    @csrf
                    <div class="mb-3">
                        <label for="userName" class="form-label">User Name</label>
                        <input type="text" class="form-control" name="userName" id="userName"
                            placeholder="Enter user name" required>
                    </div>
                    <div class="mb-3">
                        <label for="userEmail" class="form-label">Email address</label>
                        <input type="email" class="form-control" name="userEmail" id="userEmail"
                            placeholder="Enter user email" required>
                    </div>
                    <div class="mb-3">
                        <label for="userPassword" class="form-label">Password</label>
                        <input type="password" class="form-control" name="userPassword" id="userPassword"
                            placeholder="Enter user password" required>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" form="addUserForm" class="btn btn-primary" id="saveAddUserForm">Save</button>
            </div>
        </div>
    </div>
</div>


<!-- Edit User Modal -->
<div class="modal fade" id="editUserAddModal" tabindex="-1" role="dialog" aria-labelledby="editUserAddModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editUserAddModalLabel">Edit User</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <!-- Form for adding a new user -->
                <form id="editUserForm">
                    @csrf
                    <input type="hidden" class="form-control" name="editUserId" id="editUserId">
                    <div class="mb-3">
                        <label for="userName" class="form-label">User Name</label>
                        <input type="text" class="form-control" name="editUserName" id="editUserName"
                            placeholder="Enter user name" required>
                    </div>
                    <div class="mb-3">
                        <label for="userEmail" class="form-label">Email address</label>
                        <input type="email" class="form-control" name="editUserEmail" id="editUserEmail"
                            placeholder="Enter user email" required>
                    </div>
                    {{-- <div class="mb-3">
                        <label for="userPassword" class="form-label">Password</label>
                        <input type="password" class="form-control" name="editUserPassword" id="editUserPassword" placeholder="Enter user password" required>
                    </div> --}}
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" form="editUserForm" class="btn btn-primary" id="saveEditUserForm">Save</button>
            </div>
        </div>
    </div>
</div>


<!-- User Post Modal -->
<div class="modal fade" id="userPostModal" tabindex="-1" role="dialog" aria-labelledby="userPostModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="userPostModalLabel">Add New Post</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <!-- Form for adding a new user -->
                <form id="userPostForm">
                    @csrf
                    <div class="mb-3">
                        <label for="userPostName" class="form-label">Name</label>
                        <input type="text" class="form-control" name="userPostName" id="userPostName"
                            placeholder="Enter user name" required>
                    </div>
                    <div class="mb-3">
                        <label for="userDes" class="form-label">Description</label>
                        <textarea class="form-control" id="userDes" placeholder="Enter the Description" name="userDes" required></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="userPost" class="form-label">Post</label>
                        <input type="file" class="form-control" name="userPost[]" id="userPost"
                            placeholder="Enter user email" onchange="imgPreview();" required multiple>
                        </br>
                        <div class="PostPreview">
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" form="userPostForm" class="btn btn-primary"
                    id="saveUserPostForm">Save</button>
            </div>
        </div>
    </div>
</div>

<!-- Edit User Post Modal -->
<div class="modal fade" id="editPostModal" tabindex="-1" role="dialog" aria-labelledby="editUserModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editUserModalLabel">Add New Post</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <!-- Form for adding a new user -->
                <form id="editPostForm">
                    @csrf
                    <input type="hidden" class="form-control" name="editPostId" id="editPostId">
                    <div class="mb-3">
                        <label for="editPostName" class="form-label">Name</label>
                        <input type="text" class="form-control" name="editPostName" id="editPostName"
                            placeholder="Enter user name" required>
                    </div>
                    <div class="mb-3">
                        <label for="editPostDes" class="form-label">Description</label>
                        <textarea class="form-control" id="editPostDes" placeholder="Enter the Description" name="editPostDes" required></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="editPost" class="form-label">Post</label>
                        <input type="file" class="form-control" name="editPost[]" id="editPost"
                            placeholder="Enter user email" onchange="imgPreview();" required multiple>
                        </br>
                        <div class="PostPreview">
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" form="editPostForm" class="btn btn-primary"
                    id="saveEditPostForm">Save</button>
            </div>
        </div>
    </div>
</div>
