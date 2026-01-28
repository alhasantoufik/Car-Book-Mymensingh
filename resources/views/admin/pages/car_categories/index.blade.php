@extends('dashboard')
@section('title', 'Car Setup')
@section('content')

<style>
    body {
        background-color: #f5f9ff;
    }

    .card-custom {
        background: #fffaf0; /* cream */
        border: 1px solid #d6e4ff;
        border-radius: 10px;
        box-shadow: 0 4px 10px rgba(0,0,0,0.05);
    }

    .card-header-custom {
        background: #e3f0ff; /* light blue */
        color: #0d6efd;
        font-weight: 600;
        border-radius: 10px 10px 0 0;
    }

    .btn-blue {
        background-color: #0d6efd;
        color: #fff;
    }

    .btn-blue:hover {
        background-color: #0b5ed7;
        color: #fff;
    }
</style>

<div class="container-fluid p-0">
    <h4 class="mb-4 text-primary">🚗 Car Brand & Category Setup</h4>

    {{-- Success Message --}}
    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <div class="row">

        {{-- Car Brand --}}
        <div class="col-md-6 mb-4">
            <div class="card card-custom">
                <div class="card-header card-header-custom">
                    Add Car Brand
                </div>
                <div class="card-body">

                    <form action="{{ route('admin.car-brands.store') }}" method="POST" onsubmit="return confirmSubmit()">
                        @csrf

                        <div class="mb-3">
                            <label class="form-label">Brand Name</label>
                            <input type="text" name="name"
                                   class="form-control @error('name') is-invalid @enderror"
                                   placeholder="e.g. Toyota, BMW"
                                   required>

                            @error('name')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <button type="submit" class="btn btn-blue">
                            ➕ Add Brand
                        </button>
                    </form>

                </div>
            </div>
        </div>

        {{-- Car Category --}}
        <div class="col-md-6 mb-4">
            <div class="card card-custom">
                <div class="card-header card-header-custom">
                    Add Car Category
                </div>
                <div class="card-body">

                    <form action="{{ route('admin.car-categories.store') }}" method="POST" onsubmit="return confirmSubmit()">
                        @csrf

                        <div class="mb-3">
                            <label class="form-label">Category Name</label>
                            <input type="text" name="name"
                                   class="form-control @error('name') is-invalid @enderror"
                                   placeholder="e.g. Sedan, SUV"
                                   required>

                            @error('name')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <button type="submit" class="btn btn-blue">
                            ➕ Add Category
                        </button>
                    </form>

                </div>
            </div>
        </div>

    </div>
</div>

{{-- Simple JS --}}
<script>
    function confirmSubmit() {
        return confirm('Are you sure you want to add this item?');
    }
</script>

@endsection
