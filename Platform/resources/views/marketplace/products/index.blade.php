@extends('layouts.app')

@section('content')
    @livewire('marketplace.products.product-details-component', ['product' => $product])
@endsection
