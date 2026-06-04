@extends('layouts.admin')

@section('title', 'Kelola Kategori')
@section('page-title', 'Kelola Kategori')
@section('breadcrumb', 'Kategori')

@section('topbar-actions')
    <a href="{{ route('admin.categories.create') }}" class="btn btn-primary">+ Tambah Kategori</a>
@endsection

@section('content')
<div class="card">
    <div class="table-wrapper">
        <table>
            <thead>
                <tr>
                    <th>#</th>
                    <th>Ikon & Nama</th>
                    <th>Slug</th>
                    <th>Warna</th>
                    <th>Jumlah Prompt</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($categories as $i => $cat)
                <tr>
                    <td style="color:var(--text2);font-size:.8rem">{{ $i + 1 }}</td>
                    <td>
                        <div style="display:flex;align-items:center;gap:10px">
                            <span style="font-size:1.25rem">{{ $cat->icon }}</span>
                            <div>
                                <div style="font-weight:600">{{ $cat->name }}</div>
                                @if($cat->description)
                                <div style="font-size:.78rem;color:var(--text2)">{{ Str::limit($cat->description, 50) }}</div>
                                @endif
                            </div>
                        </div>
                    </td>
                    <td><code style="font-size:.78rem;color:var(--text2)">{{ $cat->slug }}</code></td>
                    <td>
                        <div style="display:flex;align-items:center;gap:8px">
                            <div style="width:16px;height:16px;border-radius:4px;background:{{ $cat->color }}"></div>
                            <span style="font-size:.8rem;color:var(--text2)">{{ $cat->color }}</span>
                        </div>
                    </td>
                    <td>
                        <span class="badge badge-purple">{{ $cat->prompts_count }} prompt</span>
                    </td>
                    <td>
                        <div style="display:flex;gap:6px;">
                            <a href="{{ route('admin.categories.edit', $cat) }}" class="btn btn-secondary btn-sm">✏️ Edit</a>
                            <form action="{{ route('admin.categories.destroy', $cat) }}" method="POST"
                                  onsubmit="return confirm('Hapus kategori \'{{ $cat->name }}\'? Pastikan tidak ada prompt di dalamnya.')">
                                @csrf @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm"
                                        {{ $cat->prompts_count > 0 ? 'disabled title=Masih ada prompt' : '' }}>🗑️</button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" style="text-align:center;padding:3rem;color:var(--text2)">
                        Belum ada kategori. <a href="{{ route('admin.categories.create') }}" style="color:var(--purple-light)">Tambah sekarang →</a>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
