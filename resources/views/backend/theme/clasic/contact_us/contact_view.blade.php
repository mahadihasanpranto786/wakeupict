@extends('backend.theme.clasic.admin_layouts.admin-master')
@section('title')
    Contactor Details
@endsection
{{-- menu active start --}}
@section('apparance', 'menu-open')

@section('apparance_active', 'active')

@section('contact_page', 'menu-open')

@section('menu_active_contact', 'active bg-info')

@section('contact_list_active', 'active')
{{-- menu active end --}}


{{-- menu active end --}}
@section('maincontant')


    <div class="card" style="width: 20rem;">
        <img class="card-img-top" src="{{ URL::asset($contact->image) }}" alt="Card image cap">
        <div class="card-body">
            <h5 class="card-title font-weight-bold"> Name: {{ $contact->name }}</h5><br>
            <h6 class="font-weight-bold">
                Phone: {{ $contact->phone }}</h6>
            <h6 class="font-weight-bold">
                Email: {{ $contact->email }}</h6>
            <h6 class="font-weight-bold">
                Messege: </h6>
            <p class="card-text">{!! $contact->message !!}</p>
        </div>
    </div>

@endsection
