@extends('layouts.master')

@section('content')

    <router-create-page 
                :router="{{json_encode($router)}}" 
                :meta="{{json_encode($meta)}}"
                        >
    </router-create-page>   
@endsection