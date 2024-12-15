<div class="content-single">
    <h2><b>Training requirements</b></h2>
    @php $counter = 1; @endphp
    @foreach($listpersyaratan as $persyaratan)
        <p>{{ $counter }}. {{ $persyaratan->nama }}</p>
        @php $counter++; @endphp
    @endforeach

    <h2 class="mt-20"><b>Training material</b></h2>
    @php $counterm = 1; @endphp
    @foreach($listmateri as $materi)
        <p>{{ $counterm }}. {{ $materi->nama }}</p>
        @php $counterm++; @endphp
    @endforeach

    <h2 class="mt-20"><b>Facility</b></h2>
    @php $counterf = 1; @endphp
    @foreach($listfasilitas as $fasilitas)
        <p>{{ $counterf }}. {{ $fasilitas->nama }}</p>
        @php $counterf++; @endphp
    @endforeach
</div>
