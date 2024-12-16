@extends('admin.layouts.master')

@section('content')
    <div class="container-fluid">

        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Category List</h1>
        </div>

        <div class="">
            <div class="row">
                <div class="col-4">
                    <div class="card">
                        <div class="card-body shadow">
                            <form action="{{ route('category#create') }}" method="post" class="p-3 rounded">
                                @csrf
                                <input type="text" name="subCategoryName" value="{{ old('subCategoryName') }}"
                                    class=" form-control @error('subCategoryName')
                                        is-invalid
                                    @enderror"
                                    placeholder="Category Name...">
                                @error('subCategoryName')
                                    <small class="invalid-feedback">{{ $message }}</small>
                                @enderror

                                <div class="form-floating my-3">
                                    <textarea
                                        class="form-control @error('description')
                                        is-invalid
                                    @enderror"
                                        name="description" placeholder="Description..." id="floatingTextarea">{{ old('description') }}</textarea>
                                    @error('description')
                                        <small class="invalid-feedback">{{ $message }}</small>
                                    @enderror
                                </div>

                                <div>
                                    <select name="categoryId" class="form-select px-3 border-light"
                                        aria-label="Parent category" id="">
                                        @if (count($parentCategories) != 0)
                                            <option value="">Choose Parent Category</option>
                                            @foreach ($parentCategories as $category)
                                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                                            @endforeach
                                        @endif
                                    </select>
                                </div>

                                <div class="my-3">
                                    <select name="role"
                                        class="form-select px-3 border-light @error('role')
                                    is-invalid
                                @enderror"
                                        aria-label="Sub-Category" id="">
                                        <option value="parent" @if (old('role') == 'parent') selected @endif>
                                            Parent-category
                                        </option>
                                        <option value="sub" @if (old('role') == 'sub') selected @endif>
                                            Sub-category
                                        </option>
                                    </select>
                                    @error('role')
                                        <small class="invalid-feedback">{{ $message }}</small>
                                    @enderror
                                </div>

                                <input type="submit" value="Create" class="btn btn-outline-success mt-3">
                            </form>
                        </div>
                    </div>
                </div>

                <div class="col ">
                    <h5 class="my-3">Sub-category Table</h5>

                    <table class="table table-hover shadow-sm ">
                        <thead class="bg-success text-white">
                            <tr>
                                <th>Name</th>
                                <th>Created Date</th>
                                <th>Type</th>
                                <th>Parent-category</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>

                            @if (count($categories) != 0)
                                @foreach ($categories as $item)
                                    <tr>
                                        <td>{{ $item->name }}</td>
                                        <td>{{ $item->created_at->format('Y-m-d') }}</td>
                                        <td>{{ $item->role }}</td>
                                        <td>
                                            @foreach ($parentCategories as $parentCategory)
                                                {{ $item->parent_category_id == $parentCategory->id ? $parentCategory->name : '' }}
                                            @endforeach
                                        </td>
                                        <td>
                                            <a href="" class="btn btn-sm btn-outline-secondary"> <i
                                                    class="fa-solid fa-pen-to-square"></i> </a>
                                            @if (Auth::user()->role == 'superadmin')
                                                <button type="button" class="btn btn-danger"
                                                    onclick="confirmDelete({{ $item->id }})">
                                                    <i class="fa-solid fa-trash"></i>
                                                </button>
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                            @else
                                <tr>
                                    <td colspan="5" class="text-muted text-center">There is no sub-category</td>
                                </tr>
                            @endif

                        </tbody>
                    </table>
                    <span class=" d-flex justify-content-end">{{ $categories->links() }}</span>

                    <h5 class="my-3">Parent-category Table</h5>

                    <table class="table table-hover shadow-sm ">
                        <thead class="bg-success text-white">
                            <tr>
                                <th>Name</th>
                                <th>Created Date</th>
                                <th>Type</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>

                            @if (count($parentCategories) != 0)
                                @foreach ($parentCategories as $parentCategory)
                                    <tr>
                                        <td>{{ $parentCategory->name }}</td>
                                        <td>{{ $parentCategory->created_at->format('Y-m-d') }}</td>
                                        <td>{{ $parentCategory->role }}</td>
                                        <td>
                                            <a href="" class="btn btn-sm btn-outline-secondary"> <i
                                                    class="fa-solid fa-pen-to-square"></i> </a>
                                            @if (Auth::user()->role == 'superadmin')
                                                <button type="button" class="btn btn-danger"
                                                    onclick="confirmDelete({{ $parentCategory->id }})">
                                                    <i class="fa-solid fa-trash"></i>
                                                </button>
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                            @else
                                <tr>
                                    <td colspan="4" class="text-muted text-center">There is no parent-category</td>
                                </tr>
                            @endif


                        </tbody>
                    </table>
                    <span class=" d-flex justify-content-end">{{ $parentCategories->links() }}</span>

                </div>

            </div>
        </div>

    </div>
@endsection

@section('js-script')
    <script>
        function confirmDelete($id) {
            const swalWithBootstrapButtons = Swal.mixin({
                customClass: {
                    confirmButton: "btn btn-success",
                    cancelButton: "btn btn-danger"
                },
                buttonsStyling: false
            });
            swalWithBootstrapButtons.fire({
                title: "Are you sure?",
                text: "You won't be able to revert this!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonText: "Yes, delete it!",
                cancelButtonText: "No, cancel!",
                reverseButtons: true
            }).then((result) => {
                if (result.isConfirmed) {
                    swalWithBootstrapButtons.fire({
                        title: "Deleted!",
                        text: "Your file has been deleted.",
                        icon: "success"
                    }).then(() => {
                        location.href = '/admin/category/delete/' + $id;
                    });

                } else if (
                    /* Read more about handling dismissals below */
                    result.dismiss === Swal.DismissReason.cancel
                ) {
                    swalWithBootstrapButtons.fire({
                        title: "Cancelled",
                        text: "Your category file is safe :)",
                        icon: "error"
                    });
                }
            });
        }
    </script>
@endsection
