<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

class Post extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = ['judul', 'slug', 'konten', 'gambar'];

    // Route Model Binding pakai kolom slug, bukan id (requirement #8)
    public function getRouteKeyName(): string
    {
        return 'slug';
    }

    protected static function booted(): void
    {
        static::creating(function (Post $post) {
            if (empty($post->slug)) {
                $post->slug = static::buatSlugUnik($post->judul);
            }
        });
    }

    public static function buatSlugUnik(string $judul): string
    {
        $slug = Str::slug($judul);
        $asli = $slug;
        $i = 1;

        while (static::withTrashed()->where('slug', $slug)->exists()) {
            $slug = $asli . '-' . $i++;
        }

        return $slug;
    }
}
