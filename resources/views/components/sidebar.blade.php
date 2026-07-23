
<aside class="fixed left-0 top-0 w-64 h-screen bg-white border-r border-gray-200 flex flex-col justify-between z-50">

    <div>

        <!-- Logo -->

        <div class="h-20 px-8 flex items-center border-b">

            <h1 class="text-2xl font-bold">

                <span class="text-indigo-600">Logi</span>Track

            </h1>

        </div>

        <!-- Menu -->

        <div class="px-5 py-6">

            <p class="text-xs uppercase text-gray-400 font-semibold mb-4">
                MAIN MENU
            </p>

            <ul class="space-y-2">

                <li>

                    <a href="{{ route('dashboard') }}"
                       class="flex items-center justify-between px-4 py-3 rounded-xl font-medium
                       {{ request()->routeIs('dashboard')
                        ? 'bg-indigo-50 text-indigo-600'
                        : 'text-gray-600 hover:bg-gray-100' }}">

                        <div class="flex items-center gap-3">

                            <svg xmlns="http://www.w3.org/2000/svg"
                                 class="w-5 h-5"
                                 fill="none"
                                 viewBox="0 0 24 24"
                                 stroke="currentColor">

                                <path stroke-linecap="round"
                                      stroke-linejoin="round"
                                      stroke-width="2"
                                      d="M3 12l9-9 9 9M4.5 10.5V20a1 1 0 001 1h5.5v-6h2v6H18.5a1 1 0 001-1v-9.5"/>

                            </svg>

                            Dashboard

                        </div>

                    </a>

                    <a href="{{ route('cargo-requests') }}"
                       class="flex items-center justify-between px-4 py-3 rounded-xl font-medium
                        {{ request()->routeIs('cargo-requests')
                        ? 'bg-indigo-50 text-indigo-600'
                        : 'text-gray-600 hover:bg-gray-100' }}">

                        <div class="flex items-center gap-3">

                            <svg xmlns="http://www.w3.org/2000/svg"
                                 class="w-5 h-5"
                                 fill="none"
                                 viewBox="0 0 24 24"
                                 stroke="currentColor">

                                <path stroke-linecap="round"
                                      stroke-linejoin="round"
                                      stroke-width="2"
                                      d="M20 13V7a2 2 0 00-2-2H6a2 2 0 00-2 2v10a2 2 0 002 2h6"/>

                            </svg>

                            Cargo Requests

                        </div>


                    </a>

                </li>

            </ul>


        </div>

    </div>

    <!-- User -->

    <div class="border-t p-5">

        <div class="flex items-center gap-3">

            <div
                class="w-11 h-11 rounded-full bg-indigo-600 text-white flex items-center justify-center font-semibold user-avatar">


            </div>

            <div>

                <h4 class="font-semibold text-sm user-name">
                    Alex Rivera
                </h4>

                <p class="text-xs text-gray-400 user-email">
                    alex.rivera@example.com
                </p>

            </div>

        </div>

    </div>

</aside>

