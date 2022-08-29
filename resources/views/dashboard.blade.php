<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{-- {{ __('Dashboard') }} --}}
            Hi......{{Auth::user()->name}}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="container mt-3">
            <table class="table table-borderd table-responsive">
                <thead>
                    <tr>
                        <th>SL</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Created_at</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($users as $key=>$user)
                    <tr>
                        <td>{{++$key}}</td>
                        <td>{{$user->name}}</td>
                        <td>{{$user->email}}</td>
                        {{-- <td>{{$user->created_at->diffForHumans() }}</td> --}}
                        <td>{{Carbon\Carbon::parse($user->created_at)->diffForHumans()}}</td>
                    </tr>
                    @endforeach

                </tbody>
            </table>
        </div>
    </div>
</x-app-layout>
