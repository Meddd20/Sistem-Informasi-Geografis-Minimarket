@extends('layouts.app')

@section('title')
    Product
@endsection

@section('content')

<div class="card shadow">
  <div class="card-body d-flex justify-content-between align-items-center mt-2 me-2">
    <blockquote class="blockquote">
      <h2 class="card-title fw-bold">Product List</h2>
    </blockquote>
    <div class="d-grid gap-2 d-md-flex justify-content-md-end">
      <a href="{{ route('product-create', ['id' => $minimarketAtt->id]) }}">
        <button class="btn btn-primary" type="button">Add New Product</button>
      </a>
    </div>
  </div>
  <div class="table-wrapper p-3 pt-1">
    <table class="table align-middle">
      <thead>
        <tr>
          <th scope="col">Num.</th>
          <th scope="col">Name</th>
          <th scope="col">Description</th>
          <th scope="col">Price</th>
          <th scope="col">Picture</th>
          {{-- <th scope="col">Category</th> --}}
          <th scope="col">Action</th>
        </tr>
      </thead>
      <tbody>
          @php
          $counter = 1;
          @endphp
          @foreach ($products as $product)
          @if ($product->minimarket_id == $minimarketAtt->id)
          <tr>
            <th scope="row">{{ $counter }}</th>
            <td>{{ $product->product_name }}</td>
            <td>{{ $product->description }}</td>
            <td>{{ $product->price }}</td>
            <td>
              <img src="{{ asset('storage/' . $product->product_image) }}" alt="Product Image" width="50" height="50">
            </td>
            {{-- <td>
              @if ($product->productCategory)
                  {{ $product->productCategory->product_category }}
              @else
                  N/A
              @endif
          </td> --}}
          <td>
            <div class="dropdown">
                <a class="dropdown" href="#" role="button" id="actionDropdown{{ $counter }}" data-bs-toggle="dropdown" aria-expanded="false">
                    <i class="fas fa-ellipsis-v"></i>
                </a>
                <ul class="dropdown-menu" aria-labelledby="actionDropdown{{ $counter }}">
                    <li><a class="dropdown-item" href="{{ route('product-edit', ['minimarketId' => $minimarketAtt->id, 'productId' => $product->id]) }}">Edit</a></li>
                    <li>
                      <form action="{{ route('product-delete', ['minimarketId' => $minimarketAtt->id, 'productId' => $product->id]) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="dropdown-item">Delete</button>
                      </form>
                    </li>
                    {{-- <li><a class="dropdown-item" href="#">View Details</a></li> --}}
                </ul>
            </div>
          </td>
          </tr>
          @php
          $counter++;
          @endphp
          @endif
          @endforeach
      </tbody>
    </table>
  </div>
</div>

@endsection