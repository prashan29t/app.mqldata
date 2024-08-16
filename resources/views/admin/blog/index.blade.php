@extends('layouts.layout')

@section('title', 'Blog List')

@section('content')
<div class="container-fluid">
    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3 d-flex justify-content-between align-items-center">
            <h6 class="m-0 font-weight-bold text-primary">All Blogs</h6>
            <a href="{{ route('admin.blog.create') }}" class="btn btn-primary">Add New Blog</a>
        </div>
        <div class="card-body">

            <!-- Success Message -->
            @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
            @endif

            <!-- Error Message -->
            @if(session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
            @endif

            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Title</th>
                            <th>Cover Image</th> <!-- New column for cover image -->
                            <th>Published</th>
                            <th>Published At</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>Title</th>
                            <th>Cover Image</th> <!-- New column for cover image -->
                            <th>Published</th>
                            <th>Published At</th>
                            <th>Actions</th>
                        </tr>
                    </tfoot>
                    <tbody>
                        @foreach($blogArticles as $blog)
                        <tr>
                            <td>{{ $blog->title }}</td>
                            <td>
                                @if($blog->cover_image)
                                <img src="{{ asset('storage/' . $blog->cover_image) }}" alt="Cover Image" width="100">
                                @else
                                N/A
                                @endif
                            </td>
                            <td>{{ $blog->is_published ? 'Yes' : 'No' }}</td>
                            <td>{{ $blog->created_at ? $blog->created_at->format('Y-m-d H:i:s') : 'N/A' }}</td>
                            <td>
                                <a href="{{ route('admin.blog.edit', $blog->id) }}" class="btn btn-sm btn-warning">
                                    <i class="fas fa-edit" style="color: #ffffff;"></i>
                                </a>
                                <button class="btn btn-sm btn-danger" onclick="confirmDelete('{{ $blog->id }}')">
                                    <i class="fas fa-trash-alt" style="color: #ffffff;"></i>
                                </button>
                                <form id="delete-form-{{ $blog->id }}"
                                    action="{{ route('admin.blog.destroy', $blog->id) }}" method="POST"
                                    style="display: none;">
                                    @csrf
                                    @method('DELETE')
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
@endsection

@push('script')
<script>
$(document).ready(function() {
    $('#dataTable').DataTable();
});

function confirmDelete(blogId) {
    Swal.fire({
        title: 'Are you sure?',
        text: "You won't be able to revert this!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, delete it!'
    }).then((result) => {
        if (result.isConfirmed) {
            document.getElementById('delete-form-' + blogId).submit();
        }
    })
}
</script>
@endpush