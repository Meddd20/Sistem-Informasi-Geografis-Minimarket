@extends('layouts.app')

@section('title')
    @if($minimarketAtt)
        {{ $minimarketAtt->name }} {{ $minimarketAtt->branch }} Facility
    @else
        No minimarket available
    @endif
@endsection

@section('content')
<div class="card shadow">
    <div class="card-body d-flex justify-content-between align-items-center mt-2 me-2">
        <blockquote class="blockquote">
            <h2 class="card-title fw-bold">Facility List</h2>
        </blockquote>

        <div class="d-grid gap-2 d-md-flex justify-content-md-end">
            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
                Add New Facility
            </button>
        </div>
    </div>
    <div class="table-wrapper p-3 pt-1">
        <!-- Create Modal -->
        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <form method="post" action="{{ route('store-facility', ['id' => $minimarketAtt->id]) }}" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="exampleModalLabel">Add Facility</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form>
                                <div class="mb-3">
                                    <label for="facilityname" class="col-form-label">Facility's Name</label>
                                    <input type="text" class="form-control @error('facilityname') is-invalid @enderror" id="facilityname" name="facilityname" value="{{ old('facilityname') }}">

                                    @error('facilityname')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="facilitydescription" class="col-form-label">Description</label>
                                    <textarea class="form-control @error('facilitydescription') is-invalid @enderror" id="facilitydescription" name="facilitydescription">{{ old('facilitydescription') }}</textarea>

                                    @error('facilitydescription')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </form>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Save changes</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        <!-- Edit Modal -->
        @foreach ($facilities as $facility)
        @if ($facility->minimarket_id == $minimarketAtt->id)
            <div class="modal fade" id="editModal_{{ $facility->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <form method="post" action="{{ route('update-facility', ['id' => $facility->id]) }}" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="modal-content">
                            <div class="modal-header">
                                <h1 class="modal-title fs-5" id="exampleModalLabel">Edit Facility</h1>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <div class="mb-3">
                                    <label for="facilityname" class="col-form-label">Facility's Name</label>
                                    <input type="text" class="form-control @error('facilityname') is-invalid @enderror" id="facilityname" name="facilityname" value="{{ $facility->facility_type }}">

                                    @error('facilityname')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="facilitydescription" class="col-form-label">Description</label>
                                    <textarea class="form-control @error('facilitydescription') is-invalid @enderror" id="facilitydescription" name="facilitydescription">{{ $facility->description }}</textarea>

                                    @error('facilitydescription')
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
        
        <table class="table align-middle">
            <thead>
                <tr>
                    <th scope="col">Num.</th>
                    <th scope="col">Facility</th>
                    <th scope="col">Detail</th>
                    <th scope="col">Actions</th>
                </tr>
            </thead>
            <tbody>
                @php
                $counter = 1;
                @endphp
                @foreach ($facilities as $facility)
                    @if ($facility->minimarket_id == $minimarketAtt->id)
                        <tr>
                            <th scope="row">{{ $counter }}</th>
                            <td>{{ $facility->facility_type }}</td>
                            <td>{{ $facility->description }}</td>
                            <td>
                                <div class="dropdown">
                                    <a class="dropdown" href="#" role="button" id="actionDropdown{{ $counter }}" data-bs-toggle="dropdown" aria-expanded="false">
                                        <i class="fas fa-ellipsis-v"></i>
                                    </a>
                                    <ul class="dropdown-menu" aria-labelledby="actionDropdown{{ $counter }}">
                                        <li><a class="dropdown-item" data-bs-toggle="modal" data-bs-target="#editModal_{{ $facility->id }}">Edit</a></li>
                                        <li>
                                            <form action="{{ route('delete-facility', ['id' => $minimarketAtt->id, 'facilityId' => $facility->id]) }}" method="POST">
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