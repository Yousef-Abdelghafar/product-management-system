@extends('layouts.app')

@section('content')
        <h2>{{ $course->title }}</h2>
        <p>{{ $course->description }}</p>
        <p><strong>Price:</strong> ${{ $course->price }}</p>
        <a href="{{ route('courses.index') }}" class="btn btn-primary">Back</a>
@endsection
