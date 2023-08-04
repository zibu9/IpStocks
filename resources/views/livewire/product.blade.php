
<tr>
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
        {{ $product->fabricant }}
    </td>
    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
        {{ $product->etat }}
    </td>
    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
        {{ $product->localisation->content }}
    </td>
    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
       Etagère {{ $product->emplacement }}
    </td>
    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
        @if ($product->designation == "entree")
            {{ $product->quantite }}
        @endif
    </td>
    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
            @if ($product->designation == "sortie")
                {{ $product->quantite }}
            @endif
    </td>
    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
        {{ $product->observation }}
    </td>
    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
        {{ $product->date_designation}}
    </td>
    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
        <a href="{{ route('product.edit',$product->id) }}" class="text-indigo-600 hover:text-indigo-900 mb-2 mr-2">Edit</a>
        <form class="inline-block" action="{{ route('product.destroy',$product->id) }}" method="POST" onsubmit="return confirm('etes vous sure?');">
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
            <input type="submit" class="text-red-600 hover:text-red-900 mb-2 mr-2" value="Delete">
        </form>
    </td>
</tr>
