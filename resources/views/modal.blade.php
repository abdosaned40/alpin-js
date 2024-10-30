@extends('layouts.app')

@section('content')
<div class="container mx-auto p-8" x-data="{ open: false }">
    <!-- Trigger Button -->
    <button @click="open = true" class="bg-blue-500 text-white px-4 py-2 rounded">Open Modal</button>

    <!-- Modal -->
    <div x-show="open" class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50 z-50" x-cloak>
        <div class="bg-white p-6 rounded-lg shadow-lg w-1/3">
            <h2 class="text-lg font-bold mb-4">Good</h2>
            <div x-data="{ message: '' }">
                <input type="text" x-model="message" style="border: 1px solid red">
                <br>

                <span x-text="message"></span>
            </div>            <div class="flex justify-end">
                <button @click="open = false" class="bg-gray-500 text-white px-4 py-2 rounded">Close</button>
            </div>

        </div>

    </div>

</div>


@endsection
