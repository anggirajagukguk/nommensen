@extends('layouts.app')

@section('title', 'Perpustakaan Digital')
@section('meta_description', 'Koleksi buku digital B University - temukan referensi bacaan untuk mendukung pembelajaran.')

@section('content')
<section class="bg-gradient-to-br from-blue-950 to-blue-800 py-16 text-white">
    <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
        <h1 class="text-3xl font-extrabold sm:text-4xl">Perpustakaan Digital</h1>
        <p class="mt-2 text-blue-100">Temukan buku referensi untuk mendukung pembelajaran Anda</p>
    </div>
</section>

<section class="bg-white py-12">
    <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
        <div class="mb-8 flex flex-col gap-4 md:flex-row md:items-center md:justify-between">
            <div class="relative flex-1 max-w-md">
                <input type="text"
                       placeholder="Cari buku..."
                       class="w-full rounded-xl border border-slate-300 px-4 py-3 pl-10 text-slate-900 placeholder-slate-400 focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-500/20">
                <svg class="absolute left-3 top-1/2 h-5 w-5 -translate-y-1/2 text-slate-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                </svg>
            </div>

            <div class="flex flex-wrap gap-2">
                <button class="rounded-full bg-blue-600 px-4 py-2 text-sm font-semibold text-white transition hover:bg-blue-700">Semua</button>
                <button class="rounded-full border border-slate-300 px-4 py-2 text-sm font-semibold text-slate-700 transition hover:bg-slate-50">Teknik</button>
                <button class="rounded-full border border-slate-300 px-4 py-2 text-sm font-semibold text-slate-700 transition hover:bg-slate-50">Ekonomi</button>
                <button class="rounded-full border border-slate-300 px-4 py-2 text-sm font-semibold text-slate-700 transition hover:bg-slate-50">Hukum</button>
                <button class="rounded-full border border-slate-300 px-4 py-2 text-sm font-semibold text-slate-700 transition hover:bg-slate-50">Kesehatan</button>
            </div>
        </div>

        <div class="grid gap-6 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4">
            @forelse($books as $book)
                <article class="flex flex-col overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-sm transition hover:-translate-y-1 hover:shadow-lg">
                    @if($book->cover)
                        <img src="{{ asset('storage/' . $book->cover) }}"
                             alt="{{ $book->title }}"
                             class="h-64 w-full object-cover">
                    @else
                        <div class="flex h-64 items-center justify-center bg-gradient-to-br from-blue-50 to-slate-100">
                            <svg class="h-20 w-20 text-blue-200" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M9 4.804A7.968 7.968 0 005.5 4c-1.255 0-2.443.29-3.5.804v10A7.969 7.969 0 015.5 14c1.669 0 3.218.51 4.5 1.385A7.962 7.962 0 0114.5 14c1.255 0 2.443.29 3.5.804v-10A7.968 7.968 0 0014.5 4c-1.255 0-2.443.29-3.5.804V12a1 1 0 11-2 0V4.804z"/>
                            </svg>
                        </div>
                    @endif

                    <div class="flex flex-1 flex-col p-5">
                        <span class="inline-flex w-fit rounded-full bg-blue-50 px-3 py-1 text-xs font-semibold text-blue-700">
                            {{ $book->category }}
                        </span>

                        <h3 class="mt-3 text-lg font-bold text-slate-900 line-clamp-2">
                            {{ $book->title }}
                        </h3>

                        <p class="mt-1 text-sm text-slate-600">{{ $book->author }}</p>

                        @if($book->description)
                            <p class="mt-2 text-sm text-slate-500 line-clamp-2">
                                {{ $book->description }}
                            </p>
                        @endif

                        <div class="mt-auto pt-4">
                            <div class="flex items-center justify-between text-sm text-slate-500">
                                <span>{{ $book->publication_year }}</span>
                                @if($book->stock > 0)
                                    <span class="rounded-full bg-green-100 px-3 py-1 font-semibold text-green-700">
                                        Tersedia
                                    </span>
                                @else
                                    <span class="rounded-full bg-red-100 px-3 py-1 font-semibold text-red-700">
                                        Habis
                                    </span>
                                @endif
                            </div>

                            <div class="mt-2 text-sm text-slate-500">
                                Stok: {{ $book->stock }}
                            </div>

                            <a href="{{ route('perpustakaan.detail', $book) }}"
                               class="mt-4 block w-full rounded-xl bg-blue-600 px-4 py-3 text-center text-sm font-semibold text-white transition hover:bg-blue-700">
                                Pinjam
                            </a>
                        </div>
                    </div>
                </article>
            @empty
                <div class="col-span-full rounded-2xl border border-dashed border-slate-300 bg-white p-12 text-center">
                    <h3 class="text-lg font-bold text-slate-900">Belum ada buku</h3>
                    <p class="mt-2 text-slate-500">Silakan tambahkan buku melalui panel admin.</p>
                </div>
            @endforelse
        </div>

        @if($books->hasPages())
            <div class="mt-10">
                {{ $books->links() }}
            </div>
        @endif
    </div>
</section>
@endsection
