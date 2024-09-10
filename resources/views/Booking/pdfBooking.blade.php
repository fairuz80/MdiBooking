<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>eBooking</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Merriweather:ital,wght@1,700&family=Source+Serif+4:opsz,wght@8..60,600&display=swap" rel="stylesheet">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css">
            <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.slim.min.js"></script>
            <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
            <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js"></script>
            <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>

        <!-- Styles -->
        
        <style>
			body {
                font-family: 'Nunito', sans-serif;
            }

            #cetak {
            width: auto; /* Adjust the height as per your requirements */
            overflow: hidden; /* Hide any overflowing content */
            padding-left: 20px;
            /* padding-top: 10px; */
            margin: 30px center; /* Center the calendar on the page */
            }

			
        </style>
        
    </head>
    
<body>


<form id = "pdf" method="GET" action="" enctype="multipart/form-data">

<div id="cetak" >

<table align="center" border="0" cellpadding="1" cellspacing="1" style="width:100%">
	<tbody>
		<tr>
			<td colspan="5" style="text-align:center"><img src="{{public_path('logo/Mdi.png')}}" alt="" height="10%" width="20%"></td>
		</tr>
		<tr>
			<td colspan="5" style="text-align:center">
			<p><strong><span style="font-family:Georgia,serif">TEMPAHAN BILIK MESYUARAT</span></strong><br />
			<strong><span style="font-family:Georgia,serif">MAKANAN DAN MINUMAN</span></strong></p>
			</td>
		</tr>
		<tr>
			<td colspan="5" style="text-align:center"><hr></td>
		</tr>
		<tr>
			<td style="width:40%">No. ID</td>
			<td colspan="2" style="width:30%">{{$data['sn']}}</td>
			<td colspan="2" style="width:30%"></td>
		</tr>
		<tr>
			<td style="width: 40%">Mesyuarat</td>
			<td colspan="4" rowspan="1"><textarea name="mesyuarat" rows="3" style="width:100%; border:none; resize:none; overflow:hidden;" readonly>{{$data['mesyuarat']}}</textarea></td>
		</tr>
		<tr>
			<td style="width:40%">Tarikh Penggunaan</td>
			<td colspan="2" style="width:30%">{{\Carbon\Carbon::parse($data['tarikhMula'])->format('d-m-Y')}}</td>
			<td colspan="2" style="width:30%"></td>
		</tr>
		<tr>
			<td style="width:40%">Waktu Penggunaan</td>
			<td colspan="4" rowspan="1">{{$data['ext2']}}</td>
		</tr>
		<tr>
			<td style="width:40%">Lokasi / Aras</td>
			<td colspan="4" rowspan="1">{{$data['lokasi']}}</td>
		</tr>
		<tr>
			<td style="width:40%">Pengerusi</td>
			<td colspan="4" rowspan="1">{{$data['pengerusi']}}</td>
		</tr>
		<tr>
			<td colspan="5" style="text-align:left; vertical-align:top; width:30%">
			<p style="margin-left:10px"><span style="color:#000099"><span style="font-size:9px"><span style="font-family:Calibri,sans-serif">*Jika mesyuarat perlu menggunakan capaian Google Meet / bantuan teknikal, pihak urus setia mesyuarat perlu memaklumkan terlebih dahulu kepada Bahagian Teknologi Maklumat untuk mengendalikan urusan tersebut dan;</span></span></span><br />
			<span style="color:#000099"><span style="font-size:9px"><span style="font-family:Calibri,sans-serif">*Jika mesyuarat perlu menggunakan peralatan selain yang disediakan dalam Bilik Mesyuarat seperti kerusi/meja/ portable speaker atau peralatan lain, pihak urus setia mesyuarat perlu berurusan dengan bahagian / unit berkaitan.</span></span></span></p>
			</td>
		</tr>
		<tr>
			<td colspan="5" style="text-align:center"><hr></td>
		</tr>
		<tr>
			<td colspan="5" style="width:30%"><strong><span style="font-family:Georgia,serif">PESANAN PERKHIDMATAN</span></strong></td>
		</tr>
		<tr>
			<td style="width:40%">Makanan</td>
			<td colspan="4" rowspan="1" style="width:30%"><textarea name="makanan" rows="3" style="width:100%; border:none; resize:none; overflow:hidden;" readonly>{{$data['makanan']}}</textarea></td>
		</tr>
		<tr>
			<td style="width:40%">Minuman</td>
			<td colspan="4" rowspan="1" style="width:30%"><textarea name="minuman" rows="3" style="width:100%; border:none; resize:none; overflow:hidden;" readonly>{{$data['minuman']}}</textarea></td>
		</tr>
		<tr>
			<td style="width:40%">Bilangan Ahli Mesyuarat</td>
			<td colspan="3" rowspan="1" style="width:30%">{{$data['bil_ahli']}}</td>
			<td style="width:30%"></td>
		</tr>
		<tr>
			<td colspan="5" style="vertical-align:top; width:40%">
			<p style="margin-left:10px"><span style="font-size:9px"><span style="color:#000099"><span style="font-family:Calibri,sans-serif">*Sila lampirkan memo/surat/e-mai/ panggilan mesyuarat &amp; nama pegawai/jemputan yang terlibat bagi tempahan bilik mesyuarat beserta tempahan makanan</span></span></span><br />
			<span style="font-size:9px"><span style="font-family:Calibri,sans-serif"><span style="color:#000099">*Permohonan makanan/minuman perlu dibuat selewat-lewatnya tiga (3) hari sebelum tarikh mesyuarat berlangsung</span></span></span><br />
			<span style="font-size:9px"><span style="font-family:Calibri,sans-serif"><span style="color:#000099">*Permohonan makanan/minuman hanya dapat dibekalkan jika mesyuarat dipengerusikan oleh Ketua Jabatan / ahli mesyuarat yang terdiri daripada agensi / pihak Iuar</span></span></span></p>
			</td>
		</tr>
		<tr>
			<td colspan="5" style="text-align:center"><hr></td>
		</tr>
		<tr>
			<td colspan="5" style="width:30%"><span style="font-family:Georgia, serif"><strong>BUTIRAN PEMOHON / URUSETIA MESYUARAT</strong></span></td>
		</tr>
		<tr>
			<td style="width:40%">Nama Pegawai</td>
			<td colspan="4" rowspan="1" style="width:30%">{{$data['nama_pemohon']}}</td>
		</tr>
		<tr>
			<td style="width:40%">Bahagian</td>
			<td colspan="4" style="width:30%">{{$data['bahagian_pemohon']}}</td>
		</tr>
		<tr>
			<td style="width:40%">Ext</td>
			<td colspan="2" style="width:30%">{{$data['ext_pemohon']}}</td>
			<td colspan="2" style="width:30%"></td>
		</tr>
		<tr>
			<td style="width:40%">Email Pemohon</td>
			<td colspan="2" style="width:30%">{{$data['email_pemohon']}}</td>
			<td colspan="2" style="width:30%"></td>
		</tr>
		<tr>
			<td style="width:40%">Tarikh</td>
			<td colspan="2" style="width:30%">{{\Carbon\Carbon::parse($data['tarikh_pemohon'])->format('d-m-Y')}}</td>
			<td colspan="2" style="width:30%"></td>
		</tr>
		<tr>
			<td style="width:40%">Status Tempahan</td>
			<td colspan="2" style="width:30%">
				
				@if ($data['pengesahan_bkp'] == NULL)
                Menunggu Pengesahan BKP
                @else
                {{$data['pengesahan_bkp']}}
                @endif</td>
			<td colspan="2" style="width:30%"></td>
		</tr>
		@if ($data['catatan_tukar'] != NULL )
		<tr>
			<td colspan="5" style="text-align:center"><hr></td>
		</tr>
		<tr>
			<td colspan="5" style="width:30%"><span style="font-family:Georgia, serif"><strong>PERMOHONAN PENUKARAN TARIKH TEMPAHAN</strong></span></td>
		</tr>
		<tr>
			<td style="width:40%">Catatan Pertukaran </td>
			<td colspan="4" rowspan="1"><textarea name="catatan_tukar" rows="3" style="width:100%; border:none; resize:none; overflow:hidden;" readonly>{{$data['catatan_tukar']}}</textarea></td>
		</tr>
		<tr>
			<td style="width:40%">Status Pertukaran</td>
				@if ($data['mohon_tukar'] != NULL && $data['pengesahan_bkp'] == 'lulus' && $data['sah_tukar'] == NULL)
					<td colspan="4" rowspan="1">Permohonan Penukaran Tempahan. Menunggu Pengesahan BKP</td>
                @elseif ($data['mohon_tukar'] != NULL && $data['pengesahan_bkp'] != 'lulus' && $data['sah_tukar'] != NULL)
					<td colspan="4" rowspan="1">Permohonan Penukaran Tempahan Dibenarkan. Sila Kemaskini Tempahan Baru</td>
                @elseif ($data['mohon_tukar'] != NULL && $data['pengesahan_bkp'] != 'lulus' && $data['sah_tukar'] == NULL)
					<td colspan="4" rowspan="1">Penukaran Tempahan dikemaskini. Menunggu Pengesahan BKP</td>
                @elseif ($data['mohon_tukar'] != NULL && $data['pengesahan_bkp'] == 'lulus' && $data['sah_tukar'] != NULL)
					<td colspan="4" rowspan="1">Permohonan Penukaran Tempahan diluluskan</td>
                @else 
                @endif
		</tr>
		<tr>
			<td style="width:40%">Catatan BKP </td>
			<td colspan="4" rowspan="1"><textarea name="catatan_bkp" rows="3" style="width:100%; border:none; resize:none; overflow:hidden;" readonly>{{$data['catatan_bkp']}}</textarea></td>
		</tr>
		@else
		@endif
		<tr>
			<td style="width:40%">Pegawai Pengesah</td>
			<td colspan="4" rowspan="1" style="width:30%">{{$data['nama_bkp']}}</td>
		</tr>
	</tbody>
</table>

</div>


</form> 

</body>

<!-- adjust textarea size -->
<script>
    document.addEventListener('input', function (e) {
        if (e.target.tagName.toLowerCase() === 'textarea') {
            e.target.style.height = 'auto';
            e.target.style.height = (e.target.scrollHeight) + 'px';
        }
    });

    // Adjust the height of the textarea on page load
    document.getElementById('mesyuarat').style.height = document.getElementById('mesyuarat').scrollHeight + 'px';
	document.getElementById('makanan').style.height = document.getElementById('makanan').scrollHeight + 'px';
	document.getElementById('minuman').style.height = document.getElementById('minuman').scrollHeight + 'px';
	document.getElementById('catatan_tukar').style.height = document.getElementById('catatan_tukar').scrollHeight + 'px';
	document.getElementById('catatan_bkp').style.height = document.getElementById('catatan_bkp').scrollHeight + 'px';
</script>

</html>