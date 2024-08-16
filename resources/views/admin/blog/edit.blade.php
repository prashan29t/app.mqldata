@extends('layouts.layout')

@section('content')
<div class="container mt-5">
    <h1 class="mb-4">Edit Blog</h1>
    @if(session('error'))
    <div class="alert alert-danger">
        {{ session('error') }}
    </div>
    @endif

    @if($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif

    <form class="mb-5" action="{{ route('admin.blog.update', $blogArticle->id) }}" method="POST"
        enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="title" class="form-label">Title</label>
            <input type="text" class="form-control" id="title" name="title"
                value="{{ old('title', $blogArticle->title) }}" required>
        </div>

        <div class="mb-3">
            <label for="slug" class="form-label">Slug</label>
            <input type="text" class="form-control" id="slug" name="slug" value="{{ old('slug', $blogArticle->slug) }}">
        </div>

        <div class="mb-3">
            <label for="content" class="form-label">Content</label>
            <textarea class="form-control" id="content" name="content"
                rows="10">{{ old('content', $blogArticle->content) }}</textarea>
        </div>

        <div class="mb-3">
            <label for="meta_title" class="form-label">Meta Title</label>
            <input type="text" class="form-control" id="meta_title" name="meta_title"
                value="{{ old('meta_title', $blogArticle->meta_title) }}">
        </div>

        <div class="mb-3">
            <label for="meta_keywords" class="form-label">Meta Keywords</label>
            <input type="text" class="form-control" id="meta_keywords" name="meta_keywords"
                value="{{ old('meta_keywords', $blogArticle->meta_keywords) }}">
        </div>

        <div class="mb-3">
            <label for="meta_description" class="form-label">Meta Description</label>
            <textarea class="form-control" id="meta_description" name="meta_description"
                rows="3">{{ old('meta_description', $blogArticle->meta_description) }}</textarea>
        </div>

        <div class="mb-3">
            <label for="author" class="form-label">Author</label>
            <input type="text" class="form-control" id="author" name="author"
                value="{{ old('author', $blogArticle->author) }}">
        </div>

        <div class="mb-3">
            <label for="cover_image" class="form-label">Cover Image</label>
            @if($blogArticle->cover_image)
            <div class="mb-3">
                <img src="{{ asset('storage/' . $blogArticle->cover_image) }}" class="img-fluid" width="200"
                    alt="Current Cover Image">
            </div>
            @endif
            <input type="file" class="form-control" id="cover_image" name="cover_image">
            @if($blogArticle->cover_image)
            <small class="form-text text-muted">Leave this field blank if you don't want to change the cover
                image.</small>
            @endif
        </div>

        <div class="mb-3">
            <label for="is_published" class="form-label">Status</label>
            <select class="form-control" id="is_published" name="is_published" required>
                <option value="0" {{ old('is_published', $blogArticle->is_published) == 0 ? 'selected' : '' }}>Draft
                </option>
                <option value="1" {{ old('is_published', $blogArticle->is_published) == 1 ? 'selected' : '' }}>Published
                </option>
            </select>
        </div>


        <button type="submit" class="btn btn-primary">Update Blog</button>
    </form>
</div>
@endsection

@push('script')
<script src="https://cdn.tiny.cloud/1/rf61i8t5r7fwlolzhg8mb5k5k26s3eq5apsszcf3ib73e4ma/tinymce/7/tinymce.min.js"
    referrerpolicy="origin"></script>

<script>
tinymce.init({
    selector: 'textarea#content',
    plugins: 'anchor autolink charmap codesample emoticons image link lists media searchreplace table visualblocks wordcount checklist mediaembed casechange export formatpainter pageembed linkchecker a11ycheck typography inlinecss markdown',
    toolbar: 'undo redo | blocks fontfamily fontsize | bold italic underline strikethrough | link image media table mergetags | addcomment showcomments | spellcheckdialog a11ycheck typography | align lineheight | checklist numlist bullist indent outdent | emoticons charmap | removeformat',
    tinycomments_mode: 'embedded',
    tinycomments_author: 'Author name',
    mergetags_list: [{
            value: 'First.Name',
            title: 'First Name'
        },
        {
            value: 'Email',
            title: 'Email'
        },
    ],
    ai_request: (request, respondWith) => respondWith.string(() => Promise.reject(
        "See docs to implement AI Assistant")),
});
</script>
@endpush