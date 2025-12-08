<?php

namespace Database\Seeders;

use App\Models\Application;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use App\Models\Article;
use App\Models\User;

class ArticleSeeder extends Seeder
{
    public function run(): void
    {
        $admin   = User::where('role', 'admin')->first();
        $dokter  = Application::first();

        if (!$admin || !$dokter) {
            $this->command->warn('Admin / Dokter user belum ada.');
            return;
        }

        $articles = [
            [
                'title'    => 'Mengapa Sering Merasa Lelah Padahal Cukup Tidur?',
                'category' => 'Penyakit Dalam',
                'content'  => $this->dummyContent(),
                'status'   => 'published',
                'author'   => $dokter->user_id,
                'author_role'=> 'dokter',
            ],
            [
                'title'    => 'Urutan Skincare Malam untuk Kulit Berjerawat',
                'category' => 'Kesehatan Kulit',
                'content'  => $this->dummyContent(),
                'status'   => 'published',
                'author'   => $dokter->user_id,
                'author_role'=> 'doctor',
            ],
            [
                'title'    => 'Vaksin Anak: Jadwal Terbaru IDAI 2024',
                'category' => 'Kesehatan Anak',
                'content'  => $this->dummyContent(),
                'status'   => 'draft',
                'author'   => $dokter->user_id,
                'author_role'=> 'doctor',
            ],
            [
                'title'    => 'Pola Hidup Sehat untuk Cegah Diabetes',
                'category' => 'Gaya Hidup',
                'content'  => $this->dummyContent(),
                'status'   => 'published',
                'author'   => $admin->id,
                'author_role'=> 'admin',
            ],
        ];

        foreach ($articles as $key => $item) {
            Article::create([
                'title'       => $item['title'],
                'slug'        => Str::slug($item['title']),
                'category'    => $item['category'],
                'content'     => $item['content'],
                'status'      => $item['status'],
                'author_id'   => $item['author'],
                'author_role' => $item['author_role'],
                'thumbnail'   => 'images/article/article-'. ($key + 1) . '.jpg',
                'created_at'=> now(),
            ]);
        }
    }

    private function dummyContent(): string
    {
        return <<<HTML
<p class="lead">
  Artikel ini ditulis untuk memberikan edukasi kesehatan yang mudah dipahami oleh masyarakat umum.
</p>

<h2>Penyebab Umum</h2>
<ul>
  <li>Pola tidur tidak teratur</li>
  <li>Kurang aktivitas fisik</li>
  <li>Stres berkepanjangan</li>
</ul>

<h2>Kapan Harus ke Dokter?</h2>
<p>
  Jika keluhan berlangsung lebih dari dua minggu disertai gejala lain seperti pusing,
  penurunan berat badan, atau nyeri dada, segera konsultasikan ke dokter.
</p>

<div class="highlight-box">
  <strong>Catatan Dokter:</strong>
  <p>Deteksi dini dapat mencegah komplikasi lebih lanjut.</p>
</div>
HTML;
    }
}
