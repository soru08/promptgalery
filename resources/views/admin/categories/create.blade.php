@extends('layouts.admin')

@section('title', 'Tambah Kategori')
@section('page-title', 'Tambah Kategori')
@section('breadcrumb', 'Kategori / Tambah')

@section('topbar-actions')
    <a href="{{ route('admin.categories.index') }}" class="btn btn-secondary">← Kembali</a>
@endsection

@section('content')
<div class="card" style="max-width:500px">
    <form action="{{ route('admin.categories.store') }}" method="POST">
        @csrf
        <div class="form-grid">
            <div class="form-group">
                <label class="form-label">Nama Kategori *</label>
                <input type="text" name="name" class="form-input"
                       placeholder="Contoh: Portrait" value="{{ old('name') }}" required>
                @error('name') <div class="form-error">{{ $message }}</div> @enderror
            </div>
            <div class="form-group">
                <label class="form-label">Ikon Emoji *</label>
                <input type="text" name="icon" class="form-input"
                       placeholder="👤" value="{{ old('icon', '🖼️') }}" required maxlength="10">
                <div class="form-hint">Gunakan emoji sebagai ikon</div>
                @error('icon') <div class="form-error">{{ $message }}</div> @enderror
            </div>
        </div>

        <div class="form-group">
            <label class="form-label">Warna Aksen *</label>
            <div style="display:flex;gap:10px;align-items:center">
                <input type="color" name="color" value="{{ old('color', '#8b5cf6') }}"
                       style="width:48px;height:40px;border:none;border-radius:8px;background:transparent;cursor:pointer;padding:0">
                <input type="text" id="color-text" class="form-input" style="max-width:140px"
                       value="{{ old('color', '#8b5cf6') }}" placeholder="#8b5cf6">
                <div id="color-preview" style="width:80px;height:36px;border-radius:8px;background:{{ old('color','#8b5cf6') }}22;border:1px solid {{ old('color','#8b5cf6') }}55;"></div>
            </div>
            @error('color') <div class="form-error">{{ $message }}</div> @enderror
        </div>

        <div class="form-group">
            <label class="form-label">Deskripsi</label>
            <textarea name="description" class="form-textarea" rows="2"
                      placeholder="Deskripsi singkat tentang kategori ini...">{{ old('description') }}</textarea>
        </div>

        <div style="display:flex;gap:10px">
            <button type="submit" class="btn btn-primary">🏷️ Simpan Kategori</button>
            <a href="{{ route('admin.categories.index') }}" class="btn btn-secondary">Batal</a>
        </div>
    </form>
</div>
<script>
const colorPicker = document.querySelector('input[type=color]');
const colorText = document.getElementById('color-text');
const colorPreview = document.getElementById('color-preview');

function syncColor(val) {
    colorPicker.value = val;
    colorText.value = val;
    colorPreview.style.background = val + '22';
    colorPreview.style.borderColor = val + '55';
}
colorPicker.addEventListener('input', e => syncColor(e.target.value));
colorText.addEventListener('input', e => { if(/^#[0-9A-Fa-f]{6}$/.test(e.target.value)) syncColor(e.target.value); });

// Sync hidden color input name
colorPicker.setAttribute('oninput', "document.querySelector('[name=color]').value = this.value");
</script>
@endsection
