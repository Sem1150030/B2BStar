@extends('layouts.backoffice')

@section('content')
    <div>
        @livewire('backoffice.products.edit-product-form', ['product' => $product])
    </div>
@endsection
