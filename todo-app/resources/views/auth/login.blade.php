<div class="bg-white p-8 rounded-lg shadow-md w-96">
    <h2 class="text-2xl font-bold mb-6 text-center text-gray-800">Sign In</h2>
    
    @if($errors->any())
        <div class="bg-red-100 text-red-600 p-2 rounded mb-4 text-sm">
            {{ $errors->first() }}
        </div>
    @endif

    <form action="{{ url('/login') }}" method="POST">
        @csrf
        <div class="mb-4">
            <label class="block text-gray-700 text-sm mb-2">Email Address</label>
            <input type="email" name="email" value="{{ old('email') }}" class="w-full p-2 border border-gray-300 rounded" required>
        </div>
        <div class="mb-6">
            <label class="block text-gray-700 text-sm mb-2">Password</label>
            <input type="password" name="password" class="w-full p-2 border border-gray-300 rounded" required>
        </div>
        <button type="submit" class="w-full bg-blue-600 text-white p-2 rounded hover:bg-blue-700">Login</button>
    </form>
</div>