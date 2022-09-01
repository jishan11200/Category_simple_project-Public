<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{-- {{ __('Dashboard') }} --}}
            Hi......{{Auth::user()->name}}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="container mt-3">
            <div class="row">
                <div class="col-lg-8">
                    @if (session('success'))
                        <div class="alert alert-warning alert-dismissible fade show" role="alert">
                            <strong>{{session('success')}}</strong>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                      </div>
                    @endif
                    <table class="table table-bordered table-responsive table-hover">
                        <thead class="text-center">
                            <tr>
                                <th>SL</th>
                                <th>Brand Name</th>
                                <th>Brand Image</th>
                                <th>Created_at</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($brands as $key=>$brand)
                                <tr>
                                    <td>{{++$key}}</td>
                                    <td>{{$brand->brand_name}}</td>
                                    <td>
                                        <img src="{{asset($brand->brand_image)}}" style="height: 70px; width:150px;" alt="" srcset=""></td>
                                    <td>{{$brand->created_at->diffForHumans()}}</td>
                                    <td>
                                        <a href="" class="btn btn-primary">Edit</a>
                                        <a href="" class="btn btn-danger">Delete</a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>

                    </table>
                    {{-- {{ $categories->links() }} --}}
                </div>
                <div class="col-lg-4">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Add Brand</h3>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('brand.store') }}" method="post" enctype="multipart/form-data">
                                @csrf
                                <div class="form-group mb-3">
                                    <label for="">Brand Name</label>

                                    <input type="text" name="brand_name" class="form-control">
                                    @error('brand_name')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="">Brand Image</label>

                                    <input type="file" name="brand_image" class="form-control">
                                    @error('brand_image')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <input type="submit" value="Create" class="btn btn-primary form-control mt-4 bg-primary">
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>


    </div>
</x-app-layout>
