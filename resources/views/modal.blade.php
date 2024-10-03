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
                        <div id="PostPreview">
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" form="userPostForm" class="btn btn-primary" id="saveUserPostForm">Save</button>
            </div>
        </div>
    </div>
</div>


<!-- Edit User Modal -->
<div class="modal fade" id="edituserPostModal" tabindex="-1" role="dialog" aria-labelledby="edituserPostModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="edituserPostModalLabel">Edit User</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <!-- Form for adding a new user -->
                <form id="editUserForm">
                    @csrf
                    <input type="hidden" class="form-control" name="editUserId" id="editUserId">
                    <div class="mb-3">
                        <label for="userPostName" class="form-label">User Name</label>
                        <input type="text" class="form-control" name="editUserPostName" id="editUserPostName"
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
