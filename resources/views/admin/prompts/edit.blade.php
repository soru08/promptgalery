@extends('layouts.admin')

@section('title', 'Edit Prompt')
@section('page-title', 'Edit Prompt')
@section('breadcrumb', 'Prompt / Edit')

@section('topbar-actions')
    <a href="{{ route('admin.prompts.index') }}" class="btn btn-secondary">← Kembali</a>
@endsection

@section('content')
<div class="card" style="max-width:800px">
    <form action="{{ route('admin.prompts.update', $prompt) }}" method="POST">
        @csrf @method('PUT')

        <div class="form-group">
            <label class="form-label">Judul Prompt *</label>
            <input type="text" name="title" class="form-input"
                   value="{{ old('title', $prompt->title) }}" required>
            @error('title') <div class="form-error">{{ $message }}</div> @enderror
        </div>

        <div class="form-group">
            <label class="form-label">Teks Prompt *</label>
            <textarea name="prompt_text" class="form-textarea" rows="6" required>{{ old('prompt_text', $prompt->prompt_text) }}</textarea>
            @error('prompt_text') <div class="form-error">{{ $message }}</div> @enderror
        </div>

        <div class="form-grid">
            <div class="form-group">
                <label class="form-label">Kategori *</label>
                <select name="category_id" class="form-select" required>
                    @foreach($categories as $cat)
                    <option value="{{ $cat->id }}" {{ old('category_id', $prompt->category_id) == $cat->id ? 'selected' : '' }}>
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
                    <option value="{{ $tool }}" {{ old('ai_tool', $prompt->ai_tool) === $tool ? 'selected' : '' }}>{{ $tool }}</option>
                    @endforeach
                </select>
            </div>
        </div>

        <div class="form-group">
            <label class="form-label">Style Tags</label>
            <input type="text" name="style_tags" class="form-input"
                   value="{{ old('style_tags', $prompt->style_tags) }}"
                   placeholder="bokeh, cinematic, dark mood (pisahkan dengan koma)">
        </div>

        <div class="form-group">
            <label class="form-label">Deskripsi</label>
            <textarea name="description" class="form-textarea" rows="2">{{ old('description', $prompt->description) }}</textarea>
        </div>

        <div class="form-group">
            <div class="toggle-wrapper">
                <label class="toggle">
                    <input type="checkbox" name="is_featured" value="1"
                           {{ old('is_featured', $prompt->is_featured) ? 'checked' : '' }}>
                    <div class="toggle-slider"></div>
                </label>
                <div>
                    <div style="font-size:.875rem;font-weight:500">Tampilkan sebagai Featured</div>
                    <div style="font-size:.78rem;color:var(--text2)">Prompt featured ditampilkan di bagian atas gallery</div>
                </div>
            </div>
        </div>

        <div style="display:flex;gap:10px;margin-top:8px">
            <button type="submit" class="btn btn-primary">💾 Update Prompt</button>
            <a href="{{ route('admin.prompts.index') }}" class="btn btn-secondary">Batal</a>
        </div>
    </form>
</div>
@endsection
