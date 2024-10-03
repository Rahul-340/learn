<script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4="
    crossorigin="anonymous"></script>

<link href="https://cdn.datatables.net/2.1.7/css/dataTables.bootstrap.min.css" rel="stylesheet">
<script src="https://cdn.datatables.net/2.1.7/js/dataTables.min.js"></script>
<script src="https://cdn.datatables.net/2.1.7/js/dataTables.bootstrap.min.js"></script>

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.14.1/dist/sweetalert2.min.css">
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.14.1/dist/sweetalert2.all.min.js"></script>

<script>
    $(document).ready(function() {
        $('#userList').DataTable();
    });

    $('#saveUserPostForm').on('click', function(e) {
        event.preventDefault(e);
        var form = $('#userPostForm')[0];
        var formData = new FormData(form);
        var url = '{{ route('user.userpost') }}';
        $.ajax({
            url: url,
            type: 'POST',
            data: formData,
            contentType: false,
            processData: false,
            cache: false,
            success: function(result) {
                if (result.status == 200) {
                    $('#userPostModal').modal('hide');
                    Swal.fire({
                        title: "Good!",
                        text: result.message,
                        icon: "success",
                        timer: 1000,
                    }).then(function() {
                        location.reload();
                    });
                } else {
                    Swal.fire({
                        title: "!",
                        text: result.message,
                        icon: "error",
                        timer: 1000,
                    });
                }
            },
            error: function(result) {
                alert(result);
            },
        });
    });

    function editUser(userId) {
        var id = userId
        var url = '{{ route('admin.edituser', ':id') }}';
        url = url.replace(':id', id);
        $.ajax({
            url: url,
            type: 'get',
            success: function(result) {
                // console.log(result);
                $('#editUserId').val(result.data.id);
                $('#editUserName').val(result.data.name);
                $('#editUserEmail').val(result.data.email);
            },
            error: function(result) {
                alert(result);
            },

        });
        $('#editUserAddModal').modal('show');

    }

    $('#saveEditUserForm').on('click', function() {
        var formData = $('#editUserForm').serialize();
        var url = '{{ route('admin.updateuser') }}';
        $.ajax({
            url: url,
            type: 'POST',
            data: formData,
            success: function(result) {
                if (result.status == 200) {
                    $('#userAddModal').modal('hide');
                    Swal.fire({
                        title: "Good!",
                        text: result.message,
                        icon: "success",
                        timer: 1000,
                    }).then(function() {
                        location.reload();
                    });
                } else {
                    Swal.fire({
                        title: "!",
                        text: result.message,
                        icon: "error",
                        timer: 1000,
                    });
                }
            },
            error: function(result) {
                alert(result);
            },
        });
    });

    function deleteUser(userId) {

        var id = userId
        var url = '{{ route('admin.deleteuser', ':id') }}';
        url = url.replace(':id', id);
        Swal.fire({
            title: "Are you sure?",
            text: "You won't be able to revert this!",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Yes, delete it!"
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: url,
                    type: 'get',
                    success: function(result) {
                        if (result.status == 200) {
                            Swal.fire({
                                toast: true,
                                timer: 1000,
                                icon: "success",
                                position: "top-end",
                                title: result.message,
                                showConfirmButton: false,
                            }).then(function() {
                                location.reload();
                            });
                        } else {
                            Swal.fire({
                                title: "!",
                                text: result.message,
                                icon: "error",
                                timer: 1000,
                            }).then(function() {
                                location.reload();
                            });
                        }
                    },
                    error: function(result) {},

                });
            }
        });
    }

    function userStatus(userId, userStatus) {
        var id = userId;
        var userStatus = userStatus;
        var url = '{{ route('admin.userstatus', ':id') }}?status=' + userStatus;
        url = url.replace(':id', id);
        $.ajax({
            url: url,
            type: 'get',
            success: function(result) {
                if (result.status == 200) {
                    $('#userAddModal').modal('hide');
                    Swal.fire({
                        title: "Good!",
                        text: result.message,
                        icon: "success",
                        timer: 1000,
                    }).then(function() {
                        location.reload();
                    });
                } else {
                    Swal.fire({
                        title: "!",
                        text: result.message,
                        icon: "error",
                        timer: 1000,
                    });
                }
            },
            error: function(result) {
                alert(result);
            },

        });
    }

    function imgPreview() {
        var images = event.target.files;
        $('#PostPreview').empty();
        $.each(images, function(index, file) {
            var reader = new FileReader();
            reader.onload = function(e) {
                var img = $('<img />', {
                    src: e.target.result,
                    alt: 'your image',
                    width: 100,
                    height: 100
                });
                $('#PostPreview').append(img);
            };
            reader.readAsDataURL(file);
        });
    }
</script>
