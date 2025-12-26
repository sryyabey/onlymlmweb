@extends('livewire.welcome.app')

@section('content')
    @livewire('documents.document-detail-component', ['slug' => $slug])
@endsection
