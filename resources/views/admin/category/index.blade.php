@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header">{{ __('Category') }}</div>

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
                          <a class="btn btn-primary" href="{{ route('categories.create') }}" role="button">Add Category</a>
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
                        @forelse($categories as $index => $category)
                            <tr class="text-center">
                                <th scope="row">{{ $index + 1 }}</th>
                                <td>{{ $category->name }}</td>
                                <td>{{ date_format($category->created_at ,"d F Y H:i A"); }}</td>
                                <td>{{ date_format($category->updated_at ,"d F Y H:i A"); }}</td>
                                <td class="d-flex justify-content-center gap-2">
                                    <!-- Edit Btn -->                                    
                                    <a class="btn btn-warning" href="{{ route('categories.edit', $category->id) }}" role="button">Edit</a>
                                    <!-- Delete Btn -->
                                    <form id="deleteForm{{ $category->id }}" action="{{ route('categories.destroy', $category->id) }}" 
                                      method="POST" style="display: none;">
                                      @csrf
                                      @method('DELETE')
                                    </form>
                                    <a class="btn btn-danger" href="#" onclick="confirmDelete('{{ $category->id }}')" role="button">Delete</a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="text-center">No category found.</td>
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
  function confirmDelete(categoryId) {
      var confirmation = confirm("Are you sure you want to delete this category?");
      
      if (confirmation) {
          document.getElementById('deleteForm' + categoryId).submit();
      }
  }
</script>
@endsection
