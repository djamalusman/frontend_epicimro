@if($filteredData->isEmpty())
    <p>No data available for the selected filters.</p>
@else
    <ul>
        @foreach($filteredData as $item)
            <li>
                <label class="cb-container">
                    <input type="checkbox" value="{{$item->nama}}"> <span class="text-small">{{$item->nama}}</span>
                    <span class="checkmark"></span>
                </label>
                <span class="number-item">{{$item->count}}</span>
            </li>
        @endforeach
    </ul>
@endif
