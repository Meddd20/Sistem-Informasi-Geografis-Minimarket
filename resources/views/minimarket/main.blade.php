@extends('layouts.app')

@section('title')
    Minimarket
@endsection

@section('content')

<div class="card shadow">
  <div class="card-body d-flex justify-content-between align-items-center mt-2 me-2">
    <h2 class="card-title fw-bold">Minimarket List</h2>
    <div class="d-grid gap-2 d-md-flex justify-content-md-end">
      <a href="{{ route('create') }}">
        <button class="btn btn-primary" type="button">Create New Minimarket</button>
      </a>
    </div>
  </div>
  <div class="table-wrapper p-3 pt-1">
    <table class="table align-middle">
      <thead>
        <tr>
          <th scope="col">Num.</th>
          <th scope="col">Name</th>
          <th scope="col">Branch</th>
          <th scope="col">Company</th>
          <th scope="col">Address</th>
          <th scope="col">Website</th>
          <th scope="col">Action</th>
        </tr>
      </thead>
      <tbody>
          @php
          $counter = 1;
          @endphp
          @foreach ($minimarketAtt as $minimarket)
          <tr>
            <th scope="row">{{ $counter }}</th>
            <td>{{ $minimarket->name }}</td>
            <td>{{ $minimarket->branch }}</td>
            <td>{{ $minimarket->company }}</td>
            <td>{{ $minimarket->address }}</td>
            <td>{{ $minimarket->website }}</td>
            <td>
              <div class="dropdown">
                <a class="dropdown" href="#" role="button" id="actionDropdown{{ $counter }}" data-bs-toggle="dropdown" aria-expanded="false">
                  <i class="fas fa-ellipsis-v"></i>
                </a>
                <ul class="dropdown-menu" aria-labelledby="actionDropdown{{ $counter }}">
                  <li><a class="dropdown-item" href="{{ route('detail', ['id' => $minimarket->id]) }}">Detail Minimarket</a></li>
                  <li><a class="dropdown-item" href="{{ route('edit', ['id' => $minimarket->id]) }}">Edit Minimarket</a></li>
                  <li>
                    <form action="{{ route('delete', $minimarket->id) }}" method="POST">
                      @csrf
                      @method('DELETE')
                      <button type="submit" class="dropdown-item">Delete Minimarket</button>
                    </form>
                  </li>
                  <li><a class="dropdown-item" href="{{ route('facility', ['id' => $minimarket->id]) }}">Add Facilities</a></li>
                  <li><a class="dropdown-item" href="{{ route('product', ['id' => $minimarket->id]) }}">Add Product</a></li>
                  <li><a class="dropdown-item" href="{{ route('supplier', ['id' => $minimarket->id]) }}">Add Supplier</a></li>
                </ul>
              </div>
            </td>
          </tr>
          @php
          $counter++;
          @endphp
          @endforeach
      </tbody>
    </table>
  </div>
</div>

@endsection