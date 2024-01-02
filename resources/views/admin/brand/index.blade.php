@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header">{{ __('Brands') }}</div>

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
                          <a class="btn btn-primary" href="{{ route('brands.create') }}" role="button">Add Brand</a>
                        </div>
                      </div>
                    </div>

                    <table class="table align-middle">
                      <thead class="table-secondary">
                        <tr class="text-center">
                          <th scope="col" class="table-secondary">#</th>
                          <th scope="col" class="table-secondary">Name</th>
                          <th scope="col" class="table-secondary">Date Created</th>
                          <th scope="col" class="table-secondary">Date Updated</th>
                          <th scope="col" width="50px" class="table-secondary">Action</th>
                        </tr>
                      </thead>
                      <tbody>
                        @forelse($brands as $index => $brand)
                            <tr class="text-center">
                                <th scope="row">{{ $index + 1 }}</th>
                                <td>{{ $brand->name }}</td>
                                <td>{{ date_format($brand->created_at ,"d F Y H:i A"); }}</td>
                                <td>{{ date_format($brand->updated_at ,"d F Y H:i A"); }}</td>
                                <td class="d-flex justify-content-center gap-2">
                                    <!-- Edit Btn -->                                    
                                    <a class="btn btn-warning" href="{{ route('brands.edit', $brand->id) }}" role="button">Edit</a>
                                    <!-- Delete Btn -->
                                    <form id="deleteForm{{ $brand->id }}" action="{{ route('brands.destroy', $brand->id) }}" 
                                      method="POST" style="display: none;">
                                      @csrf
                                      @method('DELETE')
                                    </form>
                                    <a class="btn btn-danger" href="#" onclick="confirmDelete('{{ $brand->id }}')" role="button">Delete</a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="text-center">No brands found.</td>
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
  function confirmDelete(brandId) {
      var confirmation = confirm("Are you sure you want to delete this brand?");
      
      if (confirmation) {
          document.getElementById('deleteForm' + brandId).submit();
      }
  }
</script>
@endsection
