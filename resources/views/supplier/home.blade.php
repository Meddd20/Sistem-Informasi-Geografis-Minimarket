@extends('layouts.app')

@section('title')
    @if($minimarketAtt)
        {{ $minimarketAtt->name }} {{ $minimarketAtt->branch }} Supplier
    @else
        No minimarket available
    @endif
@endsection

@section('content')
<div class="card shadow">
    <div class="card-body d-flex justify-content-between align-items-center mt-2 me-2">
        <blockquote class="blockquote">
            <h2 class="card-title fw-bold">Supplier List</h2>
        </blockquote>
      
        <div class="d-grid gap-2 d-md-flex justify-content-md-end">
            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
                Add New Supplier
            </button>
        </div>
    </div>
    
    <!-- Create Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form method="post" action="{{ route('store-supplier', ['id' => $minimarketAtt->id]) }}" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">Add Supplier</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="suppliername" class="col-form-label">Supplier's Name</label>
                            <input type="text" class="form-control @error('suppliername') is-invalid @enderror" id="suppliername" name="suppliername" value="{{ old('suppliername') }}">

                            @error('suppliername')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="supplierdescription" class="col-form-label">Supplier's Description</label>
                            <textarea type="text" class="form-control @error('supplierdescription') is-invalid @enderror" id="supplierdescription" name="supplierdescription">{{ old('supplierdescription') }}</textarea>

                            @error('supplierdescription')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="supplierphonenum" class="col-form-label">Supplier's Phone Number</label>
                            <input type="text" class="form-control @error('supplierphonenum') is-invalid @enderror" id="supplierphonenum" name="supplierphonenum" value="{{ old('supplierphonenum') }}">

                            @error('supplierphonenum')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="supplieraddress" class="col-form-label">Supplier's Address</label>
                            <textarea type="text" class="form-control @error('supplieraddress') is-invalid @enderror" id="supplieraddress" name="supplieraddress">{{ old('supplieraddress') }}</textarea>

                            @error('supplieraddress')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="supplierwebsite" class="col-form-label">Supplier's Website</label>
                            <input type="text" class="form-control @error('supplierwebsite') is-invalid @enderror" id="supplierwebsite" name="supplierwebsite" value="{{ old('supplierwebsite') }}">

                            @error('supplierwebsite')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Edit Modal -->
    @foreach ($suppliers as $supplier)
    @if ($supplier->minimarket_id == $minimarketAtt->id)
        <div class="modal fade" id="editModal_{{ $supplier->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <form method="post" action="{{ route('update-supplier', ['id' => $supplier->id]) }}" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="exampleModalLabel">Edit Supplier</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="mb-3">
                                <label for="suppliername" class="col-form-label">Supplier's Name</label>
                                <input type="text" class="form-control @error('suppliername') is-invalid @enderror" id="suppliername" name="suppliername" value="{{ $supplier->supplier }}">
    
                                @error('suppliername')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
    
                            <div class="mb-3">
                                <label for="supplierdescription" class="col-form-label">Supplier's Description</label>
                                <textarea type="text" class="form-control @error('supplierdescription') is-invalid @enderror" id="supplierdescription" name="supplierdescription">{{ $supplier->description }}</textarea>
    
                                @error('supplierdescription')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
    
                            <div class="mb-3">
                                <label for="supplierphonenum" class="col-form-label">Supplier's Phone Number</label>
                                <input type="text" class="form-control @error('supplierphonenum') is-invalid @enderror" id="supplierphonenum" name="supplierphonenum" value="{{ $supplier->phone_num }}">
    
                                @error('supplierphonenum')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
    
                            <div class="mb-3">
                                <label for="supplieraddress" class="col-form-label">Supplier's Address</label>
                                <textarea type="text" class="form-control @error('supplieraddress') is-invalid @enderror" id="supplieraddress" name="supplieraddress">{{ $supplier->address }}</textarea>
    
                                @error('supplieraddress')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
    
                            <div class="mb-3">
                                <label for="supplierwebsite" class="col-form-label">Supplier's Website</label>
                                <input type="text" class="form-control @error('supplierwebsite') is-invalid @enderror" id="supplierwebsite" name="supplierwebsite" value="{{ $supplier->website }}">
    
                                @error('supplierwebsite')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Save changes</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    @endif
    @endforeach

    <div class="table-wrapper p-3 pt-1">
        <table class="table align-middle">
            <thead>
                <tr>
                    <th scope="col">Num.</th>
                    <th scope="col">Supplier</th>
                    <th scope="col">Description</th>
                    <th scope="col">Phone Number</th>
                    <th scope="col">Address</th>
                    <th scope="col">Website</th>
                    <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody>
                @php
                $counter = 1;
                @endphp
                @foreach ($suppliers as $supplier)
                @if ($supplier->minimarket_id == $minimarketAtt->id)
                <tr>
                <th scope="row">{{ $counter }}</th>
                <td>{{ $supplier->supplier }}</td>
                <td>{{ $supplier->description }}</td>
                <td>{{ $supplier->phone_num }}</td>
                <td>{{ $supplier->address }}</td>
                <td>{{ $supplier->website }}</td>
                <td>
                    <div class="dropdown">
                    <a class="dropdown" href="#" role="button" id="actionDropdown{{ $counter }}" data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="fas fa-ellipsis-v"></i>
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="actionDropdown{{ $counter }}">
                        <li><a class="dropdown-item" data-bs-toggle="modal" data-bs-target="#editModal_{{ $supplier->id }}">Edit</a></li>
                        <li>
                            <form action="{{ route('delete-supplier', ['id' => $minimarketAtt->id, 'supplierId' => $supplier->id]) }}" method="POST">
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