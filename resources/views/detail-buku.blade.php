@extends('layouts.app')

@section('title', $book->title)
@section('meta_description', 'Detail buku ' . $book->title . ' oleh ' . $book->author . ' di Perpustakaan Digital B University.')

@section('content')
<section class="bg-gradient-to-br from-blue-950 to-blue-800 py-20 text-white">
    <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
        <p class="text-sm font-semibold uppercase tracking-widest text-blue-200">Perpustakaan</p>
        <h1 class="mt-3 text-4xl font-extrabold sm:text-5xl">{{ $book->title }}</h1>
        <p class="mt-5 max-w-3xl text-lg leading-8 text-blue-100">
            {{ $book->author }}
        </p>
    </div>
</section>

<section class="bg-slate-50 py-20">
    <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
        <div class="grid gap-10 lg:grid-cols-2">
            <div>
                @if($book->cover)
                    <img src="{{ asset('storage/' . $book->cover) }}"
                         alt="{{ $book->title }}"
                         class="h-[500px] w-full rounded-3xl object-cover shadow-lg">
                @else
                    <div class="flex h-[500px] w-full items-center justify-center rounded-3xl bg-gradient-to-br from-blue-50 to-slate-100 shadow-lg">
                        <svg class="h-32 w-32 text-blue-200" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M9 4.804A7.968 7.968 0 005.5 4c-1.255 0-2.443.29-3.5.804v10A7.969 7.969 0 015.5 14c1.669 0 3.218.51 4.5 1.385A7.962 7.962 0 0114.5 14c1.255 0 2.443.29 3.5.804v-10A7.968 7.968 0 0014.5 4c-1.255 0-2.443.29-3.5.804V12a1 1 0 11-2 0V4.804z"/>
                        </svg>
                    </div>
                @endif
            </div>

            <div>
                <div class="mb-6">
                    <span class="inline-flex rounded-full bg-blue-50 px-4 py-2 text-sm font-semibold text-blue-700">
                        {{ $book->category }}
                    </span>
                </div>

                <h2 class="text-3xl font-bold text-slate-900">{{ $book->title }}</h2>
                <p class="mt-2 text-xl text-slate-600">{{ $book->author }}</p>

                <div class="mt-8 grid grid-cols-2 gap-6">
                    <div class="rounded-2xl border border-slate-200 bg-white p-5 shadow-sm">
                        <p class="text-sm text-slate-500">Tahun Terbit</p>
                        <p class="mt-1 text-2xl font-bold text-slate-900">{{ $book->publication_year }}</p>
                    </div>

                    <div class="rounded-2xl border border-slate-200 bg-white p-5 shadow-sm">
                        <p class="text-sm text-slate-500">Stok Tersedia</p>
                        <p class="mt-1 text-2xl font-bold text-slate-900">{{ $book->stock }} buku</p>
                    </div>
                </div>

                <div class="mt-8 flex gap-4">
                    <a href="{{ route('perpustakaan') }}"
                       class="inline-flex items-center justify-center rounded-xl bg-blue-700 px-6 py-3 text-sm font-semibold text-white transition hover:bg-blue-800">
                        Kembali ke Koleksi
                    </a>

                    @if($book->stock > 0)
                        <button class="inline-flex items-center justify-center rounded-xl border border-blue-700 px-6 py-3 text-sm font-semibold text-blue-700 transition hover:bg-blue-50">
                            Pinjam Buku
                        </button>
                    @else
                        <button disabled class="inline-flex items-center justify-center rounded-xl border border-slate-300 px-6 py-3 text-sm font-semibold text-slate-400">
                            Stok Habis
                        </button>
                    @endif
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
