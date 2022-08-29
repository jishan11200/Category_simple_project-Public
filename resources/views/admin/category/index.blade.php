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
                        <thead>
                            <tr>
                                <th>SL</th>
                                <th>Category Name</th>
                                <th>User ID</th>
                                <th>Created_at</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($categories as $key=>$category)
                            <tr>
                                <td>{{++$key}}</td>
                                <td>{{$category->category_name}}</td>
                                <td>{{$category->user_id}}</td>
                                <td>{{$category->created_at->diffForHumans()}}</td>
                            </tr>
                            @endforeach

                        </tbody>

                    </table>
                </div>
                <div class="col-lg-4">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Add Category</h3>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('category.store') }}" method="post">
                                @csrf
                                <div class="form-group">
                                    <label for="">Category Name</label>

                                    <input type="text" name="category_name" class="form-control">
                                    @error('category_name')
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
