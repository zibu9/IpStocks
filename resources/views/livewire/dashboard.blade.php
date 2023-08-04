<div x-data="{ open : true }" class="py-12">
    <div class="mx-auto sm:px-6 lg:px-8">
        <div class="block mb-2">
            <a href="{{route('product.manage')}}" class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded">Add new</a>
        </div>
        <br>
        <div class="pt-2 relative mx-auto text-gray-600">
                <select wire:model="searchBy" class="border-2 border-gray-300 bg-white h-10 px-5 pr-16 w-96 rounded-lg text-sm focus:outline-none">
                    <option selected value="">Refid</option>
                    <option value="Modele">Modele</option>
                    <option value="Type">Type</option>
                </select>
            <input @click.away="{ open = false }" @click="{ open = true; @this.resetIndex() }"
            class="border-2 border-gray-300 bg-white h-10 px-5 pr-16 w-96 rounded-lg text-sm focus:outline-none"
            type="search"
            placeholder="Search"
            wire:model="query"
            >
        </div>
        <br>

        <!-- This example requires Tailwind CSS v2.0+ -->
        <div class="flex flex-col">
            <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
                    <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        REF ID
                                    </th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        MODELE
                                    </th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        TYPE
                                    </th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        ENTREE
                                    </th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        SORTIE
                                    </th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        STOCKS
                                    </th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @php
                                $i=0
                                @endphp
                                @if (count($products)>0)
                                    @foreach ($products as $product)
                                    <tr onclick="document.location = '{{ route('product.show', $product->refId)}}'">
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                            {{ $product->refId }}
                                        </td>

                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                            {{ $product->modele }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                            {{ $product->type }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                            {{ $product->entree }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                            {{ $product->sortie }}
                                        </td>

                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                            {{ $product->quantite }}
                                        </td>
                                    </tr>
                                    @php
                                    $i++
                                    @endphp
                                    @endforeach
                                    @else
                                        <tr>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-red-500">
                                                no results match found for your query
                                            </td>
                                        </tr>
                                    @endif
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>
