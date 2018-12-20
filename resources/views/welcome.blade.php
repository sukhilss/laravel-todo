@extends('layouts.app')

@section('content')
<div class="container">
    <div class="flex-center position-ref full-height">
        <div class="title m-b-md text-center">
            {{ config('app.name', 'Laravel') }}
        </div>
    </div>
</div>
@endsection
