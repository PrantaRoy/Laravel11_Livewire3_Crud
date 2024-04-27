<div class="card">
                <div class="card-header">
                    <h3 class="card-title">{{ $updateBlog ? 'Edit' : 'Add New '}} Blog</h3> 
                </div>
                <div class="card-body">
                    @if(session()->has('success'))
                        <div class="alert alert-success" role="alert">
                            {{ session()->get('success') }}
                        </div>
                    @endif

                    @if(session()->has('error'))
                        <div class="alert alert-danger" role="alert">
                            {{ session()->get('error') }}
                        </div>
                    @endif

                    <div class="mt-2">
                        <label class="form-label">Title </label>
                        <input type="text" class="form-control" wire:model="title" value="{{@$title}}">
                        @error('title')
                            <div class="invalid-feedback">
                                {{$message}}
                          </div>
                        @enderror
                    </div>

                    <div class="mt-2">
                        <label class="form-label">Description</label>
                        <textarea class="form-control" wire:model="description">
                            
                        </textarea>
                        @error('description')
                            <div class="invalid-feedback">
                                {{$message}}
                          </div>
                        @enderror
                    </div>
                    <div class="mt-2">
                        <button class="btn btn-primary"  wire:click.prevent="{{$updateBlog ? 'updateBlog('.$id.')' : 'createBlog()'}}">{{ $updateBlog ? 'Update' : 'Save'}}</button>
                    </div>

                </div>
            </div>