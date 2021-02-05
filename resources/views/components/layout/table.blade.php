<table class="min-w-full divide-y divide-gray-200">
    <thead class="bg-gray-50">
        <tr>
            @foreach($headerCols as $col)
            <th scope="col" class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                {{$col}}
            </th>
            @endforeach
        </tr>
    </thead>

    <tbody class="bg-white divide-y divide-gray-200">
        {{$slot}}
    </tbody>

</table>