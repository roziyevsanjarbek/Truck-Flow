<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Truck Flow Login</title>

    <script src="https://cdn.tailwindcss.com"></script>

    <link rel="stylesheet"
          href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css"/>
</head>
<body class="bg-gray-100">

<div class="min-h-screen flex">

    <!-- Left Side -->
    <div class="hidden lg:flex w-1/2 relative overflow-hidden bg-gradient-to-br from-[#17194B] via-[#090B24] to-[#1A0F2E]">

        <!-- Blur -->
        <div class="absolute -bottom-32 -left-20 w-96 h-96 bg-cyan-500/20 rounded-full blur-3xl"></div>
        <div class="absolute -bottom-20 right-10 w-80 h-80 bg-pink-500/20 rounded-full blur-3xl"></div>

        <div class="relative z-10 flex flex-col justify-between w-full p-14">

            <!-- Logo -->
            <div>
                <div class="flex items-center gap-3">
                    <div class="w-12 h-12 rounded-xl bg-white flex items-center justify-center">
                        <i class="fa-regular fa-cube text-xl text-gray-900"></i>
                    </div>

                    <h2 class="text-white text-3xl font-bold">
                        Truck Flow
                    </h2>
                </div>

                <div class="mt-24">
                    <h1 class="text-6xl font-bold text-white leading-tight">
                        Welcome to Truck Flow
                    </h1>

                    <p class="mt-8 text-xl leading-10 text-gray-300 max-w-xl">
                        The all-in-one workspace for modern engineering
                        teams. Design, build, and deploy at the speed of
                        thought.
                    </p>
                </div>
            </div>

            <!-- Testimonial -->
            <div class="rounded-3xl border border-white/10 bg-white/5 backdrop-blur-md p-8">

                <p class="text-gray-300 leading-8">
                    "Truck Flow has completely transformed how our team
                    manages complex deployments. It's the standard
                    for our engineering org."
                </p>


            </div>

        </div>

    </div>

    <!-- Right Side -->
    <div class="flex-1 bg-white flex items-center justify-center">

        <div class="w-full max-w-md px-8">

            <h2 class="text-5xl font-bold text-gray-900">
                Welcome Back
            </h2>

            <p class="mt-3 text-lg text-gray-500">
                Sign in to continue to your account
            </p>

            <form class="mt-10 space-y-6">

                <!-- Email -->
                <div>

                    <label class="block font-semibold text-gray-700 mb-2">
                        Email Address
                    </label>

                    <div class="relative">

                        <i class="fa-regular fa-envelope absolute left-4 top-1/2 -translate-y-1/2 text-gray-400"></i>

                        <input
                            id="email"
                            type="email"
                            placeholder="name@company.com"
                            class="w-full rounded-xl border border-gray-200 pl-12 pr-4 py-4 outline-none focus:ring-2 focus:ring-indigo-500"/>
                        <p id="emailError" class="mt-2 text-sm text-red-500 hidden"></p>
                    </div>

                </div>

                <!-- Password -->
                <div>

                    <div class="flex justify-between mb-2">

                        <label class="font-semibold text-gray-700">
                            Password
                        </label>


                    </div>

                    <div class="relative">

                        <i class="fa-solid fa-lock absolute left-4 top-1/2 -translate-y-1/2 text-gray-400"></i>

                        <input
                            id="password"
                            type="password"
                            placeholder="••••••••"
                            class="w-full rounded-xl border border-gray-200 pl-12 pr-12 py-4 outline-none focus:ring-2 focus:ring-indigo-500"/>
                        <p id="passwordError" class="mt-2 text-sm text-red-500 hidden"></p>
                        <button
                            type="button"
                            class="absolute right-4 top-1/2 -translate-y-1/2 text-gray-400">

                            <i class="fa-regular fa-eye"></i>

                        </button>

                    </div>

                </div>



                <!-- Button -->
                <button
                    id="loginBtn"
                    type="button"
                    class="w-full rounded-xl bg-[#04091E] py-4 text-lg text-white font-semibold hover:bg-[#0b1233] duration-300">

                    Sign In

                </button>

                <!-- Divider -->
                <div class="flex items-center">

                    <div class="flex-1 border-t"></div>


                    <div class="flex-1 border-t"></div>

                </div>

            </form>

            <div class="flex justify-center gap-10 mt-14 text-sm text-gray-400">

                <a href="#">Terms of Service</a>

                <a href="#">Privacy Policy</a>

            </div>

        </div>

    </div>

</div>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>

    const emailError = document.getElementById('emailError');
    const passwordError = document.getElementById('passwordError');

    document.getElementById('loginBtn').addEventListener('click', async function () {

        const email = document.getElementById('email').value;
        const password = document.getElementById('password').value;

        try {

            emailError.classList.add('hidden');
            passwordError.classList.add('hidden');

            let hasError = false;

            if (email.trim() === '') {
                emailError.innerText = 'Email is required';
                emailError.classList.remove('hidden');
                hasError = true;
            }

            if (password.trim() === '') {
                passwordError.innerText = 'Password is required';
                passwordError.classList.remove('hidden');
                hasError = true;
            }

            if (hasError) return;

            const response = await fetch('/api/login', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'Accept': 'application/json',
                },
                body: JSON.stringify({
                    email: email,
                    password: password
                })
            });

            const result = await response.json();

            if (response.ok) {

                localStorage.setItem('token', result.token);
                localStorage.setItem('user', JSON.stringify(result.data));

                window.location.href = '/dashboard';

            } else {

                Swal.fire({
                    icon: 'error',
                    title: 'Login Failed',
                    text: result.message
                });

            }

        } catch (error) {

            console.error(error);
            Swal.fire({
                icon: 'error',
                title: 'Server Error',
                text: 'An error occurred while processing your request.'
            });

        }

    });

    document.getElementById('email').addEventListener('input', () => {
        emailError.classList.add('hidden');
    });

    document.getElementById('password').addEventListener('input', () => {
        passwordError.classList.add('hidden');
    });

</script>
</body>
</html>
