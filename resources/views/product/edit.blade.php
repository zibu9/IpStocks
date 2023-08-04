<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Edit Product
        </h2>
    </x-slot>
    <div>
        <div class="max-w-4xl mx-auto py-10 sm:px-6 lg:px-8">
            <div class="mt-5 md:mt-0 md:col-span-2">
                <form method="post" action="{{route('product.update', $product->id)}}">
                    @csrf
                    <div class="shadow overflow-hidden sm:rounded-md">
                        <div class="flex flex-wrap -mx-3">
                            <div class="w-full md:w-1/4 px-3 md:mb-0 bg-white sm:p-6">
                                <label for="designation" class="block text-sm font-medium text-gray-700">Designation</label>
                                <select id="designation" name="designation" autocomplete="designation" class="w-full block py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                                    <option
                                        @if ($product->designation == "entree")
                                        selected
                                        @endif
                                         value="entree"
                                    >Entree
                                    </option>
                                    <option
                                        @if ($product->designation == "sortie")
                                        selected
                                        @endif
                                         value="sortie">
                                         Sortie
                                    </option>
                                </select>
                            </div>
                                <input type="hidden" name="refid" id="refid" type="text" class="w-full form-input rounded-md shadow-sm block"
                                       value="{{$product->refId}}" />
                            <div class="w-full md:w-1/4 px-3 md:mb-0 bg-white sm:p-6">
                                <label for="localisation" class="block text-sm font-medium text-gray-700">Localisation</label>
                                <select id="localisation" name="localisation" autocomplete="localisation" class="w-full block py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                                    @foreach ($localisations as $localisation)
                                        <option
                                            value=" {{$localisation->id}}"
                                            @if($localisation->id == $product->localisation_id)
                                                selected
                                            @endif
                                        >{{ $localisation->content}}

                                        </option>
                                    @endforeach
                                    <option value="">NULL</option>
                                </select>
                            </div>
                            <div class="w-full md:w-1/4 px-3 md:mb-0 bg-white sm:p-6">
                                <label for="affectation" class="block text-sm font-medium text-gray-700">Affectation</label>
                                <select id="affectation" name="affectation" autocomplete="affectation" class="w-full block py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                                    @foreach ($affectations as $affectation)
                                        <option @if($affectation->id == $product->affectation_id)
                                                selected
                                            @endif
                                            value="{{$affectation->id}}"
                                        >{{ $affectation->content}}
                                        </option>
                                    @endforeach
                                    <option value="">NULL</option>
                                </select>
                            </div>
                        </div>
                        <div class="flex flex-wrap -mx-3">

                            <div class="bg-white sm:p-6 w-full md:w-1/4 px-3 md:mb-0 ">
                                <label for="emplacement" class="block font-medium text-sm text-gray-700">Emplacement</label>
                                <select id="emplacement" name="emplacement" autocomplete="emplacement" class="w-full block py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                                    @for ($i = 1; $i < 9; $i++)
                                        <option @if ($product->emplacement == $i)
                                            selected
                                        @endif value="{{$i}}">Etagere {{$i}}</option>
                                    @endfor
                                    <option value="">NULL</option>
                                </select>
                            </div>

                            <div class="bg-white sm:p-6 w-full md:w-1/4 px-3 md:mb-0 ">
                                <label for="modele" class="block font-medium text-sm text-gray-700">Modele</label>
                                <input type="text" name="modele" id="modele" type="text" class="w-full form-input rounded-md shadow-sm block"
                                       value="{{$product->modele}}" />
                                @error('modele')
                                    <p class="text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="bg-white sm:p-6 w-full md:w-1/4 px-3 md:mb-0 ">
                                <label for="type" class="block font-medium text-sm text-gray-700">Type</label>
                                <input type="text" name="type" id="type" type="text" class="w-full form-input rounded-md shadow-sm block"
                                       value="{{ $product->type }}" />
                                @error('type')
                                    <p class="text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="bg-white sm:p-6 w-full md:w-1/4 px-3 md:mb-0 ">
                                <label for="fabricant" class="block font-medium text-sm text-gray-700">Fabriquant</label>
                                <input type="text" name="fabricant" id="fabricant" type="text" class="w-full form-input rounded-md shadow-sm block"
                                       value="{{ $product->fabricant }}" />
                                @error('fabricant')
                                    <p class="text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <div class="flex flex-wrap -mx-3">
                            <div class="bg-white sm:p-6 w-full md:w-1/3 px-3 md:mb-0 ">
                                <label for="etat" class="block text-sm font-medium text-gray-700">Etat</label>
                                <select id="etat" name="etat" autocomplete="etat" class="w-full block py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                                    <option {{($product->etat == "NEW") ? "selected" : ""}} value="NEW">NEW</option>
                                    <option {{($product->etat == "OLD") ? "selected" : ""}}  value="OLD">OLD</option>
                                    <option {{($product->etat == "OTHER") ? "selected" : ""}}  value="OTHER">OTHER</option>
                                </select>
                            </div>
                            <div class="bg-white sm:p-6 w-full md:w-1/3 px-3 md:mb-0 ">
                                <label for="quantite" class="block font-medium text-sm text-gray-700">Quantité</label>
                                <input type="text" name="quantite" id="quantite" type="text" class="w-full form-input rounded-md shadow-sm block"
                                       value="{{ $product->quantite }}" />
                                @error('quantite')
                                    <p class="text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="bg-white sm:p-6 w-full md:w-1/3 px-3 md:mb-0 ">
                                <label for="provenance" class="block font-medium text-sm text-gray-700">Provenance</label>
                                <select id="provenance" name="provenance" autocomplete="provenance" class="w-full block py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                                    <option {{ ($product->provenance == "Achat") ? 'selected' : '' }} value="Achat">Achat</option>
                                    <option {{ ($product->provenance == "Other") ? 'selected' : '' }} value="Other">Other</option>
                                </select>
                            </div>
                        </div>

                        <div class="flex flex-wrap -mx-3">
                            <div class="bg-white sm:p-6 w-full md:w-1/3 px-3 md:mb-0 ">
                                <label for="observation" class="block text-sm font-medium text-gray-700">Observation</label>
                                <textarea name="observation" id="observation" type="text" class="w-full form-input rounded-md shadow-sm block">
                                    {{ $product->observation }}</textarea>
                                @error('observation')
                                    <p class="text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <div class="flex items-center justify-end px-4 py-3 bg-gray-50 text-right sm:px-6">
                            <div class="sm:p-6 w-full md:w-1/3 px-3 md:mb-0 ">
                                <input type="date" name="date_designation" id="date_designation" type="text" class="w-full form-input rounded-md shadow-sm block"
                                       value="{{ $product->date_designation }}" />
                            </div>
                            <button type="submit" class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:shadow-outline-gray disabled:opacity-25 transition ease-in-out duration-150">
                                Update
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>

