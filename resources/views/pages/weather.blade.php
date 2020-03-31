@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="bd-title text-center">{{ __('Weather') }}</h1>
    <div class="row justify-content-center">
        <div class="col-sm-12">
            <table class="table table-hover">
                <thead>
                <tr>
                    <th scope="col">{{ __('Time') }}</th>
                    <th scope="col">{{ __('Atmosphere') }}</th>
                    <th scope="col">{{ __('Temperature') }}</th>
                    <th scope="col">{{ __('Wind') }}</th>
                    <th scope="col">{{ __('Precipitation') }}</th>
                </tr>
                </thead>
                <tbody>
                @foreach ($data as $item)
                    <tr>
                        <th scope="row">{{ @$item['time'] }}</th>
                        <td>{{ @$item['atmosphere'] }}</td>
                        <td>{{ @$item['temperature'] }}</td>
                        <td>{{ @$item['wind'] }}</td>
                        <td>{{ @$item['precipitation'] }}</td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
