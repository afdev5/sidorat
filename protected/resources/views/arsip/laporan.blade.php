<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Cetak Laporan</title>
    <style>
        body{
            padding: 0;
            margin: 0;
        }
        .page{
            max-width: 80em;
            margin: 0 auto;
        }
        table th,
        table td{
            text-align: left;
        }
        table.layout{
            width: 100%;
            border-collapse: collapse;
        }
        table.display{
            margin: 1em 0;
        }
        table.display th,
        table.display td{
            border: 1px solid #B3BFAA;
            padding: .5em 1em;
        }
​
        table.display th{ background: #D5E0CC; }
        table.display td{ background: #fff; }
​
        table.responsive-table{
            box-shadow: 0 1px 10px rgba(0, 0, 0, 0.2);
        }
​
        .listcust {
            margin: 0;
            padding: 0;
            list-style: none;
            display:table;
            border-spacing: 10px;
            border-collapse: separate;
            list-style-type: none;
        }
​
        .customer {
            padding-left: 600px;
        }
    </style>
</head>
<body>
    <div class="header">
        <h3>Laporan Arsip Surat Sidorat.com</h3>
        {{-- <h4 style="line-height: 0px;">Invoice: #{{ $order->invoice }}</h4> --}}
        <p><b>Tanggal : </b>{{ $awal ." s/d ". $akhir }}</p>
    </div>
    <div class="customer">
        <table>
            <tr>
                <th>Surat Biasa</th>
                <td>:</td>
                <td>{{ $biasa }}</td>
            </tr>
            <tr>
                <th>Surat Penting</th>
                <td>:</td>
                <td>{{ $penting }}</td>
            </tr>
            <tr>
                <th>Surat Rahasia</th>
                <td>:</td>
                <td>{{ $rahasia }}</td>
            </tr>
        </table>
    </div>
    <div class="page">
        <table class="layout display responsive-table">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Tanggal</th>
                    <th>No Agenda</th>
                    <th>Jenis Surat</th>
                    <th>Nomor Surat</th>
                </tr>
            </thead>
            <tbody>
                @php
                    $no = 1;
                @endphp
                @forelse ($data as $row)
                @php
                        if($row->jenis == 0)
                        {
                            $jenis = "Biasa";
                        }
                        elseif($row->jenis == 1)
                        {
                            $jenis = "Penting";
                        }
                        else {
                            $jenis = "Rahasia";
                        }
                 @endphp
                <tr>
                    <td>{{ $no++ }}</td>
                    <td>{{ $row->created_at->format('d/m/Y') }}</td>
                    <td>{{ $row->no_agenda }}</td>
                    <td>{{ $jenis }}</td>
                    <td>{{ $row->nomor }}</td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" class="text-center">Tidak ada data</td>
                </tr>
                @endforelse
            </tbody>
            {{-- <tfoot>
                <tr>
                    <th colspan="2">Total</th>
                    <td>Rp {{ number_format($totalPrice) }}</td>
                    <td>{{ number_format($totalQty) }} Item</td>
                    <td>Rp {{ number_format($total) }}</td>
                </tr>
            </tfoot> --}}
        </table>
    </div>
</body>
</html>
