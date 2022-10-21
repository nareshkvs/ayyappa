<div class="px-4 sm:px-6 lg:px-8">
    <div class="sm:flex sm:items-center">
      <div class="sm:flex-auto">
        <h1 class="text-xl font-semibold text-gray-900">Temples</h1>
      </div>
      <div class="mt-4 sm:mt-0 sm:ml-16 sm:flex-none">
        <button type="button" wire:click="create()" class="inline-flex items-center justify-center px-4 py-2 text-sm font-medium text-white bg-indigo-600 border border-transparent rounded-md shadow-sm hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 sm:w-auto">Add temple</button>
      </div>
    </div>
    @if ($isOpen)
        @include('livewire.temples.create');
    @endif
    @if ($isOpen && $isTimings)
        @include('livewire.temples.timings');
    @endif
    <div class="flex flex-col mt-8">
      <div class="-mx-4 -my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
        <div class="inline-block min-w-full py-2 align-middle md:px-6 lg:px-8">
          <div class="overflow-hidden shadow ring-1 ring-black ring-opacity-5 md:rounded-lg">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th scope="col" width="50" class="px-6 py-3 text-xs font-medium tracking-wide text-left text-gray-500 uppercase bg-blue-200">
                                ID
                            </th>
                            <th scope="col" class="px-6 py-3 text-xs font-medium tracking-wide text-left text-gray-500 uppercase bg-blue-200">
                                Name
                            </th>
                            <th scope="col" class="px-6 py-3 text-xs font-medium tracking-wide text-left text-gray-500 uppercase bg-blue-200">
                                Address
                            </th>
                            <th scope="col" class="px-6 py-3 text-xs font-medium tracking-wide text-left text-gray-500 uppercase bg-blue-200">
                                City
                            </th>
                            <th scope="col" class="px-6 py-3 text-xs font-medium tracking-wide text-left text-gray-500 uppercase bg-blue-200">
                                State
                            </th>
                            <th scope="col" class="px-6 py-3 text-xs font-medium tracking-wide text-left text-gray-500 uppercase bg-blue-200">
                                Zipcode
                            </th>
                            <th scope="col" class="px-6 py-3 text-xs font-medium tracking-wide text-left text-gray-500 uppercase bg-blue-200">
                                status
                            </th>
                            <th scope="col" width="200" class="px-6 py-3 bg-blue-200">

                            </th>
                        </tr>
                    </thead>

                    <tbody class="bg-white divide-y divide-gray-200">
                        @foreach($temples as $temple)
                        <tr>
                            <td class="px-6 py-4 text-sm text-gray-900 whitespace-nowrap">{{ $sequence++ }}</td>
                            <td class="px-6 py-4 text-sm text-gray-900 whitespace-nowrap">{{ $temple->name }}</td>
                            <td class="px-6 py-4 text-sm text-gray-900 whitespace-nowrap">{{ $temple->address }}</td>
                            <td class="px-6 py-4 text-sm text-gray-900 whitespace-nowrap">{{ $temple->city }}</td>
                            <td class="px-6 py-4 text-sm text-gray-900 whitespace-nowrap">{{ $temple->state }}</td>
                            <td class="px-6 py-4 text-sm text-gray-900 whitespace-nowrap">{{ $temple->zipcode }}</td>
                            <td class="px-6 py-4 text-sm text-gray-900 whitespace-nowrap">{{ $temple->status }}</td>
                            <td class="px-6 py-4 text-sm font-medium whitespace-nowrap">
                                <button wire:click="edit({{ $temple->id }})" class="mb-2 mr-2 font-medium text-blue-600 hover:text-blue-900 focus:outline-none"><img src="/img/edit.png" title="Edit" class="w-4" /></button>
                                <button wire:click="viewTempleTimings({{ $temple->id }})" class="mb-2 mr-2 font-medium text-blue-600 hover:text-blue-900 focus:outline-none"><img src="/img/timings.png" title="Timings" class="w-4" /></button>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
          </div>
     </div>
    </div>
   </div>
</div>
