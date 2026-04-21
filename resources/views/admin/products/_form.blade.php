<form method="POST" action="{{ $action }}" enctype="multipart/form-data">
    @csrf
    @if($method === 'PUT') @method('PUT') @endif

    <div class="form-grid">

        <p class="section-label">Basic Info</p>

        <div class="form-group full">
            <label for="name">Name <span style="color:red">*</span></label>
            <input type="text" id="name" name="name" value="{{ old('name', $product->name ?? '') }}" required>
            @error('name')<span class="error">{{ $message }}</span>@enderror
        </div>

        <div class="form-group">
            <label for="price">Price (€) <span style="color:red">*</span></label>
            <input type="number" id="price" name="price" step="0.01" min="0" value="{{ old('price', $product->price ?? '') }}" required>
            @error('price')<span class="error">{{ $message }}</span>@enderror
        </div>

        <div class="form-group">
            <label for="colour">Colour</label>
            <input type="text" id="colour" name="colour" value="{{ old('colour', $product->colour ?? '') }}" placeholder="Natural">
            @error('colour')<span class="error">{{ $message }}</span>@enderror
        </div>

        <div class="form-group full">
            <label for="short_description">Short Description</label>
            <textarea id="short_description" name="short_description" style="min-height:60px;">{{ old('short_description', $product->short_description ?? '') }}</textarea>
            @error('short_description')<span class="error">{{ $message }}</span>@enderror
        </div>

        <div class="form-group full">
            <label for="description">Full Description</label>
            <textarea id="description" name="description">{{ old('description', $product->description ?? '') }}</textarea>
            @error('description')<span class="error">{{ $message }}</span>@enderror
        </div>

        <hr class="section-divider">
        <p class="section-label">Print Parameters</p>

        <div class="form-group">
            <label for="filament">Filament</label>
            <input type="text" id="filament" name="filament" value="{{ old('filament', $product->filament ?? '') }}" placeholder="PLA / PETG">
            @error('filament')<span class="error">{{ $message }}</span>@enderror
        </div>

        <div class="form-group">
            <label for="pieces">Pieces</label>
            <input type="number" id="pieces" name="pieces" min="1" value="{{ old('pieces', $product->pieces ?? '') }}">
            @error('pieces')<span class="error">{{ $message }}</span>@enderror
        </div>

        <div class="form-group">
            <label for="print_time">Print Time</label>
            <input type="text" id="print_time" name="print_time" value="{{ old('print_time', $product->print_time ?? '') }}" placeholder="~3 h">
            @error('print_time')<span class="error">{{ $message }}</span>@enderror
        </div>

        <div class="form-group">
            <label for="supports">Supports</label>
            <select id="supports" name="supports">
                @foreach(['No', 'Yes', 'Optional'] as $opt)
                    <option value="{{ $opt }}" {{ old('supports', $product->supports ?? 'No') === $opt ? 'selected' : '' }}>{{ $opt }}</option>
                @endforeach
            </select>
            @error('supports')<span class="error">{{ $message }}</span>@enderror
        </div>

        <div class="form-group">
            <label for="infill">Infill</label>
            <input type="text" id="infill" name="infill" value="{{ old('infill', $product->infill ?? '') }}" placeholder="15%">
            @error('infill')<span class="error">{{ $message }}</span>@enderror
        </div>

        <div class="form-group">
            <label for="layer_height">Layer Height</label>
            <input type="text" id="layer_height" name="layer_height" value="{{ old('layer_height', $product->layer_height ?? '') }}" placeholder="0.2 mm">
            @error('layer_height')<span class="error">{{ $message }}</span>@enderror
        </div>

        <div class="form-group">
            <label for="file_format">File Format</label>
            <input type="text" id="file_format" name="file_format" value="{{ old('file_format', $product->file_format ?? '') }}" placeholder="STL, 3MF">
            @error('file_format')<span class="error">{{ $message }}</span>@enderror
        </div>

        <div class="form-group">
            <label for="license">License</label>
            <input type="text" id="license" name="license" value="{{ old('license', $product->license ?? '') }}" placeholder="Personal use">
            @error('license')<span class="error">{{ $message }}</span>@enderror
        </div>

        <hr class="section-divider">
        <p class="section-label">Image</p>

        <div class="form-group full">
            <label for="main_image">Main Image (jpg/png/webp, max 4 MB)</label>
            <input type="file" id="main_image" name="main_image" accept="image/jpeg,image/png,image/webp"
                   onchange="previewImg(this)">
            @error('main_image')<span class="error">{{ $message }}</span>@enderror
            <div class="image-preview-wrap">
                @if(!empty($product->main_image))
                    <p style="font-size:.8rem;color:#888;margin-bottom:.3rem;">Current image:</p>
                    <img id="imgPreview" src="{{ $product->main_image_url }}" alt="Preview">
                @else
                    <img id="imgPreview" src="" alt="" style="display:none;">
                @endif
            </div>
        </div>

    </div>

    <div style="margin-top:1.8rem;display:flex;gap:.8rem;">
        <button type="submit" class="btn btn-primary">
            {{ $method === 'PUT' ? 'Save Changes' : ' Create Product' }}
        </button>
        <a href="{{ route('admin.products.index') }}" class="btn btn-secondary">Cancel</a>
    </div>
</form>

<script>
function previewImg(input) {
    if (input.files && input.files[0]) {
        const reader = new FileReader();
        const preview = document.getElementById('imgPreview');
        reader.onload = e => { preview.src = e.target.result; preview.style.display = 'block'; };
        reader.readAsDataURL(input.files[0]);
    }
}
</script>