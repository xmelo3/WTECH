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

        <div class="form-group">
            <label for="category_id">Category</label>
            <select id="category_id" name="category_id">
                <option value="">— none —</option>
                @foreach(\App\Models\Category::orderBy('name')->get() as $c)
                    <option value="{{ $c->id }}"
                        @selected(old('category_id', $product->category_id ?? null) == $c->id)>
                        {{ $c->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="form-group full">
            <label for="short_description">Short Description</label>
            <textarea id="short_description" name="short_description" style="min-height:60px;">{{ old('short_description', $product->short_description ?? '') }}</textarea>
            @error('short_description')<span class="error">{{ $message }}</span>@enderror
        </div>

        <div class="form-group full">
            <label for="description">Full Description <span style="color:red">*</span></label>
            <textarea id="description" name="description" required>{{ old('description', $product->description ?? '') }}</textarea>
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
            <label for="main_image">Main Image (jpg/png/webp, max 4 MB)
                @if($method !== 'PUT') <span style="color:red">*</span> @endif
            </label>
            <input type="file" id="main_image" name="main_image" accept="image/jpeg,image/png,image/webp"
                   onchange="previewImg(this)" @if($method !== 'PUT') required @endif>
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

        <hr class="section-divider">
        <p class="section-label">Additional Images</p>

        <div class="form-group full">
            <label for="images">Additional Images (multi-select)
                @if($method !== 'PUT') <span style="color:red">*</span> @endif
            </label>
            @if($method !== 'PUT')
                <small style="color:#888;display:block;margin-bottom:.3rem;">At least 1 additional image required</small>
            @endif
            <input type="file" id="images" name="images[]"
                accept="image/jpeg,image/png,image/webp" multiple>
            @error('images')<span class="error">{{ $message }}</span>@enderror
            @error('images.*')<span class="error">{{ $message }}</span>@enderror
        </div>

        @if(isset($product) && $product->images->isNotEmpty())
        <div class="form-group full">
            <p style="font-size:.85rem;color:#666;">Existing images — tick to remove on save</p>
            <div class="image-list" style="display:flex;flex-wrap:wrap;gap:.6rem;">
            @foreach($product->images as $img)
                <label style="border:1px solid #ddd;border-radius:8px;padding:.4rem;display:flex;flex-direction:column;align-items:center;gap:.3rem;">
                    <img src="{{ $img->url }}" style="width:90px;height:90px;object-fit:cover;border-radius:6px;">
                    <span style="font-size:.75rem;">
                        <input type="checkbox" name="delete_images[]" value="{{ $img->id }}"> remove
                    </span>
                </label>
            @endforeach
            </div>
        </div>
        @endif

    </div>

    <div style="margin-top:1.8rem;display:flex;gap:.8rem;">
        <button type="submit" class="btn btn-primary">
            {{ $method === 'PUT' ? 'Save Changes' : ' Create Product' }}
        </button>
        <a href="{{ route('admin.products.index') }}" class="btn btn-secondary">Cancel</a>
    </div>
</form>

<script src="{{ asset('js/admin-product-form.js') }}"></script>