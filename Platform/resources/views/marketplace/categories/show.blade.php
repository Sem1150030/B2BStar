@extends('layouts.app')

@section('content')
    @livewire('marketplace.category.products-component', ['category' => $category])
@endsection
