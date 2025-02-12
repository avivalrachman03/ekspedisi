<link href="//netdna.bootstrapcdn.com/bootstrap/3.1.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//netdna.bootstrapcdn.com/bootstrap/3.1.0/js/bootstrap.min.js"></script>
<script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
<style>
    * {
        font-size: 10px
    }

    .invoice-title h2,
    .invoice-title h5,
    .invoice-title h3 {
        display: inline-block;
    }

    .invoice-title h5 {
        font-size: 10px;
    }

    .invoice-title h2>strong,
    .invoice-title h3 {
        font-size: 16px;
    }

    .table>tbody>tr>.no-line {
        border-top: none;
    }

    .table>thead>tr>.no-line {
        border-bottom: none;
    }

    .table>tbody>tr>.thick-line {
        border-top: 0.5px solid;
    }

    .row>div>hr {
        margin: 0px;
    }

    @media print {
        @page {
            size: 210mm 297mm;
            margin: 0px;
            padding: 0px;
        }

        body {
            margin: 0px;
            padding: 0px;
        }

        .table {
            margin-bottom: 5%;
        }

        ::-webkit-scrollbar {
            display: none;
        }

        tbody>tr>td {
            max-width: 500px;
        }

        .hr {
            border: 0.1em dashed rgb(129, 129, 129);
        }


    }
</style>
<!------ Include the above in your HEAD tag ---------->
<div class="container">
    @for ($i = 0; $i < 3; $i++)
        <div class="row">
            <div class="col-xs-12">
                <div class="invoice-title">
                    <img src="{{ URL::asset('/logo.png') }}" alt="" title="" width="60px" class="mr-2">
                    <h2><strong>Pangeran</strong></h2>
                    <h5>cargo</h5>
                    <h3 class="pull-right">{{ $paket->no_resi }}</h3>
                    <div class="row margin-top-0 margin-bottom-0">
                        <p class="col-xs-6 padding-left-10">Counter : {{ $paket->user->name }}</p>
                        <p class="col-xs-6 text-right text-muted"> <strong>Tgl :
                                {{ $paket->created_at->format('d/m/Y') }}</strong></p>
                    </div>
                </div>
                <hr>
                <div class="row">
                    <div class="col-xs-6">
                        <address>
                            <strong>Pengirim :</strong><br>
                            {{ $paket->pengirim->name }} - {{ $paket->pengirim->phone }} <br>
                            Alamat: {{ $paket->pengirim->address }} Denpasar / Bali <br>
                            <strong>Vendor :</strong>
                            {{ $paket->vendor->name ?? '' }} - {{ $paket->resi_vendor ?? '' }}
                            @if ($paket->resi_vendor != null)
                                <img src="{{ URL::asset('/storage' . '/' . $paket->vendor->logo) }} " width="40px"
                                    margin="0px">
                            @else
                                <img src="{{ URL::asset('/logo.png') }}" width="57px" margin="0px">
                            @endif
                        </address>
                    </div>

                    <div class="col-xs-6 text-right">
                        <address>
                            <strong>Penerima : </strong><br>
                            {{ $paket->nama_penerima }} - {{ $paket->hp_penerima }}<br>
                            Alamat: {{ $paket->alamat_penerima }} / {{ $paket->regencies->name }} /
                            {{ $paket->province->name }} - ({{ $paket->regencies->code }})
                        </address>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                <table class="table ">
                    <thead>
                        <tr>
                            <td class="text-left col-md-4"><strong>Nama Barang</strong></td>
                            <td class="text-center col-md-2"><strong>Berat</strong></td>
                            <td class="text-center col-md-2"><strong>Dimensi</strong></td>
                            <td class="text-center col-md-2"><strong>Koli</strong></td>
                            <td class="text-right col-md-2"><strong>Harga / Kg</strong></td>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>{{ $paket->nama_paket }}</td>
                            <td class="text-center">{{ $paket->berat }} Kg</td>
                            <td class="text-center">{{ $paket->panjang, $paket->lebar, $paket->tinggi }}</td>
                            <td class="text-center">{{ $paket->koli }}</td>
                            <td class="text-right">Rp.
                                {{ number_format($paket->regencies->harga, 0, ',', '.') }}</td>
                        </tr>

                        <tr>
                            <td class="thick-line" colspan="3"  maxwidth="50px">Catatan :
                                {{ $paket->keterangan }}</td>
                            <td class="thick-line text-left"><strong>Subtotal :</strong></td>
                            <td class="thick-line text-right">Rp.
                                {{ number_format($paket->regencies->harga * $paket->berat, 0, ',', '.') }}</td>
                        </tr>

                        <tr>
                            <td class="no-line"> </td>
                            <td class="no-line"></td>
                            <td class="no-line"></td>
                            <td class="no-line text-left"><strong>Biaya Tambahan :</strong></td>
                            <td class="no-line text-right">Rp.
                                {{ number_format($paket->tambahan, 0, ',', '.') }}</td>
                        </tr>
                        <tr>
                            <td class="no-line">( {{ $paket->user->name }} )</td>
                            <td class="no-line">({{ $paket->pengirim->name }})</td>
                            <td class="no-line">( {{ $paket->nama_penerima}} )</td>
                            <td class="no-line text-left"><strong>Total Ongkir :</strong></td>
                            <td class="no-line text-right"> Rp.
                                {{ number_format($paket->regencies->harga * $paket->berat + $paket->tambahan, 0, ',', '.') }}
                            </td>
                        </tr>
                    </tbody>
                </table>
                <hr class="hr">
            </div>
        </div>
    @endfor
</div>
<script>
    window.onload = function() {
        window.print();
    }
    window.onafterprint = function() {
        window.close();
    }
</script>
</body>

</html>
