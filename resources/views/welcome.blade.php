<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    @vite('resources/css/app.css')
</head>
<body class="bg-gray-900 min-h-screen">
    <!-- Main Content -->
    <div class="flex-1 flex flex-col items-center justify-center py-12 px-4">
        <div class="max-w-6xl w-full">
            <div class="flex flex-col md:flex-row gap-16 items-center">
                <!-- Logo Side - Left -->
                <div class="md:w-1/2 flex flex-col items-center md:items-start space-y-0">
                    <div class="w-64 h-64 mb-1">
                        <img src="https://t4.ftcdn.net/jpg/05/26/35/07/360_F_526350772_taMM7EVaoDzWAashADdBrYkjH24hqS3c.jpg" alt="Bootleg Logo" 
                            class="w-full h-full object-contain transform hover:scale-105 transition-transform duration-300">
                    </div>
                </div>

                <!-- Login Form Side - Right -->
                <div class="md:w-1/2">
                    <div class="bg-gray-700 p-8 rounded-xl border border-gray-600 shadow-xl max-w-md mx-auto">
                        <h2 class="text-2xl font-semibold text-gray-100 mb-6">Login to Your NGO Account</h2>
                        <form action="/login" method="POST" class="space-y-6">
                            @csrf
                            <div class="space-y-2">
                                <label for="email" class="text-sm font-medium text-gray-300">Email</label>
                                <input type="text" id="email" name="email" placeholder="Enter your Email" 
                                    class="w-full px-4 py-3 bg-gray-800 border border-gray-600 rounded-lg text-gray-100 placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent" />
                                    
                                    @error('email')
                                        <p class="m-0 small alert alert-danger shadow-sm">{{$message}}</p>
                                    @enderror
                                </div>
                            <div class="space-y-2">
                                <label for="password" class="text-sm font-medium text-gray-300">Password</label>
                                <input type="password" id="password" name="password" placeholder="Enter your password" 
                                    class="w-full px-4 py-3 bg-gray-800 border border-gray-600 rounded-lg text-gray-100 placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent" />
                            
                                    @error('password')
                                        <p class="m-0 small alert alert-danger shadow-sm">{{$message}}</p>
                                    @enderror
                            </div>
                            <button type="submit" 
                                class="w-full bg-blue-600 text-gray-100 py-3 rounded-lg font-medium hover:bg-blue-700 transition duration-300 ease-in-out">
                                Sign In
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <footer class="text-center mt-8 text-gray-400 text-sm">
        Brandname copyright&copy; 2025
    </footer>
</body>
</html>