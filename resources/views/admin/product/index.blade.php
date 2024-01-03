@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header">{{ __('Products') }}</div>

                <div class="card-body">
                  @if (session('message'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        {{ session('message') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                  @endif

                    <div class="container mb-4">
                      <div class="row">
                        <div class="col">
                          
                        </div>
                        <div class="col">
                          
                        </div>
                        <div class="col text-end">
                          <a class="btn btn-primary" href="{{ route('admin.products.create') }}" role="button">Add Product</a>
                        </div>
                      </div>
                    </div>

                    <table class="table align-middle">
                      <thead class="table-secondary">
                        <tr class="text-center">
                          <th scope="col" class="table-secondary">#</th>
                          <th scope="col" class="table-secondary">Name</th>
                          <th scope="col" class="table-secondary">Price</th>
                          <th scope="col" class="table-secondary">Brand</th>
                          <th scope="col" class="table-secondary">Categories</th>
                          <th scope="col" class="table-secondary">Sizes</th>
                          <th scope="col" class="table-secondary">Colors</th>
                          <th scope="col" width="50px" class="table-secondary">Action</th>
                        </tr>
                      </thead>
                      <tbody>
                        @forelse($products as $index => $product)
                            <tr class="text-center">
                                <th scope="row">{{ $index + 1 }}</th>
                                <td>{{ $product->name }}</td>
                                <td>{{ $product->price }}</td>
                                <td>{{ $product->brands->first()->name }}</td>
                                <td>
                                  @foreach ($product->categories as $category)
                                      {{ $category->name }}
                                      @if (!$loop->last)
                                          , <!-- Add a comma if it's not the last category -->
                                      @endif
                                  @endforeach  
                                </td>
                                <td>
                                  @foreach ($product->sizes as $size)
                                      {{ $size->name }}
                                      @if (!$loop->last)
                                          , <!-- Add a comma if it's not the last category -->
                                      @endif
                                  @endforeach  
                                </td>
                                <td>
                                  @foreach ($product->colors as $color)
                                      {{ $color->name }}
                                      @if (!$loop->last)
                                          , <!-- Add a comma if it's not the last category -->
                                      @endif
                                  @endforeach  
                                </td>
                                <td class="d-flex justify-content-center gap-2">
                                    <!-- Edit Btn -->                                    
                                    <a class="btn btn-warning" href="{{ route('admin.products.edit', $product->id) }}" role="button">Edit</a>
                                    <!-- Delete Btn -->
                                    <form id="deleteForm{{ $product->id }}" action="{{ route('admin.products.destroy', $product->id) }}" 
                                      method="POST" style="display: none;">
                                      @csrf
                                      @method('DELETE')
                                    </form>
                                    <a class="btn btn-danger" href="#" onclick="confirmDelete('{{ $product->id }}')" role="button">Delete</a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="text-center">No products found.</td>
                            </tr>
                        @endforelse
                      </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
  function confirmDelete(productId) {
      var confirmation = confirm("Are you sure you want to delete this product?");
      
      if (confirmation) {
          document.getElementById('deleteForm' + productId).submit();
      }
  }
</script>
@endsection
