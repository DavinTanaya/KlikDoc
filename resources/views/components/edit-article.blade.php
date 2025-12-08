@extends('article-layout')

@section('title', 'Buat Artikel')

@push('styles')
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;600;700&display=swap" rel="stylesheet">

    <style>
        .article-wrapper {
            max-width: 980px;
            margin: 0 auto;
            padding: 32px 16px 80px;
            font-family: 'Plus Jakarta Sans', sans-serif;
        }

        .card {
            background: #fff;
            border-radius: 14px;
            padding: 24px;
            box-shadow: 0 10px 40px rgba(0, 0, 0, .08);
        }

        label {
            font-weight: 600;
            display: block;
            margin-bottom: 6px;
        }

        .input {
            width: 100%;
            padding: 10px 12px;
            border-radius: 10px;
            border: 1px solid #e5e7eb;
            font-size: 14px;
        }

        .form-group {
            margin-bottom: 16px;
        }

        .actions {
            display: flex;
            justify-content: space-between;
            margin-top: 20px;
        }

        .btn {
            border-radius: 999px;
            padding: 10px 18px;
            font-weight: 600;
            border: none;
            cursor: pointer;
        }

        .btn-primary {
            background: #2563eb;
            color: #fff;
        }

        .btn-secondary {
            background: #e5e7eb;
        }
    </style>
@endpush

@section('article-content')
    <div class="article-wrapper">

        <h1 class="mb-4">Buat Artikel</h1>

        <form method="POST" action="{{ route('article.update', $article) }}" enctype="multipart/form-data">

            @csrf
            @method('PUT')
            <div class="card">

                <div class="form-group">
                    <label>Judul</label>
                    <input type="text" name="title" id="title" class="input" onkeyup="generateSlug(this.value)"
                        value='{{ $article->title }}' required>
                </div>

                <div class="form-group">
                    <label>Slug</label>
                    <input type="text" name="slug" id="slug" class="input" value="{{ $article->slug }}"
                        required>
                </div>

                <div class="form-group">
                    <label>Kategori</label>
                    <input type="text" name="category" class="input" placeholder="Penyakit Dalam"
                        value="{{ $article->category }}">
                </div>

                <div class="form-group">
                    <label>Thumbnail</label>
                    <img src="{{ asset($article->thumbnail) }}" width="200" height="200" alt="">
                    <input type="file" name="thumbnail" class="input">
                </div>

                <div class="form-group">
                    <label>Konten Artikel</label>
                    <textarea name="content" class="editor">{{ $article->content }}</textarea>
                </div>

                <div class="actions">
                    <a href="{{ route('article.index') }}" class="btn btn-secondary">
                        Batal
                    </a>

                    <button class="btn btn-primary" name="status" value="published">
                        Edit Artikel
                    </button>
                </div>

            </div>
        </form>
    </div>
@endsection

@push('scripts')
    <script src="https://cdn.tiny.cloud/1/lnghom6rpqk5lln3tlzw9n0bhfz88om5t8to2aapk2rijsok/tinymce/8/tinymce.min.js">
    </script>

    <script>
        tinymce.init({
            selector: 'textarea.editor',
            plugins: [
                'anchor', 'autolink', 'charmap', 'codesample', 'emoticons', 'link', 'lists',
                'media', 'searchreplace', 'table', 'visualblocks', 'wordcount',
                'checklist', 'mediaembed', 'casechange', 'formatpainter',
                'pageembed', 'a11ychecker', 'tinymcespellchecker',
                'permanentpen', 'powerpaste', 'advtable', 'advcode', 'markdown'
            ],
            toolbar: 'undo redo | blocks | bold italic underline | align | ' +
                'bullist numlist | link media table | removeformat',
            height: 520,
        });

        function generateSlug(text) {
            document.getElementById('slug').value =
                text.toLowerCase()
                .replace(/[^a-z0-9]+/g, '-')
                .replace(/(^-|-$)/g, '');
        }
    </script>
@endpush
