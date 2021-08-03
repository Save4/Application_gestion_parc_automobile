@extends('layouts.layout')
@section('content')
@section('title', 'Document | ' . config('app.name'))

            {{ $document->fileName }}
            {{ $document->plaque }}

            <iframe src="/uploads/{{ $document->file }}"></iframe>
@endsection
