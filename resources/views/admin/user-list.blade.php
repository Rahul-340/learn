<div class="d-flex justify-content-between align-items-center">
    <h1 class="mb-0">Users</h1>
    <button type="button" class="btn btn-outline-primary btn-sm" data-bs-toggle="modal" data-bs-target="#userAddModal">Add
        User</button>
</div>
<table class="table" id="userList">
    <thead>
        <tr>
            <th scope="col">user Id</th>
            <th scope="col">Name</th>
            <th scope="col">Email</th>
            <th scope="col">Status</th>
            <th scope="col">Action</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($users as $user)
            <tr>
                <th scope="row">{{ $user->id }}</th>
                <td>{{ $user->name }}</td>
                <td>{{ $user->email }}</td>
                <td>
                    <button type="button" onclick='userStatus({{ $user->id }},{{ $user->status == 0 ? 1 : 0 }})'
                        class="btn-sm btn btn-outline-{{ $user->status == 0 ? 'danger' : 'success' }}">
                        {{ $user->status == 0 ? 'Deactive' : 'Active' }}
                    </button>
                </td>
                <td>
                    <a href ="javascript:void(0);" onclick="editUser({{ $user->id }})">Edit</a>
                    <a href ="javascript:void(0);" onclick="deleteUser( {{ $user->id }} )">Delete</a>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>
