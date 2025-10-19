@extends('layouts.app')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-3">
        {{-- 1. غيرنا العنوان --}}
        <h2>Products List</h2>
        {{-- 2. غيرنا اللينك والزرار --}}
        <a href="{{ route('products.create') }}" class="btn btn-success">Add New Product</a>
    </div>

    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    {{-- 3. مسحنا الجدول وحطينا كروت --}}
    <div class="row">
        {{-- 4. غيرنا المتغير لـ products --}}
        @foreach ($products as $product)
            <div class="col-xs-12 col-sm-6 col-md-4 col-lg-3 mb-4">
                <div class="card h-100">
                    {{-- 5. ضفنا كود عرض الصورة (مع صورة احتياطية لو مفيش) --}}
                    <img src="{{ $product->image ? asset('storage/' . $product->image) : 'https://via.placeholder.com/300x200' }}"
                         class="card-img-top" alt="{{ $product->title }}" style="height: 200px; object-fit: cover;">

                    <div class="card-body d-flex flex-column">
                        <h5 class="card-title">{{ $product->title }}</h5>

                        {{-- 6. ضفنا الوصف (مع تحديد الطول) --}}
                        <p class="card-text">{{ \Illuminate\Support\Str::limit($product->description, 50) }}</p>

                        {{-- 7. ضفنا السعر والكمية --}}
                        <h6 class="card-subtitle mb-2 text-muted">${{ $product->price }}</h6>
                        <p class="card-text"><small>Quantity: {{ $product->quantity }}</small></p>

                        {{-- 8. ضفنا الزراير (وغيرنا الروابط) --}}
                        <div class="mt-auto text-center">
                            <form action="{{ route('products.destroy', $product->id) }}" method="POST" class="d-inline">
                                {{-- غيرنا اللينك ده --}}
                                <a href="{{ route('products.edit', $product->id) }}" class="btn btn-warning btn-sm">Edit</a>
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm"
                                        onclick="return confirm('Are you sure?')">Delete
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>

    {{-- 9. ضفنا كود الـ Pagination (عشان الصفحات) --}}
    <div class="d-flex justify-content-center">
        {!! $products->links('pagination::bootstrap-5') !!}
    </div>
@endsection