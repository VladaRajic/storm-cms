<div>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Users') }}
        </h2>
    </x-slot>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="flex bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="w-1/2 p-6 text-gray-900 dark:text-gray-100 ">
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif
                    <form wire:submit="save" class="max-w-sm mb-10">
                        <div class="md-12 mb-5">
                            <label for="countries_multiple" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Select Category</label>
                            <select wire:model="form.productCategories" multiple class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                @foreach($form->categories as $category)
                                    <option value="{{$category->id}}">{{$category->name}}</option>
                                @endforeach
                            </select>
                            @error('form.productCategories') <span class="text-red-600">{{$message}}</span> @enderror
                        </div>

                        <div class="mb-5">
                            <input wire:model="form.name" type="text" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Product name"/>
                            @error('form.name') <span class="text-red-600">{{$message}}</span> @enderror
                        </div>
                        <div class="mb-5">
                            <input wire:model="form.price" type="text" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Price"/>
                            @error('form.price') <span class="text-red-600">{{$message}}</span> @enderror
                        </div>
                        <div class="mb-5">
                            <textarea wire:model="form.description"  type="text" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Description">

                            </textarea>
                            @error('form.description') <span class="text-red-600">{{$message}}</span> @enderror
                        </div>
                        @role('admin')
                        <div class="mb-5">


                            <div
                                x-data="{ uploading: false, progress: 0 }"
                                x-on:livewire-upload-start="uploading = true"
                                x-on:livewire-upload-finish="uploading = false"
                                x-on:livewire-upload-cancel="uploading = false"
                                x-on:livewire-upload-error="uploading = false"
                                x-on:livewire-upload-progress="progress = $event.detail.progress"
                            >
                                <!-- File Input -->
                                <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white" for="multiple_files">Upload multiple images</label>
                                <input wire:model="form.images" class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400" type="file" multiple>

                                <!-- Progress Bar -->
                                <div x-show="uploading">
                                    <progress max="100" x-bind:value="progress"></progress>
                                </div>

                                @foreach($form->images as $image)

                                    <img class="h-auto max-w-xs mb-5" src="{{ $image instanceof Livewire\Features\SupportFileUploads\TemporaryUploadedFile ? asset($image->temporaryUrl()) : $image->getImgUrl()}}" alt="image description">
                                    <div class="flex items-center mb-4">
                                        <input wire:model="form.mainImage" type="radio" value="{{ $image instanceof Livewire\Features\SupportFileUploads\TemporaryUploadedFile ? $image->getFilename() : $image->path }}"  class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                                        <label for="default-radio-1" class="ms-2 text-sm font-medium text-gray-900 dark:text-gray-300">Choose Main Image</label>
                                    </div>

                                @endforeach
                            </div>
                        </div>

                        @error('form.images') <span class="error">{{ $message }}</span> @enderror
                        @endrole
                        <div class="flex items-center gap-4">
                            @role('admin')
                            <button type="submit" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">

                                    @if(!$isEdit)
                                        Create Product
                                    @else
                                        Update Product
                                    @endif


                            </button>
                            @endrole
                            <x-action-message class="me-3" on="category-created">
                                {{ __('Saved.') }}
                            </x-action-message>
                        </div>
                    </form>
                </div>
                @if($isEdit)
                    <div class="w-1/2 p-6 text-gray-900 dark:text-gray-100 ">
                        <h1>Comments:</h1>
                        @foreach($form->product->comments as $comment)
                                <p class="mb-3 text-gray-500 dark:text-gray-400">{{$comment->comment}}</p>
                                <a href="#" wire:click.prevent="deleteComment({{$comment->id}})" class="font-medium text-blue-600 dark:text-blue-500 hover:underline">Delete</a>
                                <hr class="w-auto h-1 mx-auto my-4 bg-gray-100 border-0 rounded-sm md:my-10 dark:bg-gray-700">

                        @endforeach
                    </div>

                @endif
            </div>
        </div>

    </div>
    <div>

    </div>
</div>
