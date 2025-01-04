@if($filter_jenis_sertifikasi->isEmpty())
    <p>No data available for the selected filters.</p>
@else
    <ul>
        @foreach($filter_jenis_sertifikasi as $item)
            <li>
                <label class="cb-container">
                    <input type="checkbox" class="filterJenissertifikasi" value="{{$item->nama}}"> <span class="text-small">{{$item->nama}}</span>
                    <span class="checkmark"></span>
                </label>
            </li>
        @endforeach
    </ul>
@endif
