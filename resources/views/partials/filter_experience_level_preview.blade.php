@if($filter_data_experience_level->isEmpty())
    <p>No data available for the selected filters.</p>
@else
    <ul>
        @foreach($filter_data_experience_level as $item)
            <li>
                <label class="cb-container">
                    <input type="checkbox" class="filterExperiencelevel" value="{{$item->nama}}"> <span class="text-small">{{$item->nama}}</span> <span class="text-small">Years</span>
                    <span class="checkmark"></span>
                </label>

            </li>
        @endforeach
    </ul>
@endif
