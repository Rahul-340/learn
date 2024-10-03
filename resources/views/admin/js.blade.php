<script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4="
    crossorigin="anonymous"></script>

<link href="https://cdn.datatables.net/2.1.7/css/dataTables.bootstrap.min.css" rel="stylesheet">
<script src="https://cdn.datatables.net/2.1.7/js/dataTables.min.js"></script>
<script src="https://cdn.datatables.net/2.1.7/js/dataTables.bootstrap.min.js"></script>

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.14.1/dist/sweetalert2.min.css">
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.14.1/dist/sweetalert2.all.min.js"></script>

<script>
    $(document).ready(function() {
        UserData();
    });

    function UserData() {
        $('#posts-tab').removeClass('active');
        $('#users-tab').addClass('active');
        var url = '{{ route('admin.user.list') }}';
        $.ajax({
            url: url,
            type: 'get',
            success: function(result) {
                console.log(result);
                $('#PageContent').empty().append(result);
                $('#userList').DataTable();
            },
        });
    };

    function UserPostData() {
        $('#users-tab').removeClass('active');
        $('#posts-tab').addClass('active');
        var url = '{{ route('admin.userpost.list') }}';
        $.ajax({
            url: url,
            type: 'get',
            success: function(result) {
                console.log(result);
                $('#PageContent').empty();
                $('#PageContent').append(result);
                $('#postList').DataTable();
                $('#postList').on('click', '#selectAll', function() {
                    // Check/uncheck all checkboxes based on the state of the "Select All" checkbox
                    $('.selectPost').prop('checked', this.checked);
                });

                // Event delegation for the individual checkboxes
                $('#postList').on('click', '.selectPost', function() {
                    // Check the state of the individual checkboxes
                    if ($('.selectPost:checked').length !== $('.selectPost').length) {
                        $('#selectAll').prop('checked', false);
                    } else {
                        $('#selectAll').prop('checked', true);
                    }
                });
            },
        });
    };

    $('#saveAddUserForm').on('click', function() {
        var formData = $('#addUserForm').serialize();
        var url = '{{ route('admin.adduser') }}';
        $.ajax({
            url: url,
            type: 'POST',
            data: formData,
            success: function(result) {
                if (result.status == 200) {
                    $('#userAddModal').modal('hide');
                    $('#users-tab').click();
                    Swal.fire({
                        title: result.message,
                        icon: "success",
                        timer: 2000,
                        toast: true,
                        position: "top-end",
                        showConfirmButton: false,
                    }).then(function() {
                        UserData();
                    });
                } else {
                    Swal.fire({
                        toast: true,
                        position: "top-end",
                        showConfirmButton: false,
                        title: result.message,
                        icon: "error",
                        timer: 2000,
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
                    $('#editUserAddModal').modal('hide');
                    Swal.fire({
                        toast: true,
                        position: "top-end",
                        showConfirmButton: false,
                        title: result.message,
                        icon: "success",
                        timer: 2000,
                    }).then(function() {
                        UserData();
                    });
                } else {
                    Swal.fire({
                        toast: true,
                        position: "top-end",
                        showConfirmButton: false,
                        title: result.message,
                        icon: "error",
                        timer: 2000,
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
                                timer: 2000,
                                icon: "success",
                                position: "top-end",
                                title: result.message,
                                showConfirmButton: false,
                            }).then(function() {
                                location.reload();
                            });
                        } else {
                            Swal.fire({
                                toast: true,
                                position: "top-end",
                                showConfirmButton: false,
                                title: result.message,
                                icon: "error",
                                timer: 2000,
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
                        title: result.message,
                        icon: "success",
                        timer: 2000,
                        toast: true,
                        position: "top-end",
                        showConfirmButton: false,
                    }).then(function() {
                        UserData();
                    });
                } else {
                    Swal.fire({
                        toast: true,
                        position: "top-end",
                        showConfirmButton: false,
                        title: result.message,
                        icon: "error",
                        timer: 2000,
                    });
                }
            },
            error: function(result) {
                alert(result);
            },

        });
    }

    $('#saveUserPostForm').on('click', function(e) {
        e.preventDefault(e);
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
                        toast: true,
                        position: "top-end",
                        showConfirmButton: false,
                        title: result.message,
                        icon: "success",
                        timer: 2000,
                    }).then(function() {
                        UserPostData();
                    });
                } else {
                    Swal.fire({
                        toast: true,
                        position: "top-end",
                        showConfirmButton: false,
                        title: result.message,
                        icon: "error",
                        timer: 2000,
                    });
                }
            },
            error: function(result) {
                alert(result);
            },
        });
    });

    function imgPreview() {
        var images = event.target.files;
        $('.PostPreview').empty();
        $.each(images, function(index, file) {
            var reader = new FileReader();
            reader.onload = function(e) {
                var img = $('<img />', {
                    src: e.target.result,
                    alt: 'your image',
                    width: 100,
                    height: 100
                });
                $('.PostPreview').append(img);
            };
            reader.readAsDataURL(file);
        });
    }

    function userPostStatus(postId, postStatus) {
        var id = postId;
        var Status = postStatus;
        var url = "{{ route('admin.userpoststatus', ':id') }}?status=" + Status;
        url = url.replace(':id', id);
        $.ajax({
            url: url,
            type: 'get',
            success: function(result) {
                if (result.status == 200) {
                    Swal.fire({
                        toast: true,
                        position: "top-end",
                        showConfirmButton: false,
                        title: result.message,
                        icon: "success",
                        timer: 2000,
                    }).then(function() {
                        UserPostData();
                    });
                } else {
                    Swal.fire({
                        toast: true,
                        position: "top-end",
                        showConfirmButton: false,
                        title: result.message,
                        icon: "error",
                        timer: 2000,
                    });
                }
            },
            error: function(result) {
                alert(result);
            },

        });
    }

    // Edit Post
    function editPost(postId) {
        var id = postId
        var url = '{{ route('admin.editpost', ':id') }}';
        url = url.replace(':id', id);
        $.ajax({
            url: url,
            type: 'get',
            success: function(result) {
                $('#editPostId').val(result.data.id);
                $('#editPostName').val(result.data.name);
                $('#editPostDes').val(result.data.description);
                var images = typeof result.data.images === 'string' ? JSON.parse(result.data.images) :
                    result.data.images;
                $('.PostPreview').empty();
                $.each(images, function(index, file) {
                    var img = $('<img />', {
                        src: file,
                        alt: 'your image',
                        width: 100,
                        height: 100
                    });
                    $('.PostPreview').append(img);
                });
            },
            error: function(jqXHR, textStatus, errorThrown) {
                console.error("AJAX error: ", textStatus, errorThrown);
                alert("Error occurred: " + textStatus);
            },

        });
        $('#editPostModal').modal('show');

    }

    $('#saveEditPostForm').on('click', function(e) {
        e.preventDefault();
        var form = $('#editPostForm')[0];
        var formData = new FormData(form);
        var url = '{{ route('admin.updatepost') }}';
        // console.log(formData);

        $.ajax({
            url: url,
            type: 'POST',
            data: formData,
            contentType: false,
            processData: false,
            cache: false,
            success: function(result) {
                if (result.status == 200) {
                    $('#editPostModal').modal('hide');
                    Swal.fire({
                        toast: true,
                        position: "top-end",
                        showConfirmButton: false,
                        title: result.message,
                        icon: "success",
                        timer: 2000,
                    }).then(function() {
                        UserPostData();
                    });
                } else {
                    Swal.fire({
                        toast: true,
                        position: "top-end",
                        showConfirmButton: false,
                        title: result.message,
                        icon: "error",
                        timer: 2000,
                    });
                }
            },
            error: function(result) {
                alert(result);
            },
        });
    });

    function deleteMulti() {
        // Get selected checkbox values
        var selectedIds = [];
        $('.selectPost:checked').each(function() {
            selectedIds.push($(this).val());
        });

        // Check if any checkbox is selected
        if (selectedIds.length === 0) {
            alert("Please select at least one post to delete.");
            return;
        }

        // Confirm delete action
        if (confirm("Are you sure you want to delete the selected posts?")) {
            // AJAX request to delete selected posts
            $.ajax({
                url: '{{ route('admin.deletepost') }}', // Update with your delete route
                method: 'POST',
                data: {
                    ids: selectedIds,
                    _token: '{{ csrf_token() }}' // Include CSRF token for security
                },
                success: function(response) {
                    alert(response.message); // Show success message
                    Swal.fire({
                        timer: 2000,
                        icon: "success",
                        title: response.message,
                        toast: true,
                        position: "top-end",
                        showConfirmButton: false,
                    }).then(function() {
                        UserPostData();
                    });
                    // Reload or update the DataTable
                    // $('#postList').DataTable().ajax.reload(); // Reload DataTable data
                },
                error: function(xhr) {
                    alert("An error occurred while deleting posts.");
                }
            });
        }
    }
</script>
