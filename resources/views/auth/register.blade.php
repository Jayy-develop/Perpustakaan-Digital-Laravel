<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Register</title>
    @vite('resources/css/app.css')
</head>
<body class="bg-gradient-to-br from-black via-gray-900 to-gray-800 min-h-screen flex items-center justify-center">

    <div class="w-full max-w-md p-8 rounded-2xl backdrop-blur-xl bg-white/5 border border-white/10 shadow-2xl">

        <!-- Title -->
        <div class="text-center mb-8">
            <h1 class="text-3xl font-semibold text-white tracking-wide">
                Create Account
            </h1>
            <p class="text-gray-400 text-sm mt-2">
                Exclusive access starts here
            </p>
        </div>

        <form method="POST" action="{{ route('register') }}">
            @csrf

            <!-- Name -->
            <div class="mb-4">
                <label class="text-gray-300 text-sm">Name</label>
                <input type="text" name="name" value="{{ old('name') }}" required
                    class="w-full mt-1 px-4 py-2 rounded-lg bg-white/10 text-white border border-white/10 focus:outline-none focus:ring-2 focus:ring-purple-500 placeholder-gray-400">
                @error('name')
                    <p class="text-red-400 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Email -->
            <div class="mb-4">
                <label class="text-gray-300 text-sm">Email</label>
                <input type="email" name="email" value="{{ old('email') }}" required
                    class="w-full mt-1 px-4 py-2 rounded-lg bg-white/10 text-white border border-white/10 focus:outline-none focus:ring-2 focus:ring-purple-500 placeholder-gray-400">
                @error('email')
                    <p class="text-red-400 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Password -->
            <div class="mb-4">
                <label class="text-gray-300 text-sm">Password</label>
                <input type="password" name="password" required
                    class="w-full mt-1 px-4 py-2 rounded-lg bg-white/10 text-white border border-white/10 focus:outline-none focus:ring-2 focus:ring-purple-500 placeholder-gray-400">
                @error('password')
                    <p class="text-red-400 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Confirm Password -->
            <div class="mb-6">
                <label class="text-gray-300 text-sm">Confirm Password</label>
                <input type="password" name="password_confirmation" required
                    class="w-full mt-1 px-4 py-2 rounded-lg bg-white/10 text-white border border-white/10 focus:outline-none focus:ring-2 focus:ring-purple-500 placeholder-gray-400">
            </div>

            <!-- Button -->
            <button type="submit"
                class="w-full py-2 rounded-lg bg-gradient-to-r from-purple-600 to-indigo-600 text-white font-medium hover:scale-[1.02] transition-all duration-300 shadow-lg shadow-purple-500/20">
                Register
            </button>

            <!-- Login -->
            <p class="text-center text-gray-400 text-sm mt-6">
                Already have an account?
                <a href="{{ route('login') }}" class="text-purple-400 hover:underline">
                    Login
                </a>
            </p>

        </form>
    </div>

</body>
</html>