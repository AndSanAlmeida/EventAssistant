@extends('layouts.publicMaster')

@section('title', 'Preview Event')

@section('content')

<section class="bg-white topBox-rounded">
    <div class="container">

        <div class="section-content-extra">

            {{-- Alerts --}}
            {{-- @include('public.partials._alerts') --}}

            <div class="title-wrap">
                <h2 class="section-title">{{ $event->name }}</h2>
            </div>

            <div class="row">
                <div class="col-md-8 offset-2">
                    <p>Teste</p>
                    @foreach ($event->files as $file)
                        <p>{{ $file->caption }}</p>
                    @endforeach

                </div>
            </div>            
            
        </div>
    </div>   
</section>

@endsection