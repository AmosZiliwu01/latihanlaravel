@extends('layouts.main')
@section('title', 'Category')
@section('content')
    <div class="row">
        <div class="col-md-6 col-xl-12">
            <div class="card">
                <div class="card-body">
                    <div class="row align-items-center">
                        <div class="col-md-2">
                            <h6>List category</h6>
                        </div>
                        <div class="col-md-10">
                            <a href="#" class="btn btn-primary mb-3 float-end" data-bs-toggle="modal" data-bs-target="#addModal"><i class="fas fa-plus"></i> Add</a>
                        </div>
                    </div>
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Category Name</th>
                                <th>Description</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                        @foreach ($categories as $category)
                            <tr>
                                <td>{{$loop->iteration}}</td>
                                <td>{{$category->name}}</td>
                                <td>{{$category->description}}</td>
                                <td>

                                    <a href="#" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#updateModal{{$category->id}}"><i class="fas fa-edit"></i></a>
                                    <a href="#" onclick="ConfirmDelete({{$category->id}})" class="btn btn-danger"><i class="fas fa-trash"></i></a>
                                    <form id="delete-form{{$category->id}}" action="{{route('category.delete', $category->id)}}" method="post">
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
                    <form action="{{route('category.store')}}" method="post">
                        @csrf
                        <div class="mb-3">
                            <label for="name">Category Name</label>
                            <input type="text" name="name" class="form-control" placeholder="Category Name">
                        </div>

                        <div class="mb-3">
                            <label for="description">Category Description</label>
                            <textarea type="text" name="description" class="form-control" placeholder="Category Description"></textarea>
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
    @foreach ($categories as $category)
    <div class="modal fade" id="updateModal{{$category->id}}" tabindex="-1" aria-labelledby="updateModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="updateModalLabel">Form Update</h1>
                </div>
                <div class="modal-body">
                    <form action="{{route('category.update', $category->id)}}" method="post">
                        @csrf
                        <div class="mb-3">
                            <label for="name">Category Name</label>
                            <input type="text" name="name" class="form-control" value="{{$category->name}}">
                        </div>

                        <div class="mb-3">
                            <label for="description">Category Description</label>
                            <textarea type="text" name="description" class="form-control">{{$category->description}}</textarea>
                        </div>

                        <input type="hidden" name="id" value="{{$category->id}}">
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
