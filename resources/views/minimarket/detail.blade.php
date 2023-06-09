@extends('layouts.app')

@section('title')
  @if($minimarketAtt)
    {{ $minimarketAtt->name }} {{ $minimarketAtt->branch }}
  @else
    No minimarket available
  @endif
@endsection

@section('content')

<div class="card shadow">
  <div class="card-body">
    <div class="row mt-3 mb-5">
      <div class="col-sm-6 mb-3 mb-sm-0">
        <div id="minimarketPictures" class="carousel slide">
          <div class="carousel-inner mt-5 me-5">
            @foreach ($pictures as $picture)
            @if ($picture->minimarket_id == $minimarketAtt->id)
                @if ($picture->is_thumbnail == 1)
                  <div class="carousel-item active">
                    <img src="{{url('/images/minimarkets/'.$picture->path)}}" class="d-block w-100" alt="{{url('/images/minimarkets/'.$picture->path)}}">
                  </div>
                @else
                  <div class="carousel-item">
                    <img src="{{url('/images/minimarkets/'.$picture->path)}}" class="d-block w-100" alt="{{url('/images/minimarkets/'.$picture->path)}}">
                  </div>
                @endif
            @endif
            @endforeach
          </div>
          <button class="carousel-control-prev" type="button" data-bs-target="#minimarketPictures" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
          </button>
          <button class="carousel-control-next" type="button" data-bs-target="#minimarketPictures" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
          </button>
        </div>
      </div>
      
      <div class="col-sm-6 mt-5">
        <figure>
          <blockquote class="blockquote">
            <h1><strong>{{ $minimarketAtt->name }} {{ $minimarketAtt->branch }}</strong></h1>
            <h5>{{ $minimarketAtt->company }}</h5>
            <h5 class="mt-4 mb-4">{{ $minimarketAtt->description }}</h5>
            <h5>
              <i class="fas fa-map-marker-alt"></i>
              <span class="ml-2">{{ $minimarketAtt->address }}</span>
            </h5>
            <ul class="list-unstyled">
              <li><i class="fas fa-phone"></i> <span class="ml-2"><a href="tel:{{ $minimarketAtt->contact_num }}">{{ $minimarketAtt->contact_num }}</a></span></li>
              <li><i class="fas fa-globe"></i> <span class="ml-2"><a href="{{ $minimarketAtt->website }}">{{ $minimarketAtt->website }}</a></span></li>
              <li><i class="far fa-envelope"></i> <span class="ml-2"><a href="mailto:{{ $minimarketAtt->email }}">{{ $minimarketAtt->email }}</a></span></li>
              <li><i class="fas fa-headset"></i> <span class="ml-2"><a href="tel:{{ $minimarketAtt->customer_service_contact }}">{{ $minimarketAtt->customer_service_contact }}</a></span></li>
              <li><i class="far fa-clock"></i> <span class="ml-2">{{ $minimarketAtt->operational_hour }}</span></li>
            </ul>

            @php
              $minimarketFacilities = $minimarketFacilities->where('minimarket_id', $minimarketAtt->id);
            @endphp

            @if ($minimarketFacilities->isNotEmpty())
              <h5 class="mt-5">Facilities:</h5>
              @foreach ($minimarketFacilities as $facility)
                <i class="fas fa-check"></i> {{ $facility->facility_type }}<br>
              @endforeach
            @endif
            
          </blockquote>
        </figure>
      </div>
    </div>
  </div>
</div>

@php
  $suppliers = $suppliers->where('minimarket_id', $minimarketAtt->id);
  $products = $products->where('minimarket_id', $minimarketAtt->id);
  $cardCount = count($suppliers);
  $slideCount = ceil($cardCount / 4);
@endphp

@if ($suppliers->isNotEmpty())
<div class="card shadow mt-3">
  <div class="card-body">
    <blockquote class="blockquote mt-2">
      <h4 class="card-title fw-bold">Supplier</h4>
    </blockquote>
    <div id="supplierSlide" class="carousel slide" data-bs-ride="carousel">
      <div class="carousel-inner">
        @php
          $cardCount = count($suppliers->where('minimarket_id', $minimarketAtt->id));
          $slideCount = ceil($cardCount / 4);
        @endphp
        
        @for ($i = 0; $i < $slideCount; $i++)
          <div class="carousel-item{{ $i === 0 ? ' active' : '' }}">
            <div class="cards-wrapper row row-cols-1 row-cols-md-4 g-4">
              @foreach ($suppliers->where('minimarket_id', $minimarketAtt->id)->skip($i * 4)->take(4) as $supplier)
                <div class="card mr-3">
                  <div class="card-body">
                    <h5 class="card-title">{{ $supplier->supplier }}</h5>
                    <h6 class="card-subtitle mb-2 text-body-secondary">{{ $supplier->description }}</h6>
                    <p class="card-text">{{ $supplier->phone_num }}</p>
                    <p class="card-text">{{ $supplier->address }}</p>
                    <p class="card-text">{{ $supplier->website }}</p>
                  </div>
                </div>
              @endforeach
            </div>
          </div>
        @endfor
      </div>
      <button class="carousel-control-prev btn btn-secondary" type="button" data-bs-target="#supplierSlide" data-bs-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Previous</span>
      </button>
      <button class="carousel-control-next btn btn-secondary" type="button" data-bs-target="#supplierSlide" data-bs-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Next</span>
      </button>
    </div>
  </div>
</div>
@endif

@if ($products->isNotEmpty())
  <div class="card shadow mt-3">
    <div class="card-body">
      <blockquote class="blockquote mt-2">
        <h4 class="card-title fw-bold">Product</h4>
      </blockquote>
      <div class="row row-cols-1 row-cols-md-5 g-4">
        @foreach ($products as $product)
          @if ($product->minimarket_id == $minimarketAtt->id)
            <div class="col">
              <div class="card h-100">
                <img src="{{ asset('storage/' . $product->product_image) }}" class="card-img-top" alt="{{ $product->product_name }}">
                <div class="card-body">
                  <h5 class="card-title">{{ $product->product_name }}</h5>
                  <p class="card-text">{{ $product->description }}</p>
                </div>
                <div class="card-footer">
                  <small class="text-body-secondary">Rp.{{ $product->price }}</small>
                </div>
              </div>
            </div>
          @endif
        @endforeach 
      </div>
    </div>
  </div>
@endif

<div class="card shadow mt-3">
  <div id="mapid" style="height: 300px;"></div>
  <script>
    var mapincreate = L.map('mapid').setView([{{ $minimarketAtt->latitude }}, {{ $minimarketAtt->longitude }}], 12);
    var marker;

    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        attribution: 'Map data © <a href="https://openstreetmap.org">OpenStreetMap</a> contributors',
        maxZoom: 18,
    }).addTo(mapincreate);

    var myIcon = L.icon({
        iconUrl: '{{ asset('cart.png') }}',
        iconSize: [70, 60]
    });

    marker = new L.Marker([{{ $minimarketAtt->latitude }}, {{ $minimarketAtt->longitude }}], {
        icon: myIcon
    }).addTo(mapincreate);
  </script>
</div>

@endsection