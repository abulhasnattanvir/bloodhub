<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Blood Groups') }}
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @if($bloodGroups->isEmpty())
                <div class="text-center py-12">
                    <p class="text-gray-500">{{ __('No blood groups found.') }}</p>
                    <a href="{{ route('admin.blood-groups.create') }}" 
                       class="inline-flex items-center px-4 py-2 mt-4 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-primary hover:bg-primary-dark focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary-dark">
                        {{ __('Add Blood Group') }}
                    </a>
                </div>
            @else
                <!-- Search and Filter Form -->
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-6">
                    <div class="p-6">
                        <form method="GET" action="{{ route('admin.blood-groups.index') }}" class="space-y-4">
                            <div class="sm:grid sm:grid-cols-3 gap-4">
                                <div>
                                    <label for="search" class="block text-sm font-medium text-gray-700 mb-1">
                                        {{ __('Search by name') }}
                                    </label>
                                    <input type="text" id="search" name="search" 
                                           value="{{ old('search', request('search')) }}" 
                                           class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-primary focus:ring-primary focus:ring-opacity-50 sm:text-sm">
                                </div>
                                <div class="col-span-2 sm:col-span-1">
                                    <button type="submit" 
                                            class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                                        {{ __('Search') }}
                                    </button>
                                </div>
                            </div>
                            
                            @if(request('search'))
                                <div class="mt-2 flex justify-between">
                                    <p class="text-sm text-gray-500">
                                        Found {{ $bloodGroups->total() }} {{ __('result') }}
                                    </p>
                                    <a href="{{ route('admin.blood-groups.index') }}" 
                                       class="text-sm font-medium text-indigo-600 hover:text-indigo-500">
                                        {{ __('Reset') }}
                                    </a>
                                </div>
                            @endif
                        </form>
                    </div>
                </div>

                <!-- Blood Groups Table -->
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        {{ __('Name') }}
                                    </th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        {{ __('Description') }}
                                    </th>
                                    <th scope="col" class="relative px-6 py-3">
                                        <span class="sr-only">{{ __('Actions') }}</span>
                                    </th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @foreach($bloodGroups as $bloodGroup)
                                    <tr>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                            {{ $bloodGroup->name }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                            {{ $bloodGroup->description ?? __('No description') }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                            <div class="flex space-x-2">
                                                <!-- Edit Button -->
                                                <a href="{{ route('admin.blood-groups.edit', $bloodGroup->id) }}" 
                                                   class="inline-flex items-center px-3 py-1 border border-transparent text-sm font-medium rounded-md shadow-sm text-primary-600 hover:bg-primary-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary-500">
                                                    <i class="fas fa-edit"></i>
                                                </a>
                                                
                                                <!-- Delete Button -->
                                                <form action="{{ route('admin.blood-groups.destroy', $bloodGroup->id) }}" 
                                                      method="POST" 
                                                      class="inline-block"
                                                      onsubmit="return confirm('{{ __('Are you sure you want to delete this blood group?') }}');">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" 
                                                            class="inline-flex items-center px-3 py-1 border border-transparent text-sm font-medium rounded-md shadow-sm text-red-600 hover:bg-red-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500">
                                                        <i class="fas fa-trash"></i>
                                                    </button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                
                <!-- Pagination -->
                @if($bloodGroups->total() > 10)
                    <div class="mt-6 flex items-center justify-between px-6">
                        <p class="text-sm text-gray-500">
                            Showing {{ $bloodGroups->firstItem() }} to {{ $bloodGroups->lastItem() }} 
                            of {{ $bloodGroups->total() }} {{ __('results') }}
                        </p>
                        
                        {{ $bloodGroups->links() }}
                    </div>
                @endif
            @endif
        </div>
    </div>
</x-app-layout>