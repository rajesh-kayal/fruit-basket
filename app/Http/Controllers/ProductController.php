<?php

namespace App\Http\Controllers;

// use Illuminate\Http\Request; 
use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;
use App\Models\Product;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return View
     */
    public function index(): View
    {
        // $products = Product::all();
        $products= Product::orderBy('created_at', 'asc')->get();
        // dd($products);
        // die();
        return view('admin.dashboard', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return View
     */
    public function create(): View
    {
        return view('admin.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  StoreProductRequest  $request
     * @return RedirectResponse
     */
    public function store(StoreProductRequest $request): RedirectResponse
    {
        $validatedData = $request->validated();

        $imagePaths = [];
        foreach ($request->file('images') as $image) {
            $fileName = time() . "_" . $image->getClientOriginalName();
            $fileDir = 'upload';
            $image->move(public_path($fileDir), $fileName);
            $imagePaths[] = $fileDir . '/' . $fileName;
        }

        $product = new Product([
            'name' => $validatedData['name'],
            'description' => $validatedData['description'],
            'price' => $validatedData['price'],
            'category' => $validatedData['category'],
            'images' => implode(',', $imagePaths)
        ]);
        $product->save();

        return redirect()->route('dashboard')->with('success', 'Product added successfully');
    }

    
    /**
     * Show the form for editing the specified resource.
     *
     * @param  Product  $product
     * @return View
     */
    public function edit(Product $product): View
    {
        return view('admin.edit', compact('product'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  UpdateProductRequest  $request
     * @param  Product  $product
     * @return RedirectResponse
     */
    public function update(UpdateProductRequest $request, Product $product): RedirectResponse
    {
        $validatedData = $request->validated();

        if ($request->hasFile('images')) {
            $this->deleteOldImages($product); // Delete old images

            $imagePaths = [];
            foreach ($request->file('images') as $image) {
                $fileName = time() . "_" . $image->getClientOriginalName();
                $image->move(public_path('upload'), $fileName);
                $imagePaths[] = 'upload/' . $fileName;
            }

            $product->update(array_merge($validatedData, ['images' => implode(',', $imagePaths)]));
        } else {
            $product->update($validatedData);
        }

        return redirect()->route('dashboard')->with('update', 'Product updated successfully');
    }

    private function deleteOldImages(Product $product)
    {
        foreach (explode(',', $product->images) as $oldImage) {
            if (file_exists(public_path($oldImage))) {
                unlink(public_path($oldImage));
            }
        }
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  Product  $product
     * @return RedirectResponse
     */
    public function destroy(Product $product): RedirectResponse
    {
        $product->delete();

        return redirect()->route('dashboard');
    }
}
