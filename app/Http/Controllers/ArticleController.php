<?php

namespace App\Http\Controllers;

use App\Models\Article;
use Illuminate\Http\Request;


class ArticleController extends Controller
{
        public function index(Request $request)
    {
        $search   = $request->q;
        $category = $request->category;

        $articles = Article::with('author', 'author.application')
            ->where('status', 'published')
            ->when($search, fn ($q) =>
                $q->where('title', 'like', "%{$search}%")
                  ->orWhere('content', 'like', "%{$search}%")
            )

            ->when($category, fn ($q) =>
                $q->where('category', $category)
            )

            ->latest()
            ->paginate(8)
            ->withQueryString();

        $categories = Article::select('category')
            ->whereNotNull('category')
            ->distinct()
            ->pluck('category');

        $trending = Article::where('status', 'published')
            ->latest()
            ->take(5)
            ->get();

        return view('user.layanan.artikel.index', compact(
            'articles',
            'categories',
            'trending',
            'search',
            'category'
        ));
    }

    public function articleList(Request $request)
    {
        $user   = auth()->user();
        $search = $request->query('q');

        $query = Article::with('author')->latest();

        if ($user->role !== 'admin') {
            $query->where('author_id', $user->id);
        }

        if ($search) {
            $query->where(function ($q) use ($search) {
                $q->where('title', 'like', "%{$search}%")
                ->orWhere('category', 'like', "%{$search}%")
                ->orWhere('content', 'like', "%{$search}%");
            });
        }

        $articles = $query
            ->paginate(10)
            ->withQueryString();

        return view('components.article', compact('articles', 'search'));
    }

    public function detail(Article $article)
    {
        if(auth()->user()?->role !== 'admin'){
            abort_if($article->status !== 'published', 404);
        }

        $wordCount = str_word_count(strip_tags($article->content));
        $readTime = max(1, ceil($wordCount / 200));

        $related = Article::where('status', 'published')
            ->where('category', $article->category)
            ->where('id', '!=', $article->id)
            ->latest()
            ->limit(3)
            ->get();

        return view('user.layanan.artikel.detail', compact(
            'article',
            'readTime',
            'related'
        ));
    }

    public function create()
    {
        abort_unless(in_array(auth()->user()->role, ['admin', 'doctor']), 403);

        return view('components.create-article');
    }

    public function store(Request $request)
    {
        abort_unless(in_array(auth()->user()->role, ['admin', 'doctor']), 403);
        $data = $request->validate([
            'title'     => 'required|string|max:255',
            'slug'      => 'required|string|max:255|unique:articles,slug',
            'category'  => 'nullable|string|max:100',
            'content'   => 'required|string',
            'thumbnail' => 'nullable|image|max:5120',
        ]);

        if ($request->hasFile('thumbnail')) {
            $data['thumbnail'] = $request->file('thumbnail');
            $thumbnail_name = now()->format('YmdHis') . '_' . $data['thumbnail']->getClientOriginalName();
            $data['thumbnail']->move(public_path('images/articles'), $thumbnail_name);
            $data['thumbnail'] = 'images/articles/' . $thumbnail_name;
        }

        $data['author_id']   = auth()->id();
        $data['author_role'] = auth()->user()->role;
        $data['status']      = 'draft';

        Article::create($data);

        return redirect()
            ->route('article.index')
            ->with('success', 'Artikel berhasil disimpan');
    }

    public function edit(Article $article)
    {
        $this->authorizeEdit($article);

        return view('components.edit-article', compact('article'));
    }

    public function update(Request $request, Article $article)
    {
        $this->authorizeEdit($article);

        $request->validate([
            'title'    => 'required|string|max:255',
            'category' => 'required|string|max:100',
            'content'  => 'required|string',
        ]);

        if($request->hasFile('thumbnail')) {
            $thumbnail = $request->file('thumbnail');
            $thumbnail_name = now()->format('YmdHis') . '_' . $thumbnail->getClientOriginalName();
            $thumbnail->move(public_path('images/articles'), $thumbnail_name);
            $article->thumbnail = 'images/articles/' . $thumbnail_name;
            $article->save();
        }

        $article->update([
            'title'    => $request->input('title'),
            'category' => $request->input('category'),
            'content'  => $request->input('content'),
        ]);

        return redirect()
            ->route('article.index')
            ->with('success', 'Artikel berhasil diperbarui');
    }

    public function approve(Article $article)
    {
        $this->authorizeAdmin();

        $article->update([
            'status'       => 'published',
            'published_at' => now(),
        ]);

        return back()->with('success', 'Artikel berhasil dipublish');
    }
    public function unpublish(Article $article)
    {
        $this->authorizeAdmin();

        $article->update([
            'status'       => 'draft',
            'published_at' => null,
        ]);

        return back()->with('success', 'Artikel berhasil di-unpublish');
    }
    
    private function authorizeAdmin()
    {
        if (auth()->user()->role !== 'admin') {
            abort(403, 'Unauthorized');
        }
    }

    private function authorizeEdit(Article $article)
    {
        if (
            auth()->user()->role !== 'admin' &&
            auth()->id() !== $article->author_id
        ) {
            abort(403, 'Unauthorized');
        }
    }
}
