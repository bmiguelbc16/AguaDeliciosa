@extends('components.form.input-group-component')

{{-- Set errors bag internallly --}}

@php($setErrorsBag($errors ?? null))

{{-- Set input group item section --}}

@section('input_group_item')

  {{-- Input Switch --}}
  <input type="checkbox" id="{{ $id }}" name="{{ $name }}" {{ $checked ? 'checked' : '' }}
    {{ $attributes->merge(['class' => $makeItemClass()]) }}>

@overwrite
