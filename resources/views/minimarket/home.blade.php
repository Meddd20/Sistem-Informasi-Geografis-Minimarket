@extends('layouts.app')

@section('title')
    Home
@endsection

@section('content')
<div class="container">
    <div class="container-fluid">
        <div class="card shadow">
            <div class="card">
                <div id="map" style="height: 85vh">
                    <script type="text/javascript">
                        let minimarkets = @json($minimarkets);
                        let createUrl = "{{ route('create') }}";
                    </script>
                    <script type="text/javascript" src="{{url('/js/leaflet-map.js')}}"></script>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
