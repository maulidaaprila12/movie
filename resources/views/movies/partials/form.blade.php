<div class="mb-3">
    <label class="form-label">ID Movie</label>
    <input type="text" name="id" class="form-control"
        value="{{ old('id', $movie->id ?? '') }}"
        {{ isset($movie) ? 'readonly' : '' }} required>
</div>

<div class="mb-3">
    <label class="form-label">Judul</label>
    <input type="text" name="judul" class="form-control"
        value="{{ old('judul', $movie->judul ?? '') }}" required>
</div>

<div class="mb-3">
    <label class="form-label">Kategori</label>
    <select name="category_id" class="form-control" required>
        <option value="">-- Pilih Kategori --</option>

        @foreach($categories as $category)
            <option value="{{ $category->id }}"
                {{ old('category_id', $movie->category_id ?? '') == $category->id ? 'selected' : '' }}>
                {{ $category->nama_kategori }}
            </option>
        @endforeach
    </select>
</div>

<div class="mb-3">
    <label class="form-label">Sinopsis</label>
    <textarea name="sinopsis" class="form-control" rows="4" required>{{ old('sinopsis', $movie->sinopsis ?? '') }}</textarea>
</div>

<div class="mb-3">
    <label class="form-label">Tahun</label>
    <input type="number" name="tahun" class="form-control"
        value="{{ old('tahun', $movie->tahun ?? '') }}" required>
</div>

<div class="mb-3">
    <label class="form-label">Pemain</label>
    <input type="text" name="pemain" class="form-control"
        value="{{ old('pemain', $movie->pemain ?? '') }}" required>
</div>

<div class="mb-3">
    <label class="form-label">Foto Sampul</label>
    <input type="file" name="foto_sampul" class="form-control"
        {{ isset($movie) ? '' : 'required' }}>
</div>

<button type="submit" class="btn btn-success">Simpan</button>
<a href="{{ url('/') }}" class="btn btn-secondary">Kembali</a>