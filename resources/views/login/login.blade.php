<!DOCTYPE html>
<html lang="en">

<head>
    @include('components.head')
    <title>HIMAPTIKA ADMIN PAGE</title>
</head>

<body class="bg-slate-50">
    <section class="h-screen flex justify-center items-center">
        <div class="rounded-md border-[1px] border-gray-200 py-4 p-4 lg:w-[400px] w-full bg-white mx-3 shadow-md">
            <img class="w-[100px] mx-auto my-5" src="{{ asset('assets/Himaptika.png') }}" alt="Logo">
            <h1 class="font-bold text-2xl text-center">ADMIN LOGIN</h1>
            @if ($errors->any)
                @foreach ($errors->all() as $error)
                    <div class="alert alert-error mt-3">
                        <div>
                            <svg xmlns="http://www.w3.org/2000/svg" class="stroke-current flex-shrink-0 h-6 w-6"
                                fill="none" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                            <span>{{ $error }}</span>
                        </div>
                    </div>
                @endforeach
            @endif
            <form class="my-4" action="" method="POST" autocomplete="off">
                @csrf
                <div class="form-control w-full">
                    <label class="label">
                        <span class="label-text">Username</span>
                    </label>
                    <input type="text" placeholder="Type here" name="username" class="input input-bordered w-full" />
                </div>
                <div class="form-control w-full">
                    <label class="label">
                        <span class="label-text">Password</span>
                    </label>
                    <input type="password" name="password" placeholder="Type here"
                        class="input input-bordered w-full" />
                </div>
                <div class="form-control">
                    <label class="label cursor-pointer">
                        <span class="label-text">Remember me</span>
                        <input type="checkbox" name="remember" checked="checked" class="checkbox" />
                    </label>
                </div>
                <button class="btn w-full mt-3">Login</button>
            </form>
            <h1 class="text-slate-400 text-center">Maintenance by Creative Media Department</h1>
            <h1 class="text-slate-400 text-center">@Copyright {{ date('Y') }} HIMAPTIKA FKIP ULM</h1>
        </div>
    </section>
</body>

</html>
