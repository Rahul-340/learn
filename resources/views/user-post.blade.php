<h1>Posts</h1>
{{-- 
@foreach ($posts as $post)
    <div class="post">
        <h2>{{ $post->name }}</h2>
        <div class="post-description">
            {!! $post->description !!}
        </div>
        <div class="post-images">
            @if ($post->images)
                @foreach (json_decode($post->images) as $image)
                    <img src="{{ $image }}" alt="Post Image" class="post-image"
                        style="max-width: 100px; height: auto;" />
                @endforeach
            @else
                <p></p>
            @endif
        </div>
    </div>
@endforeach --}}


<table class="table" id="userList">
    <thead>
        <tr>
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
                    <button type="button" onclick='userStatus({{ $post->id }},{{ $post->status == "Deactive" ? "Active" : "Deactive" }})'
                        class="btn-sm btn btn-outline-{{ $post->status == 'Deactive' ? 'danger' : 'success' }}">
                        {{ $post->status == 'Deactive' ? 'Deactive' : 'Active' }}
                    </button>
                </td>
                <td>
                    <a href ="javascript:void(0);" onclick="editUser({{ $post->id }})">Edit</a>
                    <a href ="javascript:void(0);" onclick="deleteUser( {{ $post->id }} )">Delete</a>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>
