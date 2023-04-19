@extends('components.layout')
@section('head')
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@10"></script>
@endsection
@section('title')
    Posts
@endsection

@section('main')
    <main>
        <div class="pt-6 px-4">
            <div class="flex justify-between items-center">
                <h1 class="font-bold text-2xl ">Posts Manager</h1>
                <a href="{{ route('new_post') }}"
                    class="btn btn-sm bg-cyan-600 hover:bg-cyan-700 focus:ring-4 focus:ring-cyan-200 border-0">+ New
                    Posts</a>
            </div>
            <div class="mt-3">
                <div class="overflow-x-auto">
                    <table class="table w-full">
                        <!-- head -->
                        <thead>
                            <tr>
                                <th></th>
                                <th>Title</th>
                                <th>Created At</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($posts as $i => $post)
                                <tr>
                                    <th>{{ $i + 1 }}</th>
                                    <td>{{ $post->title }}</td>
                                    <td>{{ $post->created_at }}</td>
                                    <td>
                                        <button onclick="delete_post('{{ $post->slug }}')"
                                            class="btn btn-sm bg-red-400 border-0 hover:bg-red-600">
                                            Delete
                                        </button>
                                        <a href="{{ route('edit_post', ['slug' => $post->slug]) }}"
                                            class="btn btn-sm bg-green-400 border-0 hover:bg-green-600">
                                            Edit
                                            </button>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

        </div>
    </main>
    <script>
        function delete_post(slug) {
            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = `/dashboard/posts/${slug}/delete`
                }
            })
        }
    </script>
@endsection
