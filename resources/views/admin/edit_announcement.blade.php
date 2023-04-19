@extends('components.layout')
@section('title')
    Edit Announcements
@endsection

@section('main')
    <main>
        <div class="pt-6 px-4">
            <div class="flex justify-between items-center">
                <h1 class="font-bold text-2xl ">Edit Announcement</h1>
            </div>
            <div class="mt-3">
                <form action="" method="POST" autocomplete="off">
                    @csrf
                    <div class="form-control w-full">
                        <label class="label">
                            <span class="label-text">Title</span>
                        </label>
                        <input type="text" value="{{ $announcement->title }}" name="title" placeholder="Type here"
                            class="input input-bordered w-full" />
                    </div>
                    <div class="form-control w-full">
                        <label class="label">
                            <span class="label-text">Link</span>
                        </label>
                        <input type="text" name="link" value="{{ $announcement->link }}" placeholder="Type here"
                            class="input input-bordered w-full" />
                    </div>
                    <button
                        class="mt-3 btn bg-cyan-600 hover:bg-cyan-700 focus:ring-4 focus:ring-cyan-200 border-0">Save</button>
                </form>

            </div>
    </main>
@endsection
