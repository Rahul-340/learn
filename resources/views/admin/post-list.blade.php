<div class="d-flex justify-content-between align-items-center">
    <h1>Posts</h1>
    <button type="button" class="btn btn-outline-primary btn-sm" data-bs-toggle="modal" data-bs-target="#userPostModal">Add
        Post</button>
</div>
<table class="table" id="postList">
    <thead>
        <tr>
            <th scope="col">
                <input type="checkbox" id="selectAll">
            </th>
            <th scope="col">Post Id</th>
            <th scope="col">Name</th>
            <th scope="col">Description</th>
            <th scope="col">Images</th>
            <th scope="col">Status</th>
            <th scope="col">Action</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($posts as $post)
            <tr>
                <td>
                    <input type="checkbox" name="post_ids[]" value="{{ $post->id }}" class="selectPost">
                </td>
                <th scope="row">{{ $post->id }}</th>
                <td>{{ $post->name }}</td>
                <td>{{ $post->description }}</td>
                <td style="max-width: 300px; overflow-x: auto; white-space: nowrap; overflow-y: hidden;">
                    @if ($post->images)
                        <div style="overflow-x: auto; white-space: nowrap;">
                            @foreach (json_decode($post->images) as $image)
                                <img src="{{ $image }}" alt="Post Image" class="post-image"
                                    style="max-width: 100px; height: auto; display: inline-block; margin-right: 10px;" />
                            @endforeach
                        </div>
                    @else
                        <p>No images available</p>
                    @endif
                </td>
                <td>
                    <button type="button"
                        onclick="userPostStatus({{ $post->id }}, '{{ $post->status == 'Deactive' ? 'Active' : 'Deactive' }}')"
                        class="btn-sm btn btn-outline-{{ $post->status == 'Deactive' ? 'danger' : 'success' }}">
                        {{ $post->status == 'Deactive' ? 'Deactive' : 'Active' }}
                    </button>
                </td>
                <td>
                    <a href ="javascript:void(0);" onclick="editPost({{ $post->id }})">Edit</a>
                    <a href ="javascript:void(0);" onclick="deletePost( {{ $post->id }} )">Delete</a>
                </td>
            </tr>
        @endforeach
    </tbody>
    <tfoot>
        <tr>
            <td colspan="3">
                <button id="deleteSelected" onclick="deleteMulti()" class="btn btn-danger">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash" viewBox="0 0 16 16">
                      <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5m2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5m3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0z"/>
                      <path d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4zM2.5 3h11V2h-11z"/>
                    </svg>
                </button>
            </td>
        </tr>
    </tfoot>
</table>
