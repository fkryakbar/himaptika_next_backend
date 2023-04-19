@extends('components.layout')
@section('head')
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@10"></script>
@endsection
@section('title')
    Comments
@endsection

@section('main')
    <main>
        <div class="pt-6 px-4">
            <div class="flex justify-between items-center">
                <h1 class="font-bold text-2xl ">Comments Manager</h1>
            </div>
            <div class="mt-3">
                <div class="overflow-x-auto">
                    <table class="table w-full">
                        <!-- head -->
                        <thead>
                            <tr>
                                <th></th>
                                <th>Name</th>
                                <th>Comment</th>
                                <th>At POST</th>
                                <th>Created At</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($comments as $i => $comment)
                                <tr>
                                    <th>{{ $i + 1 }}</th>
                                    <td>{{ $comment->name }}</td>
                                    <td>{{ $comment->comment }}</td>
                                    <td>{{ $comment->post_slug }}</td>
                                    <td>{{ $comment->created_at }}</td>
                                    <td>
                                        <button onclick="delete_comment({{ $comment->id }})"
                                            class="btn btn-sm bg-red-400 border-0 hover:bg-red-600">
                                            Delete
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
        function delete_comment(id) {
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
                    window.location.href = `/dashboard/comments/${id}/delete`
                }
            })
        }
    </script>
@endsection
