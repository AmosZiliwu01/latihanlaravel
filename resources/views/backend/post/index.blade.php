@extends('layouts.main')
@section('title', 'Post')
@section('content')
    <div class="row">
        <div class="col-md-6 col-xl-12">
            <div class="card">
                <div class="card-body">
                    <div class="row align-items-center">
                        <div class="col-md-2">
                            <h6>List post</h6>
                        </div>
                        <div class="col-md-10">
                            <a href="#" class="btn btn-primary mb-3 float-end" data-bs-toggle="modal" data-bs-target="#addModal"><i class="fas fa-plus"></i> Add</a>
                        </div>
                    </div>
                    <table class="table table-striped">
                        <thead>
                        <tr>
                            <th>ID</th>
                            <th>Title</th>
                            <th>Description</th>
                            <th>Image</th>
                            <th>Category</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach ($posts as $post)
                            <tr>
                                <td>{{$loop->iteration}}</td>
                                <td>{{$post->title}}</td>
                                <td>{{$post->description}}</td>
                                <td>
                                    <img src="{{Storage::url('post/' . $post->image)}}"
                                         alt="post image"
                                         width="50"
                                         height="50">
                                </td>
                                <td>{{$post->category->name}}</td>
                                <td>
                                    <a href="#" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#updateModal{{$post->id}}">
                                        <i class="fas fa-edit"></i></a>

                                    <a href="#" onclick="ConfirmDelete({{$post->id}})" class="btn btn-danger"><i class="fas fa-trash"></i></a>
                                    <form id="delete-form{{$post->id}}" action="{{route('posts.delete', $post->id)}}" method="post">
                                        @csrf
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Add -->
    <div class="modal fade" id="addModal" tabindex="-1" aria-labelledby="addModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="addModalLabel">Form Add</h1>
                </div>
                <div class="modal-body">
                    <form action="{{route('posts.store')}}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="mb-3">
                            <label for="name">Title Post</label>
                            <input type="text" name="title" class="form-control" placeholder="Title Post">
                        </div>

                        <div class="mb-3">
                            <label for="description">Description Post</label>
                            <textarea type="text" name="description" class="form-control" placeholder="Description Post"></textarea>
                        </div>

                        <div class="mb-3">
                            <label for="image">Image Post</label>
                            <input type="file" name="image" class="form-control" accept="image/*">
                        </div>

                        <div class="mb-3">
                            <label for="category">Category</label>
                            <select name="category_id" class="form-control">
                                @foreach($categories as $row)
                                    <option value="{{$row->id}}">{{$row->name}}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Save changes</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Update -->
    @foreach ($posts as $post)
        <div class="modal fade" id="updateModal{{$post->id}}" tabindex="-1" aria-labelledby="updateModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="updateModalLabel">Form Update</h1>
                    </div>
                    <div class="modal-body">
                        <form action="{{route('posts.update', $post->id)}}" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="mb-3">
                                <label for="name">Title Post</label>
                                <input type="text" name="title" class="form-control" value="{{$post->title}}">
                            </div>

                            <div class="mb-3">
                                <label for="description">Description Post</label>
                                <textarea type="text" name="description" class="form-control">{{$post->description}}</textarea>
                            </div>

                            <div class="mb-3">
                                <label for="image">Image Post</label>
                                <br>
                                <img src="{{Storage::url('post/' . $post->image)}}"
                                     alt="post image"
                                     width="50"
                                     height="50"
                                    class="mb-2 mt-2">
                                <input type="file" name="image" class="form-control" accept="image/*">
                            </div>

                            <div class="mb-3">
                                <label for="category">Category</label>
                                <select name="category_id" class="form-control">
                                    @foreach($categories as $row)
                                        <option value="{{$row->id}}" {{$post->category_id == $row->id ? 'selected' : ''}}>{{$row->name}}</option>
                                    @endforeach
                                </select>
                            </div>

                            <input type="hidden" name="id" value="{{$post->id}}">
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-primary">Save changes</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    @endforeach

    <script>
        function ConfirmDelete(id) {
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
                    Swal.fire({
                        title: "Deleted!",
                        text: "Your file has been deleted.",
                        icon: "success"
                    }).then(() => {
                        document.getElementById('delete-form'+id).submit();
                    });
                }
            });
        }
    </script>
@endsection
