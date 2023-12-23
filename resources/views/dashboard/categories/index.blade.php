@extends('dashboard.layouts.main')

@section('content')
    @can('admin')
        <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
            <h1 class="h2">All Categories</h1>
        </div>

        @if (session()->has('success'))
            <div class="alert alert-primary alert-dismissible fade show col-9 fw-bold fs-5 text-center" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        <div class="table-responsive small">
            <!-- Button trigger modal create -->
            <button type="button" class="btn btn-primary mb-3 formModalCreate" data-bs-toggle="modal" data-bs-target="#formModalCreate">
                Create new category
            </button>
            <table class="table table-striped fs-5 text-center">
                <thead>
                    <th class="px-4 text-white" style="background-color: #DE1616;">#</th>
                    <th class="col-6 text-white" style="background-color: #DE1616;">Category Name</th>
                    <th class="col-6 text-white" style="background-color: #DE1616;">Category Slug</th>
                    <th class="col-0 text-white" colspan="3" style="background-color: #DE1616;">Action</th>
                </thead>
                <tbody>
                    @foreach ($categories as $category)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td style="text-align: justify">{{ $category->name }}</td>
                            <td style="text-align: justify">{{ $category->slug }}</td>
                            <td>
                                <button type="button" class="badge bg-warning border-0 text-decoration-none formModalEdit" data-bs-toggle="modal" data-bs-target="#formModalEdit" value="{{ $category->id }}">
                                    Edit
                                </button>
                            </td>
                            <td>
                                <form action="/dashboard/categories/{{ $category->slug }}" method="post">
                                    @method('delete')
                                    @csrf
                                    <button class="badge bg-danger border-0 text-decoration-none" onclick="return confirm('Are you sure?')">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>


        <!-- Modal Create -->
        <div class="modal fade" id="formModalCreate" tabindex="-1" aria-labelledby="formModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="formModalLabel">Create Category</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form action="/dashboard/categories" method="post">
                            @csrf

                            <div class="mb-3">
                                <label for="name" class="form-label">Category Name</label>
                                <input type="text" class="form-control @error('name') is-invalid @enderror" id="nameCreate" name="name" placeholder="Category Name" value="{{ old('name') }}">
                                @error('name')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="slug" class="form-label">Category Slug</label>
                                <input type="text" class="form-control @error('slug') is-invalid @enderror" id="slugCreate" name="slug" placeholder="Category Slug" value="{{ old('slug') }}">
                                @error('slug')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-primary">Add Category</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>


        <!-- Modal Edit -->
        <div class="modal fade" id="formModalEdit" tabindex="-1" aria-labelledby="formModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="formModalLabel">Update Category</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form action="/dashboard/categories/{{ $category->slug }}" method="post">
                            @csrf
                            @method('patch')

                            <input type="hidden" name="category_id" id="category_id">

                            <div class="mb-3">
                                <label for="name" class="form-label">Category Name</label>
                                <input type="text" class="form-control @error('name') is-invalid @enderror" id="nameEdit" name="name" placeholder="Category Name" value="{{ old('name') }}">
                                @error('name')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="slug" class="form-label">Category Slug</label>
                                <input type="text" class="form-control @error('slug') is-invalid @enderror" id="slugEdit" name="slug" placeholder="Category Slug" value="{{ old('slug') }}">
                                @error('slug')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-primary">Edit Category</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    @endcan
@endsection