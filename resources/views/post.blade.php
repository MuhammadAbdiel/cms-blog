@extends('layouts.app')

@section('single-post')
{!! $post->lb_raw_content !!}
@endsection