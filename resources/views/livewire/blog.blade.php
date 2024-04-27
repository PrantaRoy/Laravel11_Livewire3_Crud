<div>
    <div class="row">
        <div class="col-lg-3">
            @if($updateBlog)
                @include('livewire.blog_edit')
            @else
                @include('livewire.blog_create')
            @endif 
        </div>
        <div class="col-lg-9">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">All Blogs</h3>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                <table class="table">
                    <thead>
                        <th>#</th>
                        <th>Title</th>
                        <th>Author</th>
                        <th>Created</th>
                        <th>Description</th>
                        <th>Action</th>
                    </thead>
                    <tbody>
                        @foreach ($blogs as $blog)
                            <tr>
                                <th scope="row">{{$loop->index+1}}</th>
                                <td>{{$blog->title}}</td>
                                <td>{{@$blog->user->name}}</td>
                                <td>{{$blog->created_at}}</td>
                                <td>{{$blog->description}}</td>
                                <td>
                                    <button wire:click="edit({{$blog->id}})" class="btn btn-primary btn-sm">Edit</button>
                                    <button onclick="deleteBlog({{$blog->id}})" class="btn btn-danger btn-sm">Delete</button>
                                </td>
                          </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
                </div>
            </div>
        </div>
    </div>
</div>
@push('scripts')
<script>
    function deleteBlog(id){
        if(confirm("Are you sure to delete this blog?"))
            window.livewire.emit('deleteBlog',id);
    }
</script>
@endpush

