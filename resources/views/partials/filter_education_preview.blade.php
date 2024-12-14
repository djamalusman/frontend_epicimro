@if($filter_Data_education->isEmpty())
    <p>No data available for the selected filters.</p>
@else
    <ul>
        @foreach($filter_Data_education as $item)
            <li
                <label class="cb-container">
                    <input type="checkbox" class="filterEducation" value="{{$item->nama}}"> <span class="text-small">{{$item->nama}}</span>
                    <span class="checkmark"></span>
                </label>
            </li>
        @endforeach
    </ul>
@endif
