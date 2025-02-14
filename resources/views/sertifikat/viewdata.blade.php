
{{-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/css/bootstrap.min.css"> --}}
<link rel="stylesheet" href="https://cdn.datatables.net/2.1.8/css/dataTables.bootstrap5.css">

<style>
    /* Tambahkan border ke tabel */
    #example {
        border: 2px solid black;
    }

    /* Tambahkan border ke sel tabel (td & th) */
    #example th, #example td {
        border: 1px solid black;
    }
</style>

    <table id="example" class="table table-striped" style="width:100%">
        <thead>
            <tr>
                <th>Nama Peserta</th>
                {{-- <th>Email</th> --}}
                <th>Nama Training</th>
                <th>Tanggal Training</th>
                <th>No Sertifikat</th>
            </tr>
        </thead>
        <tbody>
            @foreach ( $data as $val)
                <tr>
                    <td>{{ $val->nama_peserta }}</td>
                    {{-- <td>{{ $val->email }}</td> --}}
                    <td>{{ $val->nama_training }}</td>
                    <td>{{ \Carbon\Carbon::parse($val->tanggal_training)->format('y-m-d') }}</td>
                    <td>{{ $val->no_sertifikat }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
