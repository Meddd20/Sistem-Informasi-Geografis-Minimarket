@extends('layouts.app')

@section('title')
    New Minimarket
@endsection

@section('content')
<div class="card shadow">
    <div class="card-body">
        <blockquote class="blockquote">
            <form method="post" action="{{ route('store') }}" enctype="multipart/form-data">
                @csrf
                <h1 class="mt-3 mb-4"><strong>NEW MINIMARKET</strong></h1>
                <div id="mapid" class="mb-3" style="height: 300px;"></div>
                <script>
                    var mapincreate = L.map('mapid').setView([-8.443107990508,115.10995605616532], 10);
                    var marker;
                
                    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                        attribution: 'Map data © <a href="https://openstreetmap.org">OpenStreetMap</a> contributors',
                        maxZoom: 18,
                    }).addTo(mapincreate);
                
                    var myIcon = L.icon({
                        iconUrl: '{{ asset('cart.png') }}',
                        iconSize: [70, 60]
                    });
                
                    mapincreate.on("click", function(e) {
                        if (marker) {
                            mapincreate.removeLayer(marker);
                        }
                        var lat = e.latlng.lat;
                        var lng = e.latlng.lng;
                        document.querySelector("#latitude").value = lat;
                        document.querySelector("#longitude").value = lng;
                        marker = new L.Marker([lat, lng], {
                            icon: myIcon,
                            draggable: true,
                        }).addTo(mapincreate);
                
                        marker.on("dragend", function(e) {
                            var draggedMarker = e.target;
                            var newLat = draggedMarker.getLatLng().lat;
                            var newLng = draggedMarker.getLatLng().lng;
                            document.querySelector("#latitude").value = newLat;
                            document.querySelector("#longitude").value = newLng;
                        });
                    });
                </script>
                <div class="row">
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="latitude" class="form-label">Latitude</label>
                            <input class="form-control form-control-lg @error('latitude') is-invalid @enderror" id="latitude" name="latitude" value="{{ old('latitude') }}" readonly>

                            @error('latitude')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="longitude" class="form-label">Longitude</label>
                            <input class="form-control form-control-lg @error('longitude') is-invalid @enderror" id="longitude" name="longitude" value="{{ old('longitude') }}" readonly>

                            @error('longitude')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="mb-3">
                    <label for="name" class="form-label">Minimarket's Name</label>
                    <input class="form-control form-control-lg @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name') }}">

                    @error('name')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="branch" class="form-label">Minimarket's Branch</label>
                    <input class="form-control form-control-lg @error('branch') is-invalid @enderror" id="branch" name="branch" value="{{ old('branch') }}">

                    @error('branch')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="company" class="form-label">Minimarket's Company</label>
                    <input class="form-control form-control-lg @error('company') is-invalid @enderror" id="company" name="company" value="{{ old('company') }}">

                    @error('company')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="address" class="form-label">Minimarket's Address</label>
                    <textarea class="form-control form-control-lg @error('address') is-invalid @enderror" id="address" name="address" rows="3">{{ old('address') }}</textarea>

                    @error('address')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="contactnum" class="form-label">Minimarket's Contact Number</label>
                    <input class="form-control form-control-lg @error('contactnum') is-invalid @enderror" id="contactnum" name="contactnum" value="{{ old('contactnum') }}">

                    @error('contactnum')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="website" class="form-label">Minimarket's Website</label>
                    <input class="form-control form-control-lg @error('website') is-invalid @enderror" id="website" name="website" value="{{ old('website') }}">

                    @error('website')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="email" class="form-label">Minimarket's Email</label>
                    <input type="email" class="form-control form-control-lg @error('email') is-invalid @enderror" id="email" name="email" value="{{ old('email') }}">

                    @error('email')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="customerservice" class="form-label">Minimarket's Contact Number</label>
                    <input class="form-control form-control-lg @error('customerservice') is-invalid @enderror" id="customerservice" name="customerservice" value="{{ old('customerservice') }}">

                    @error('customerservice')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="operationalhour" class="form-label">Minimarket's Operational Hour</label>
                    <textarea class="form-control form-control-lg @error('operationalhour') is-invalid @enderror" id="operationalhour" name="operationalhour" rows="3">{{ old('operationalhour') }}</textarea>

                    @error('operationalhour')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="description" class="form-label">Minimarket's Description</label>
                    <textarea class="form-control form-control-lg @error('description') is-invalid @enderror" id="description" name="description" rows="3">{{ old('description') }}</textarea>

                    @error('description')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="pictures" class="form-label">Minimarket's Pictures</label>
                    <input class="form-control" type="file" id="pictures" multiple required accept="image/*" name="pictures[]">
                </div>

                <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                    <button class="btn btn-primary" type="submit">Submit</button>
                </div>

            </form>
        </blockquote>
    </div>
</div>
@endsection