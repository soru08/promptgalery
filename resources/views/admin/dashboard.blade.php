@extends('layouts.admin')

@section('title', 'Dashboard')
@section('page-title', 'Dashboard')
@section('breadcrumb', 'Dashboard')

@section('content')
<!-- STAT CARDS -->
<div class="stats-grid">
    <div class="stat-card" style="--stat-color: #8b5cf6">
        <div class="stat-icon">✨</div>
        <div class="stat-value">{{ number_format($totalPrompts) }}</div>
        <div class="stat-label">Total Prompt</div>
    </div>
    <div class="stat-card" style="--stat-color: #06b6d4">
        <div class="stat-icon">🏷️</div>
        <div class="stat-value">{{ $totalCategories }}</div>
        <div class="stat-label">Kategori</div>
    </div>
    <div class="stat-card" style="--stat-color: #f59e0b">
        <div class="stat-icon">⭐</div>
        <div class="stat-value">{{ $featuredPrompts }}</div>
        <div class="stat-label">Prompt Featured</div>
    </div>
    <div class="stat-card" style="--stat-color: #10b981">
        <div class="stat-icon">📋</div>
        <div class="stat-value">{{ number_format($totalCopies) }}</div>
        <div class="stat-label">Total Copy</div>
    </div>
</div>

<div style="display:grid; grid-template-columns:1fr 1fr; gap:16px;">
    <!-- RECENT PROMPTS -->
    <div class="card">
        <div class="card-header">
            <div class="card-title">✨ Prompt Terbaru</div>
            <a href="{{ route('admin.prompts.index') }}" class="btn btn-secondary btn-sm">Lihat Semua</a>
        </div>
        <div class="table-wrapper">
            <table>
                <thead>
                    <tr>
                        <th>Judul</th>
                        <th>Kategori</th>
                        <th>AI Tool</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($recentPrompts as $prompt)
                    <tr>
                        <td>
                            <div style="font-weight:500">{{ Str::limit($prompt->title, 30) }}</div>
                            @if($prompt->is_featured)
                            <span class="badge badge-yellow" style="font-size:.65rem;padding:1px 6px">⭐ Featured</span>
                            @endif
                        </td>
                        <td>
                            <span class="badge badge-purple">{{ $prompt->category->icon }} {{ $prompt->category->name }}</span>
                        </td>
                        <td><span style="color:var(--text2);font-size:.8rem">{{ $prompt->ai_tool }}</span></td>
                    </tr>
                    @empty
                    <tr><td colspan="3" style="text-align:center;color:var(--text2);padding:2rem">Belum ada prompt</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <!-- POPULAR PROMPTS -->
    <div class="card">
        <div class="card-header">
            <div class="card-title">🔥 Prompt Terpopuler</div>
        </div>
        <div class="table-wrapper">
            <table>
                <thead>
                    <tr>
                        <th>Judul</th>
                        <th>Copy</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($popularPrompts as $prompt)
                    <tr>
                        <td>
                            <div style="font-weight:500">{{ Str::limit($prompt->title, 35) }}</div>
                            <div style="font-size:.75rem;color:var(--text2)">{{ $prompt->category->icon }} {{ $prompt->category->name }}</div>
                        </td>
                        <td>
                            <span style="color:var(--cyan);font-weight:600">{{ number_format($prompt->copy_count) }}</span>
                        </td>
                    </tr>
                    @empty
                    <tr><td colspan="2" style="text-align:center;color:var(--text2);padding:2rem">Belum ada data</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

<div style="margin-top:20px" class="card">
    <div class="card-header">
        <div class="card-title">🚀 Akses Cepat</div>
    </div>
    <div style="display:flex;gap:12px;flex-wrap:wrap;">
        <a href="{{ route('admin.prompts.create') }}" class="btn btn-primary">+ Tambah Prompt Baru</a>
        <a href="{{ route('admin.categories.create') }}" class="btn btn-secondary">+ Tambah Kategori</a>
        <a href="{{ route('home') }}" target="_blank" class="btn btn-secondary">🌐 Lihat Gallery Publik</a>
    </div>
</div>
@endsection
