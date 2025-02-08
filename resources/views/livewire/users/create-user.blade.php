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
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif
                    <form wire:submit="save" class="max-w-sm mb-10">
                        <div class="mb-5">

                            @foreach ($form->roles as $role)
                            <div class="flex items-center mb-4">
                                <input wire:model="form.userRoles" id="default-checkbox" type="checkbox" value="{{$role->id}}"  class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded-sm focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                                <label for="default-checkbox" class="ms-2 text-sm font-medium text-gray-900 dark:text-gray-300">{{$role->name}}</label>
                            </div>
                            @endforeach

                            @error('form.userRoles') <span class="text-red-600">{{$message}}</span> @enderror
                        </div>
                        <div class="mb-5">
                            <input wire:model="form.name" name="categoryName" type="text" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="First and Last name"/>
                            @error('form.name') <span class="text-red-600">{{$message}}</span> @enderror
                        </div>
                        <div class="mb-5">
                            <input wire:model="form.email" name="categoryName" type="text" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Email"/>
                            @error('form.email') <span class="text-red-600">{{$message}}</span> @enderror
                        </div>
                        @if(!$isEdit)
                            <div class="mb-5">
                                <input wire:model="form.password" name="categoryName" type="text" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Password"/>
                                @error('form.password') <span class="text-red-600">{{$message}}</span> @enderror
                            </div>
                        @endif

                        <div class="flex items-center gap-4">
                            <button type="submit" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                                @if(!$isEdit)
                                    Create User
                                @else
                                    Update User
                                @endif
                            </button>
                            <x-action-message class="me-3" on="category-created">
                                {{ __('Saved.') }}
                            </x-action-message>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
    <div>

    </div>
</div>
