<?php

// ------------------------------------
// (ده السطر اللي اتصلح)
namespace App\Http\Controllers;
// ------------------------------------

// 1. غيرنا الموديل لـ Product
use App\Models\Product;
use Illuminate\Http\Request;
// 2. زودنا دي عشان نتعامل مع الملفات
use Illuminate\Support\Facades\Storage;

// 3. غيرنا اسم الكلاس
class ProductController extends Controller
{
    public function index()
    {
        // 4. غيرنا المتغيرات دي
        $products = Product::latest()->paginate(5); // .latest()->paginate(5) عشان يعرض أحدث 5 بس
        return view('products.index', compact('products'));
    }

    public function create()
    {
        // 5. غيرنا المسار ده
        return view('products.create');
    }

    public function store(Request $request)
    {
        // 6. عدلنا الـ validation
        $request->validate([
            'title' => 'required',
            'description' => 'required',
            'price' => 'required|numeric',
            'quantity' => 'required|integer',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048', // خليناه اختياري
        ]);

        $input = $request->all();

        // 7. ضفنا كود حفظ الصورة
        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('images', 'public');
            $input['image'] = $path;
        }

        // 8. غيرنا دي لـ Product
        Product::create($input);
        // 9. غيرنا اللينك ده
        return redirect()->route('products.index')->with('success', 'Product created successfully.');
    }

    public function show(Product $product)
    {
        // 10. غيرنا المتغيرات دي
        return view('products.show', compact('product'));
    }

    public function edit(Product $product)
    {
        // 11. غيرنا المتغيرات دي
        return view('products.edit', compact('product'));
    }

    public function update(Request $request, Product $product)
    {
        // 12. عدلنا الـ validation
        $request->validate([
            'title' => 'required',
            'description' => 'required',
            'price' => 'required|numeric',
            'quantity' => 'required|integer',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $input = $request->all();

        // 13. ضفنا كود تعديل الصورة
        if ($request->hasFile('image')) {
            // امسح الصورة القديمة لو موجودة
            if ($product->image) {
                Storage::disk('public')->delete($product->image);
            }
            $path = $request->file('image')->store('images', 'public');
            $input['image'] = $path;
        }

        // 14. غيرنا المتغير ده
        $product->update($input);
        // 15. غيرنا اللينك ده
        return redirect()->route('products.index')->with('success', 'Product updated successfully.');
    }

    public function destroy(Product $product)
    {
        // 16. ضفنا كود مسح الصورة مع المنتج
        if ($product->image) {
            Storage::disk('public')->delete($product->image);
        }

        // 17. غيرنا المتغير ده
        $product->delete();
        // 18. غيرنا اللينك ده
        return redirect()->route('products.index')->with('success', 'Product deleted successfully.');
    }
}