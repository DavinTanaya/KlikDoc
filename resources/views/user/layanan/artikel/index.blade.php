@extends('layout')

@section('title', 'KlikDoc | Artikel Kesehatan')

@push('styles')
  {{-- Pastikan CSS global/konsultasi yang tadi kamu buat sudah diload, 
         lalu load CSS khusus artikel ini di bawahnya --}}
  <link rel="stylesheet" href="{{ asset('css/user/layanan/artikel/styles.css') }}">
@endpush

@section('body')
  <div class="artikel-page">
    <div class="split-container">

      {{-- SISI KIRI: Sidebar (Search, Kategori, Trending) --}}
      <aside class="split-sidebar">
        <div class="sidebar-header">
          <h2>Wawasan<span class="dot">.</span></h2>
          <p>Berita & tips kesehatan terpercaya.</p>
        </div>

        {{-- Fitur 1: Search Artikel --}}
        <div class="sidebar-widget search-widget">
          <form method="GET" action="{{ route('artikel') }}">
            <div class="input-icon-wrapper">
              <input type="text" name="q" value="{{ request('q') }}" placeholder="Cari topik (mis: Diabetes)..."
                class="search-input">
            </div>
          </form>

        </div>

        {{-- Fitur 2: Topik Populer (Pengganti Widget Jadwal) --}}
        <div class="sidebar-widget topic-widget">
          <div class="widget-header">
            <span>
              <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                stroke-width="2">
                <path d="M4 19.5A2.5 2.5 0 0 1 6.5 17H20"></path>
                <path d="M6.5 2H20v20H6.5A2.5 2.5 0 0 1 4 19.5v-15A2.5 2.5 0 0 1 6.5 2z"></path>
              </svg>
              Topik Hangat
            </span>
          </div>
          <div class="topic-cloud">
            <a href="{{ route('artikel') }}" class="topic-tag {{ !request('category') ? 'active' : '' }}">
              Semua
            </a>

            @foreach ($categories as $cat)
              <a href="{{ route('artikel', ['category' => $cat]) }}"
                class="topic-tag {{ request('category') === $cat ? 'active' : '' }}">
                #{{ Str::slug($cat, '') }}
              </a>
            @endforeach
          </div>

        </div>

        {{-- Fitur 3: Artikel Trending (List Compact) --}}
        <div class="sidebar-widget trending-widget">
          <div class="widget-header">
            <span>
              <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                stroke-width="2">
                <polyline points="23 6 13.5 15.5 8.5 10.5 1 18"></polyline>
                <polyline points="17 6 23 6 23 12"></polyline>
              </svg>
              Sedang Trending
            </span>
          </div>
          <div class="trending-list">
            @foreach ($trending as $i => $t)
              <a href="{{ route('artikel.detail', $t) }}" class="trending-item">
                <span class="count">{{ $i + 1 }}</span>
                <div class="trending-info">
                  <h4>{{ Str::limit($t->title, 40) }}</h4>
                  <small>{{ $t->created_at->format('d M Y') }}</small>
                </div>
              </a>
            @endforeach
          </div>

        </div>

        <hr class="sidebar-divider">

        {{-- Fitur 4: Newsletter CTA --}}
        <div class="sidebar-banner">
          <h3>Dapatkan Tips Harian</h3>
          <p>Langganan newsletter gratis kami.</p>
          <button class="btn-subscribe">Berlangganan</button>
        </div>
      </aside>

      {{-- SISI KANAN: Grid Artikel --}}
      <main class="split-content">
        <div class="content-header">
          <h1>Jelajahi Artikel</h1>
          <div class="sort-wrapper">
            <span>Urutkan:</span>
            <select>
              <option>Terbaru</option>
              <option>Terpopuler</option>
              <option>Rekomendasi Dokter</option>
            </select>
          </div>
        </div>

        {{-- Article Grid --}}
        <div class="article-grid">
          @forelse($articles as $article)
            <article class="article-card">

              <div class="article-thumb">
                <div class="category-badge cat-blue">
                  {{ $article->category }}
                </div>
                @if ($article->thumbnail && file_exists(public_path($article->thumbnail)))
                  <img src="{{ asset($article->thumbnail) }}" alt="{{ $article->title }}" style="object-fit: cover;" class="img-placeholder">
                @else
                  <div class="img-placeholder bg-blue-light">
                    📰
                  </div>
                @endif
              </div>

              <div class="article-body">
                <div class="article-meta">
                  <span class="meta-date">
                    {{ $article->created_at->format('d M Y') }}
                  </span>
                  <span class="meta-read">
                    {{ str_word_count(strip_tags($article->content)) / 200 >= 1
                        ? ceil(str_word_count(strip_tags($article->content)) / 200)
                        : 1 }}
                    min baca
                  </span>
                </div>

                <h3 class="article-title">
                  {{ $article->title }}
                </h3>

                <p class="article-excerpt">
                  {{ Str::limit(strip_tags($article->content), 120) }}
                </p>

                <div class="article-footer">
                  <div class="author">
                    <div class="author-avatar">
                      {{ strtoupper(substr($article->author->application?->full_name, 0, 2)) }}
                    </div>
                    <span>{{ $article->author->application?->full_name ?: $article->author->name }}</span>
                  </div>

                  <a href="{{ route('artikel.detail', $article) }}" class="btn-read-more">
                    Baca Selengkapnya
                  </a>
                </div>
              </div>

            </article>
          @empty
            <p class="text-muted">Belum ada artikel.</p>
          @endforelse
        </div>


        {{-- Pagination --}}
        <div class="pagination-wrapper">
          {{ $articles->links() }}
        </div>

      </main>
    </div>
  </div>
@endsection
