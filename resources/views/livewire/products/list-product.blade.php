<div>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Users') }}
        </h2>
    </x-slot>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100 ">
                    @role('admin')
                    <x-nav-link href="{{route('create-product')}}">Create Product</x-nav-link>
                    @endrole
                    <br />
                    <br />
                    <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                        <tr>
                            <th class="px-6 py-3">ID</th>
                            <th class="px-6 py-3">Product Name</th>
                            <th class="px-6 py-3">Description</th>
                            <th class="px-6 py-3">Price</th>
                            <th class="px-6 py-3">Action</th>
                        </tr>
                        </thead>
                        <tbody class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 border-gray-200">
                        @foreach ($products as $product)
                            <tr>
                                <td class="px-6 py-4">{{$product->id}}</td>
                                <td class="px-6 py-4">{{$product->name}}</td>
                                <td class="px-6 py-4">{{$product->description}}</td>
                                <td class="px-6 py-4">{{$product->price}}</td>
                                <td class="px-6 py-4">
                                    <x-nav-link href="{{route('update-product', $product->id)}}">Edit</x-nav-link>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <div>

    </div>
</div>
