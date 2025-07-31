<x-guest-layout>
    <div class="card p-3">
        <form method="POST" action="{{ route('register') }}">
            @csrf


            <div class="flex items-center justify-end mt-4">
                <a class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800" href="{{ route('login') }}">
                    {{ __('Already registered?') }}
                </a>

                <button>Register</button>
            </div>
        </form>
    </div>
</x-guest-layout>
