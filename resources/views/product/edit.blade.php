@extends('layouts.app')

@section('title')
    New Product
@endsection

@section('content')
<div class="card text-bg-light mb-3">
    <div class="card-body">
        <blockquote class="blockquote">
            <form method="post" action="{{ route('product-update', ['minimarketId' => $minimarketAtt->id, 'productId' => $products->id]) }}" enctype="multipart/form-data">
                @method('put')
                @csrf
                <h1 class="mt-3 mb-4"><strong>Edit Product</strong></h1>
                @if ($products->minimarket_id == $minimarketAtt->id)
                <div class="mb-3">
                    <label for="productname" class="form-label">Product's Name</label>
                    <input class="form-control form-control-lg @error('productname') is-invalid @enderror" id="productname" name="productname" value="{{ $products->product_name }}">

                    @error('productname')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="inputGroupSelect04" class="form-label">Product's Category</label>
                    <div class="input-group mb-3">
                        <select class="form-select form-select-lg @error('productcategory') is-invalid @enderror" id="inputGroupSelect04" aria-label="Example select with button addon" name="productcategory">
                            <option disabled selected>Choose...</option>
                            @foreach ($productcategories as $category)
                                <option value="{{ $category->id }}" {{ $products->productcategory_id == $category->id ? 'selected' : '' }}>{{ $category->product_category }}</option>
                            @endforeach
                        </select>
                        <button class="btn btn-outline-secondary" type="button" data-bs-toggle="modal" data-bs-target="#exampleModal">Add New Category</button>
                    </div>
                    @error('productcategory')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>                                                                              

                <div class="mb-3">
                    <label for="productdescription" class="form-label">Product's Description</label>
                    <textarea class="form-control form-control-lg @error('productdescription') is-invalid @enderror" id="productdescription" name="productdescription" rows="3">{{ $products->description }}</textarea>

                    @error('productdescription')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="productprice" class="form-label">Product's Price</label>
                    <input class="form-control form-control-lg @error('productprice') is-invalid @enderror" id="productprice" name="productprice" value="{{ $products->price }}">

                    @error('productprice')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="pictures" class="form-label">Minimarket's Pictures</label>
                    <input class="form-control" type="file" id="pictures" accept="image/*" name="pictures">

                    @error('pictures')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror

                    <div class="row row-cols-5 gx-2 mt-4">
                        <div class="col">
                            <div class="card card-square">
                                <div class="card-body">
                                    <div class="aspect-ratio aspect-ratio-1x1">
                                        <div class="aspect-ratio-inner">
                                            @if ($products->product_image)
                                                <img src="{{ asset('storage/' . $products->product_image) }}" class="img-fluid">
                                                {{-- <a href="" class="btn-close position-absolute top-0 end-0" aria-label="Close"></a> --}}
                                            @else
                                                <p>No image available</p>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                    <button class="btn btn-primary" type="submit">Submit</button>
                </div>
                @endif
            </form>
        </blockquote>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Add New Category</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form method="post" action="{{ route('product-category-store', ['id' => $minimarketAtt->id]) }}" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-3">
                        <label for="productcategory" class="form-label">Product's Category</label>
                        <input class="form-control form-control-lg @error('productcategory') is-invalid @enderror" id="productcategory" name="productcategory" value="{{ old('productcategory') }}">
    
                        @error('productcategory')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save Category</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection