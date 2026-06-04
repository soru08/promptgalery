@extends('layouts.admin')

@section('title', 'Tambah Prompt')
@section('page-title', 'Tambah Prompt Baru')
@section('breadcrumb', 'Prompt / Tambah')

@section('topbar-actions')
    <a href="{{ route('admin.prompts.index') }}" class="btn btn-secondary">← Kembali</a>
@endsection

@section('content')
<div class="card" style="max-width:800px">
    <form action="{{ route('admin.prompts.store') }}" method="POST">
        @csrf

        <div class="form-group">
            <label class="form-label">Judul Prompt *</label>
            <input type="text" name="title" class="form-input"
                   placeholder="Contoh: Golden Hour Cinematic Portrait"
                   value="{{ old('title') }}" required>
            @error('title') <div class="form-error">{{ $message }}</div> @enderror
        </div>

        <div class="form-group">
            <label class="form-label">Teks Prompt *</label>
            <textarea name="prompt_text" class="form-textarea" rows="6"
                      placeholder="Masukkan prompt lengkap yang akan disalin user..." required>{{ old('prompt_text') }}</textarea>
            @error('prompt_text') <div class="form-error">{{ $message }}</div> @enderror
            <div class="form-hint">💡 Tulis prompt sedetail mungkin untuk hasil terbaik</div>
        </div>

        <div class="form-grid">
            <div class="form-group">
                <label class="form-label">Kategori *</label>
                <select name="category_id" class="form-select" required>
                    <option value="">— Pilih Kategori —</option>
                    @foreach($categories as $cat)
                    <option value="{{ $cat->id }}" {{ old('category_id') == $cat->id ? 'selected' : '' }}>
                        {{ $cat->icon }} {{ $cat->name }}
                    </option>
                    @endforeach
                </select>
                @error('category_id') <div class="form-error">{{ $message }}</div> @enderror
            </div>

            <div class="form-group">
                <label class="form-label">AI Tool *</label>
                <select name="ai_tool" class="form-select" required>
                    @foreach($aiTools as $tool)
                    <option value="{{ $tool }}" {{ old('ai_tool') === $tool ? 'selected' : '' }}>{{ $tool }}</option>
                    @endforeach
                </select>
                @error('ai_tool') <div class="form-error">{{ $message }}</div> @enderror
            </div>
        </div>

        <div class="form-group">
            <label class="form-label">Style Tags</label>
            <input type="text" name="style_tags" class="form-input"
                   placeholder="bokeh, cinematic, dark mood, golden hour (pisahkan dengan koma)"
                   value="{{ old('style_tags') }}">
            @error('style_tags') <div class="form-error">{{ $message }}</div> @enderror
        </div>

        <div class="form-group">
            <label class="form-label">Deskripsi</label>
            <textarea name="description" class="form-textarea" rows="2"
                      placeholder="Deskripsi singkat tentang prompt ini...">{{ old('description') }}</textarea>
        </div>

        <div class="form-group">
            <div class="toggle-wrapper">
                <label class="toggle">
                    <input type="checkbox" name="is_featured" value="1" {{ old('is_featured') ? 'checked' : '' }}>
                    <div class="toggle-slider"></div>
                </label>
                <div>
                    <div style="font-size:.875rem;font-weight:500">Tampilkan sebagai Featured</div>
                    <div style="font-size:.78rem;color:var(--text2)">Prompt featured ditampilkan di bagian atas gallery</div>
                </div>
            </div>
        </div>

        <div style="display:flex;gap:10px;margin-top:8px">
            <button type="submit" class="btn btn-primary">✨ Simpan Prompt</button>
            <a href="{{ route('admin.prompts.index') }}" class="btn btn-secondary">Batal</a>
        </div>
    </form>
</div>
@endsection
