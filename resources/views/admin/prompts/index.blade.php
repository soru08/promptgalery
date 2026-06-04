@extends('layouts.admin')

@section('title', 'Kelola Prompt')
@section('page-title', 'Kelola Prompt')
@section('breadcrumb', 'Prompt')

@section('topbar-actions')
    <a href="{{ route('admin.prompts.create') }}" class="btn btn-primary">+ Tambah Prompt</a>
@endsection

@section('content')
<div class="card">
    <!-- Search & Filter -->
    <form action="{{ route('admin.prompts.index') }}" method="GET">
        <div class="search-bar">
            <input type="text" name="search" class="form-input" placeholder="🔍 Cari prompt..." value="{{ request('search') }}">
            <select name="category_id" class="form-select" style="max-width:180px">
                <option value="">Semua Kategori</option>
                @foreach($categories as $cat)
                <option value="{{ $cat->id }}" {{ request('category_id') == $cat->id ? 'selected' : '' }}>
                    {{ $cat->icon }} {{ $cat->name }}
                </option>
                @endforeach
            </select>
            <button type="submit" class="btn btn-secondary">Cari</button>
            @if(request()->hasAny(['search','category_id']))
            <a href="{{ route('admin.prompts.index') }}" class="btn btn-secondary">✕ Reset</a>
            @endif
        </div>
    </form>

    <div class="table-wrapper">
        <table>
            <thead>
                <tr>
                    <th>#</th>
                    <th>Judul & Prompt</th>
                    <th>Kategori</th>
                    <th>AI Tool</th>
                    <th>Featured</th>
                    <th>Copy</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($prompts as $i => $prompt)
                <tr>
                    <td style="color:var(--text2);font-size:.8rem">{{ $prompts->firstItem() + $i }}</td>
                    <td>
                        <div style="font-weight:600;margin-bottom:4px">{{ $prompt->title }}</div>
                        <div class="truncate" style="font-size:.77rem;color:var(--text2);font-family:'Fira Code',monospace">
                            {{ Str::limit($prompt->prompt_text, 80) }}
                        </div>
                    </td>
                    <td>
                        <span class="badge badge-purple">{{ $prompt->category->icon }} {{ $prompt->category->name }}</span>
                    </td>
                    <td><span style="font-size:.8rem;color:var(--cyan)">{{ $prompt->ai_tool }}</span></td>
                    <td>
                        @if($prompt->is_featured)
                        <span class="badge badge-yellow">⭐ Ya</span>
                        @else
                        <span style="color:var(--text2);font-size:.8rem">—</span>
                        @endif
                    </td>
                    <td><span style="color:var(--green);font-weight:500">{{ number_format($prompt->copy_count) }}</span></td>
                    <td>
                        <div style="display:flex;gap:6px;">
                            <a href="{{ route('admin.prompts.edit', $prompt) }}" class="btn btn-secondary btn-sm">✏️ Edit</a>
                            <form action="{{ route('admin.prompts.destroy', $prompt) }}" method="POST"
                                  onsubmit="return confirm('Yakin hapus prompt ini?')">
                                @csrf @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm">🗑️</button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="7" style="text-align:center;padding:3rem;color:var(--text2)">
                        Belum ada prompt. <a href="{{ route('admin.prompts.create') }}" style="color:var(--purple-light)">Tambah sekarang →</a>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    @if($prompts->hasPages())
    <div class="pagination">
        @if($prompts->onFirstPage())
        <span class="pag-link" style="opacity:.4">← Prev</span>
        @else
        <a href="{{ $prompts->previousPageUrl() }}" class="pag-link">← Prev</a>
        @endif
        @foreach($prompts->getUrlRange(1, $prompts->lastPage()) as $page => $url)
        <a href="{{ $url }}" class="pag-link {{ $page == $prompts->currentPage() ? 'active' : '' }}">{{ $page }}</a>
        @endforeach
        @if($prompts->hasMorePages())
        <a href="{{ $prompts->nextPageUrl() }}" class="pag-link">Next →</a>
        @else
        <span class="pag-link" style="opacity:.4">Next →</span>
        @endif
    </div>
    @endif
</div>
@endsection
