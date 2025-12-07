@extends('article-layout')

@section('title', 'Daftar Artikel')

@section('body')
  <div class="container py-4">

    <div class="d-flex justify-content-between align-items-center mb-3">
      <h3>📚 Daftar Artikel</h3>

      <a href="{{ route('article.create') }}" class="btn btn-primary">
        + Tulis Artikel
      </a>
    </div>
    <div class="row align-items-center mb-3">
      <div class="col-md-6">
        <form method="GET" action="{{ route('article.index') }}" class="d-flex gap-2">

          <input type="text" name="q" value="{{ request('q') }}" class="form-control"
            placeholder="Cari judul, kategori, atau isi artikel...">

          <button class="btn btn-outline-secondary">
            🔍 Cari
          </button>

          @if (request('q'))
            <a href="{{ route('article.index') }}" class="btn btn-outline-danger">
              Reset
            </a>
          @endif

        </form>
      </div>
    </div>

    <div class="table-responsive">
      <table class="table-hover table align-middle">
        <thead class="table-light">
          <tr>
            <th>Judul</th>
            <th>Penulis</th>
            <th>Status</th>
            <th>Tanggal</th>
            <th width="20%" class="text-end">Aksi</th>
          </tr>
        </thead>

        <tbody>
          @forelse ($articles as $article)
            <tr>

              <td>
                <strong>{{ $article->title }}</strong>
                <div class="text-muted small">{{ $article->category }}</div>
              </td>

              <td>
                {{ $article->author->name }}
                <span class="badge bg-secondary">
                  {{ $article->author_role }}
                </span>
              </td>

              <td>
                @if ($article->status === 'published')
                  <span class="badge bg-success">Published</span>
                @else
                  <span class="badge bg-warning text-dark">Draft</span>
                @endif
              </td>

              <td>
                {{ $article->created_at->format('d M Y') }}
              </td>

              <td class="text-end">

                @if (auth()->user()->role === 'admin' || auth()->id() === $article->author_id)
                  <a href="{{ route('article.edit', $article) }}" class="btn btn-outline-primary btn-sm">
                    Edit
                  </a>
                @endif

                @if (auth()->user()->role === 'admin')
                  @if ($article->status === 'draft')
                    <form action="{{ route('article.approve', $article) }}" method="POST" class="d-inline">
                      @csrf
                      <button class="btn btn-success btn-sm">
                        Approve
                      </button>
                    </form>
                  @else
                    <form action="{{ route('article.unpublish', $article) }}" method="POST" class="d-inline"
                      onsubmit="return confirm('Unpublish artikel ini?')">
                      @csrf
                      <button class="btn btn-outline-danger btn-sm">
                        Unpublish
                      </button>
                    </form>
                  @endif
                @endif

              </td>


            </tr>
          @empty
            <tr>
              <td colspan="5" class="text-muted text-center">
                Belum ada artikel
              </td>
            </tr>
          @endforelse
        </tbody>
      </table>
    </div>

    <div class="mt-3">
      {{ $articles->links() }}
    </div>

  </div>
@endsection
