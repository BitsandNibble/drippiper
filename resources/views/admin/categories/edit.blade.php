<x-admin-layout>
    <x-slot name="header">
        <div class="items-center gap-x-3">
            <button onclick="history.back(-1)">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor"
                    class="w-5 h-5">
                    <path fill-rule="evenodd"
                        d="M7.793 2.232a.75.75 0 01-.025 1.06L3.622 7.25h10.003a5.375 5.375 0 010 10.75H10.75a.75.75 0 010-1.5h2.875a3.875 3.875 0 000-7.75H3.622l4.146 3.957a.75.75 0 01-1.036 1.085l-5.5-5.25a.75.75 0 010-1.085l5.5-5.25a.75.75 0 011.06.025z"
                        clip-rule="evenodd" />
                </svg>
            </button>

            {{ __('Edit Category') }}
        </div>
    </x-slot>

    <form action="{{ route('admin.categories.update', $category) }}" method="POST"
        enctype="multipart/form-data">
        @csrf
        @method('PUT')

        @include('admin.categories.form', ['buttonName' => 'Save'])
    </form>

</x-admin-layout>