@extends('layout')

@section('title', $article->title . ' - KlikDoc Artikel')

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/user/layanan/artikel/detail.css') }}">
@endpush

@section('body')
    <div class="article-detail-page">
        <div class="article-nav-container">
            <a href="{{ url('/artikel') }}" class="btn-back">
                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <path d="M19 12H5M12 19l-7-7 7-7" />
                </svg>
                Kembali ke Artikel
            </a>
            <span class="breadcrumb-separator">/</span>
            <span class="breadcrumb-current">{{ $article->category }}</span>
        </div>
        <article class="article-wrapper">
            <header class="article-header">
                <div class="category-pill">{{ $article->category }}</div>

                <h1 class="main-title">{{ $article->title }}</h1>

                <div class="article-meta">
                    <div class="author-info">
                        <div class="avatar">
                            <img src="https://ui-avatars.com/api/?name={{ urlencode($article->author->name) }}&background=1C274C&color=fff"
                                alt="{{ $article->author->name }}">
                        </div>
                        <div class="text">
                            <span class="name">
                                Ditulis oleh
                                <strong>{{ $article->author->application?->full_name ?: $article->author->name }}</strong>
                            </span>
                            <span class="date">
                                {{ $article->created_at->format('d F Y') }}
                                &bull; {{ $readTime }} menit baca
                            </span>
                        </div>
                    </div>
                    <div class="share-actions">
                        <button class="btn-share" title="Bagikan">
                            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                stroke-width="2">
                                <circle cx="18" cy="5" r="3"></circle>
                                <circle cx="6" cy="12" r="3"></circle>
                                <circle cx="18" cy="19" r="3"></circle>
                                <line x1="8.59" y1="13.51" x2="15.42" y2="17.49"></line>
                                <line x1="15.41" y1="6.51" x2="8.59" y2="10.49"></line>
                            </svg>
                        </button>

                        <button class="btn-bookmark" title="Simpan">
                            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                stroke-width="2">
                                <path d="M19 21l-7-5-7 5V5a2 2 0 0 1 2-2h10a2 2 0 0 1 2 2z"></path>
                            </svg>
                        </button>
                    </div>
                </div>
            </header>

            @if ($article->thumbnail)
                <figure class="featured-image-container">
                    <img src="{{ asset($article->thumbnail) }}" alt="{{ $article->title }}" class="article-thumbnail"
                        loading="lazy">
                </figure>
            @else
                <div class="img-placeholder bg-gradient">
                    <svg width="64" height="64" viewBox="0 0 24 24" fill="none" stroke="white" stroke-width="1.5"
                        stroke-opacity="0.8">
                        <path d="M22 12h-4l-3 9L9 3l-3 9H2"></path>
                    </svg>
                </div>
            @endif
            <figcaption>{{ $article->image_caption ?? '' }}</figcaption>
            <div class="article-content">
                {!! $article->content !!}
            </div>
            @if ($article->tags)
                <div class="article-tags">
                    @foreach (explode(',', $article->tags) as $tag)
                        <a href="{{ url('/artikel?tag=' . trim($tag)) }}">
                            #{{ trim($tag) }}
                        </a>
                    @endforeach
                </div>
            @endif

            <hr class="divider">

            <div class="author-bio-box">
                <div class="bio-avatar">
                    <img
                        src="https://ui-avatars.com/api/?name={{ urlencode($article->author->name) }}&background=1C274C&color=fff">
                </div>
                <div class="bio-text">
                    <h4>{{ $article->author->application?->full_name ?: $article->author->name }}</h4>
                    <p>
                        {{ $article->author->bio ?? 'Dokter terpercaya di KlikDoc yang aktif memberikan edukasi kesehatan.' }}
                    </p>
                    <a href="{{ route('konsultasi') }}" class="btn-consult">
                        Konsultasi dengan Dokter
                    </a>
                </div>
            </div>

        </article>

        @if ($related->count())
            <section class="related-articles-section">
                <div class="related-container">
                    <h3>Bacaan Terkait</h3>

                    <div class="related-grid">
                        @foreach ($related as $rel)
                            <a href="{{ route('artikel.detail', $rel->slug) }}" class="related-card">
                                <div class="rel-thumb bg-blue-soft"></div>

                                <div class="rel-info">
                                    <span class="rel-cat">{{ $rel->category }}</span>
                                    <h5>{{ Str::limit($rel->title, 55) }}</h5>
                                </div>
                            </a>
                        @endforeach
                    </div>
                </div>
            </section>
        @endif
    </div>
@endsection
