@extends('layouts.admin')
@section('content')
    <div class="section-header">
        <h1>Tambah Produk</h1>
    </div>

    <div class="section-body">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <form class="card-body" method="POST" action="/admin/products/add" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label>Nama Produk</label>
                            <input type="text" class="form-control" name="name">
                        </div>
                        <div class="form-group">
                            <label>Deskripsi Produk</label>
                            <input type="text" class="form-control" name="description">
                        </div>
                        <div class="form-group">
                            <label>Kategori</label>
                            <select class="form-control" name="category">
                                @foreach ($categories as $category)
                                    <option value={{ $category->id }}>
                                        {{ $category->category_name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Foto Produk</label><br>
                            <input type="file" name="product_images[]" accept="image/*" multiple
                                onchange="previewImages(event)">
                        </div>

                        <div id="canvas" class='d-flex flex-row flex-wrap mb-4'>

                        </div>
                        <div class="form-group">
                            <label class="form-label">Warna</label>
                            <div class="col gutters-xs">
                                @foreach ($colors as $color)
                                    <div class="col-auto d-flex align-items-center">
                                        <input name="color" type="radio" value="{{ $color->id }}" class="mr-2"
                                            id="color_{{ $color->id }}" />
                                        <label class="colorinput" for="color_{{ $color->id }}">
                                            {{ $color->color_name }}
                                        </label>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="form-label">Size</label>
                            <div class="selectgroup w-100">
                                @foreach ($sizes as $size)
                                    <label class="selectgroup-item">
                                        <input type="radio" name="size" value="{{ $size->id }}"
                                            class="selectgroup-input">
                                        <span class="selectgroup-button">{{ $size->size_name }}</span>
                                    </label>
                                @endforeach
                            </div>
                        </div>

                        <div class="form-group">
                            <label>Currency</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <div class="input-group-text">
                                        Rp
                                    </div>
                                </div>
                                <input type="number" class="form-control currency" name="price">
                            </div>
                        </div>

                        @if ($errors->any())
                            <div class="mb-4">
                                @foreach ($errors->all() as $error)
                                    <div class="text-danger my-2">{{ $error }}</div>
                                @endforeach
                            </div>
                        @endif

                        <button class="btn btn-primary" type="submit">Tambah Produk</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('script')
    <script>
        let previewImages = (e) => {
            let target = $("#canvas");
            target.empty();
            let images = e.target.files;
            for (let i = 0; i < images.length; i++) {
                let card = `
                                                                        <div class='card m-2' style = 'width: 20rem;'> 
                                                                          <div class='shadow rounded'>
                                                                            <img src="${URL.createObjectURL(images[i])}" class='w-100'>
                                                                            <div class='card-body'>
                                                                              <h5 class='card-title text-center text-black'>Gambar ${i+1}</h5>
                                                                            </div>
                                                                          </div>
                                                                        </div>      
                                                                    `
                target.append(card);
            }
            console.log("object")
        }

    </script>
@endsection
