<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{-- {{ __('Dashboard') }} --}}
            Hi......{{Auth::user()->name}}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="container mt-3">
            <div class="row justify-content-center">

                <div class="col-lg-8">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Edit Category</h3>
                        </div>
                        <div class="card-body">
                            <form action="{{Route('category.update',$category->id)}}" method="post">
                                @csrf
                                {{-- @method('PUT') --}}
                                <div class="form-group">
                                    <label for="">Category Name</label>

                                    <input type="text" name="category_name" class="form-control" value="{{ $category->category_name }}">
                                    @error('category_name')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <input type="submit" value="Update" class="btn btn-primary form-control mt-4 bg-primary">
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
