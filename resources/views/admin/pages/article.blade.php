{{-- ===== STATS ===== --}}
<div class="row g-4 mb-4 fade-in">

  <div class="col-xl-4 col-md-6">
    <div class="card stat-card">
      <div class="card-body">
        <p class="text-muted mb-2">Total Artikel</p>
        <h2 class="stat-value">{{ $totalArticles }}</h2>
      </div>
    </div>
  </div>

  <div class="col-xl-4 col-md-6">
    <div class="card stat-card">
      <div class="card-body">
        <p class="text-muted mb-2">Published</p>
        <h2 class="stat-value text-success">{{ $published }}</h2>
      </div>
    </div>
  </div>

  <div class="col-xl-4 col-md-6">
    <div class="card stat-card">
      <div class="card-body">
        <p class="text-muted mb-2">Draft</p>
        <h2 class="stat-value text-secondary">{{ $draft }}</h2>
      </div>
    </div>
  </div>

</div>

{{-- ===== LIST ===== --}}
<div class="card fade-in">
  <div class="card-header d-flex justify-content-between align-items-center">
    <h5 class="mb-0">Artikel Terbaru</h5>

    <div>
      <a href="{{ route('article.index') }}" class="btn btn-outline-secondary btn-sm">
        Lihat Semua
      </a>
      <a href="{{ route('article.create') }}" class="btn btn-primary btn-sm">
        <i class="bi bi-plus-lg"></i> Tulis Artikel
      </a>
    </div>
  </div>

  <div class="card-body">

    @forelse ($articles as $article)
      <div class="list-item mb-3">
        <div class="d-flex gap-3">

          {{-- THUMB --}}
          <div class="bg-light rounded"
               style="width:96px;height:96px;flex-shrink:0;
                      background:url('{{ asset($article->thumbnail ?? 'img/placeholder.jpg') }}')
                      center/cover;">
          </div>

          <div class="flex-grow-1">

            <div class="d-flex justify-content-between align-items-start mb-1">
              <h6 class="mb-1">{{ $article->title }}</h6>

              <span class="badge {{ $article->status === 'published' ? 'bg-success' : 'bg-secondary' }}">
                {{ ucfirst($article->status) }}
              </span>
            </div>

            <small class="text-muted d-flex align-items-center gap-2 mb-2">
              <div class="avatar" style="width:24px;height:24px;font-size:10px;">
                {{ strtoupper(substr($article->author->name,0,2)) }}
              </div>
              {{ $article->author->application?->full_name ?: $article->author->name }} •
              {{ $article->created_at->diffForHumans() }}
            </small>

            <div class="d-flex justify-content-between align-items-center">
              <small class="text-muted">
                Kategori: {{ $article->category ?? '-' }}
              </small>

              <div class="btn-group btn-group-sm">
                <a href="{{ route('article.edit', $article) }}"
                   class="btn btn-outline-secondary">
                  <i class="bi bi-pencil"></i>
                </a>

                <a href="{{ route('artikel.detail', $article) }}"
                   target="_blank"
                   class="btn btn-outline-primary">
                  <i class="bi bi-eye"></i>
                </a>
              </div>
            </div>

          </div>
        </div>
      </div>
    @empty
      <p class="text-muted text-center">Belum ada artikel</p>
    @endforelse

  </div>
</div>
