@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                {{-- 1. غيرنا العنوان --}}
                <h2>Edit Product</h2>
            </div>
            <div class="pull-right">
                {{-- 2. غيرنا اللينك ده --}}
                <a class="btn btn-primary" href="{{ route('products.index') }}"> Back</a>
            </div>
        </div>
    </div>

    @if ($errors->any())
        <div class="alert alert-danger">
            <strong>Whoops!</strong> There were some problems with your input.<br><br>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    {{-- 3. غيرنا الـ action والمتغير $product وزودنا enctype --}}
    <form action="{{ route('products.update', $product->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Title:</strong>
                    {{-- 4. غيرنا المتغير $product --}}
                    <input type="text" name="title" value="{{ $product->title }}" class="form-control" placeholder="Title">
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Description:</strong>
                    {{-- 5. غيرنا المتغير $product --}}
                    <textarea class="form-control" style="height:150px" name="description" placeholder="Description">{{ $product->description }}</textarea>
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Price:</strong>
                    {{-- 6. غيرنا المتغير $product --}}
                    <input type="number" name="price" value="{{ $product->price }}" class="form-control" placeholder="Price" step="0.01">
                </div>
            </div>

            {{-- 7. زودنا حقل الكمية --}}
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Quantity:</strong>
                    <input type="number" name="quantity" value="{{ $product->quantity }}" class="form-control" placeholder="Quantity">
                </div>
            </div>

            {{-- 8. زودنا حقل الصورة وعرض الصورة القديمة --}}
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Image:</strong>
                    <input type="file" name="image" class="form-control">
                    @if($product->image)
                        <img src="/storage/{{ $product->image }}" width="100px" class="mt-2">
                    @endif
                </div>
            </div>

            <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                <button type="submit" class="btn btn-primary">Submit</button>
            </div>
        </div>
    </form>
@endsection