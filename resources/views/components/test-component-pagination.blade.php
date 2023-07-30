<div>
    @foreach($products as $product)
   {{ $product->name}}
    @endforeach
    <div><span>{{ $products->links() }}</span></div>
</div>