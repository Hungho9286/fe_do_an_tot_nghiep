@extends('layouts.giangvien.giangvien')

@section('css')


@endsection

@section('content')

<script>
    $('#summernote').summernote({
        placeholder: 'Hello Bootstrap 5',
        tabsize: 2,
        height: 100
    });
</script>

@endsection



