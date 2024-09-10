<!DOCTYPE html>
<html>
<head>
    <title>Kemaskini Tempahan Bilik</title>
</head>
<body>
    <h3>Permohonan Penukaran Tarikh Tempahan Bilik</h3>
    <p>Butiran tempahan bilik mesyuarat:</p>
    <ul>
        <li>MAKLUMAT TEMPAHAN SEMASA</li>
        <li>No.ID: {{ $ebooking->sn }}</li>
        <li>Agenda: {{ $ebooking->mesyuarat }}</li>
        <li>Nama Pemohon: {{ $ebooking->nama_pemohon }}</li>
        <li>Bahagian/Unit: {{ $ebooking->bahagian_pemohon }}</li>
        <li>Lokasi: {{ $ebooking->lokasi }}</li>
        <li>Tarikh: {{\Carbon\Carbon::parse($ebooking->tarikhMula)->format('d-m-Y')}}</li>
        <li>Sesi Penggunaan: {{ $ebooking->ext2 }}</li>
        <li><hr></li>
        <li><b>Status Permohonan:</b>&nbsp;
                @if ($ebooking->pengesahan_bkp == NULL)
                Menunggu Pengesahan BKP
                @else
                {{$ebooking->pengesahan_bkp}}
                @endif</li> <!-- part nie pening jgn tanye -->
                @if ($ebooking->mohon_tukar != NULL && $ebooking->pengesahan_bkp == 'lulus' && $ebooking->sah_tukar == NULL)
                    <li>Permohonan Penukaran Tempahan. Menunggu Pengesahan BKP</li>
                @elseif ($ebooking->mohon_tukar != NULL && $ebooking->pengesahan_bkp != 'lulus' && $ebooking->sah_tukar != NULL)
                    <li>Kebenaran Permohonan Pertukaran. Sila Kemaskini Tempahan Baru</li>
                @elseif ($ebooking->mohon_tukar != NULL && $ebooking->pengesahan_bkp != 'lulus' && $ebooking->sah_tukar == NULL)
                    <li>Penukaran Tempahan dikemaskini. Menunggu Pengesahan BKP</li>
                @elseif ($ebooking->mohon_tukar != NULL && $ebooking->pengesahan_bkp == 'lulus' && $ebooking->sah_tukar != NULL)
                    <li>Permohonan Penukaran Tempahan diluluskan</li>
                @else 
                @endif
    </ul>

    <p><b>Mohon pihak BKP membatalkan permohonan terdahulu untuk pemohon mengemaskini tempahan bilik</b></p>
</body>
</html>