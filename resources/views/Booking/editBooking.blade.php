<input type="hidden" class="form-control" name="email_pemohon" value="{{$ebookings['email_pemohon']}}" />
<input type="hidden" class="form-control" name="jawatan_pemohon" value="{{$ebookings['jawatan_pemohon']}}" />
<input type="hidden" class="form-control" name="sah_tukar" value="" /> <!-- penting gile -->
<input type="hidden" name="id" value="{{$ebookings['id']}}">

<table align="center" border="0" cellpadding="1" cellspacing="1" style="width:600px">
	<tbody>
		<tr>
			<td colspan="5" style="text-align:center">LOGO</td>
		</tr>
		<tr>
			<td colspan="5" style="text-align:center">
			<p><strong><span style="font-family:Georgia,serif">TEMPAHAN BILIK MESYUARAT</span></strong><br />
			<strong><span style="font-family:Georgia,serif">MAKANAN DAN MINUMAN</span></strong></p>
			</td>
		</tr>
		<tr>
			<td style="width:40%">Mesyuarat</td>
			<td colspan="4" rowspan="1">&nbsp;<textarea class="form-control" name="mesyuarat" value="" style="height:80px" required >{{$ebookings['mesyuarat']}}</textarea></td>
		</tr>
		<tr>
			<td style="width:40%">Tarikh Penggunaan</td>
			<td colspan="2" style="text-align:center; width:30%">&nbsp;<input type="date" class="form-control" name="tarikhMula" class="date" min="<?php echo date("Y-m-d"); ?>" title="Bermula" value="{{$ebookings['tarikhMula']}}" required /></td>
		</tr>
		<tr>
			<td style="width:40%">Waktu Penggunaan</td>
			<td colspan="4">&nbsp;
            <select name="ext2" id="ext2" class="form-control" required>
                    <option value="{{$ebookings['ext2']}}">{{$ebookings['ext2']}}</option>
                    <option value="Pagi">Pagi</option>
                    <option value="Petang">Petang</option>
                </select>
            </td>
		</tr>
		<tr>
			<td style="width:40%">Lokasi / Aras</td>
			<td colspan="4" rowspan="1">&nbsp;
                <select name="lokasi" id="lokasi" class="form-control" required>
                    	@foreach ($rooms as $room)
							<option value="{{$room->bilik}}">{{$room->bilik}}</option>
						@endforeach
                </select>
            </td>
		</tr>
		<tr>
			<td style="width:40%">Pengerusi</td>
			<td colspan="4" rowspan="1">&nbsp;<input type="text" class="form-control" name="pengerusi" value="{{$ebookings['pengerusi']}}" required /></td>
		</tr>
		<tr>
			<td colspan="5" style="text-align:left; vertical-align:top; width:30%">
			<p style="margin-left:10px"><span style="color:#000099"><span style="font-size:11px"><span style="font-family:Calibri,sans-serif">*Jika mesyuarat perlu menggunakan capaian Google Meet / bantuan teknikal, pihak urus setia mesyuarat perlu memaklumkan terlebih dahulu kepada Bahagian Teknologi Maklumat untuk mengendalikan urusan tersebut dan;</span></span></span><br />
			<span style="color:#000099"><span style="font-size:11px"><span style="font-family:Calibri,sans-serif">*Jika mesyuarat perlu menggunakan peralatan selain yang disediakan dalam Bilik Mesyuarat seperti kerusi/meja/ portable speaker atau peralatan lain, pihak urus setia mesyuarat perlu berurusan dengan bahagian / unit berkaitan.</span></span></span></p>
			</td>
		</tr>
		<tr>
			<td colspan="5" style="width:30%"><strong><span style="font-family:Georgia,serif">PESANAN PERKHIDMATAN</span></strong></td>
		</tr>
		<tr>
			<td style="width:40%">Makanan</td>
			<td colspan="4" rowspan="1">&nbsp;<textarea class="form-control" name="makanan" value="" style="height:80px" >{{$ebookings['makanan']}}</textarea></td>
		</tr>
		<tr>
			<td style="width:40%">Minuman</td>
			<td colspan="4" rowspan="1">&nbsp;<textarea class="form-control" name="minuman" value="" style="height:80px" >{{$ebookings['minuman']}}</textarea></td>
		</tr>
		<tr>
			<td style="width:40%">Bilangan Ahli Mesyuarat</td>
			<td colspan="3" style="width:30%">&nbsp;<input type="text" class="form-control" name="bil_ahli" value="{{$ebookings['bil_ahli']}}" required /></td>
			<td style="width:40%">&nbsp;</td>
		</tr>
		<tr>
			<td colspan="5" style="vertical-align:top; width:30%">
			<p style="margin-left:10px"><span style="font-size:11px"><span style="color:#000099"><span style="font-family:Calibri,sans-serif">*Sila lampirkan memo/surat/e-mai/ panggilan mesyuarat &amp; nama pegawai/jemputan yang terlibat bagi tempahan bilik mesyuarat beserta tempahan makanan</span></span></span><br />
			<span style="font-size:11px"><span style="font-family:Calibri,sans-serif"><span style="color:#000099">*Permohonan makanan/minuman perlu dibuat selewat-lewatnya tiga (3) hari sebelum tarikh mesyuarat berlangsung</span></span></span><br />
			<span style="font-size:11px"><span style="font-family:Calibri,sans-serif"><span style="color:#000099">*Permohonan makanan/minuman hanya dapat dibekalkan jika mesyuarat dipengerusikan oleh Ketua Jabatan / ahli mesyuarat yang terdiri daripada agensi / pihak Iuar</span></span></span></p>
			</td>
		</tr>
		<tr>
			<td colspan="5" style="width:30%"><span style="font-family:Georgia, serif"><strong>BUTIRAN PEMOHON / URUSETIA MESYUARAT</strong></span></td>
		</tr>
		<tr>
			<td style="width:40%">Nama Pegawai</td>
			<td colspan="4" rowspan="1" style="width:30%">&nbsp;<input type="text" class="form-control" name="nama_pemohon" value="{{$ebookings['nama_pemohon']}}" readonly /></td>
		</tr>
		<tr>
			<td style="width:30%">Bahagian</td>
			<td colspan="4" style="width:30%">&nbsp;<input type="text" class="form-control" name="bahagian_pemohon" value="{{$ebookings['bahagian_pemohon']}}" readonly /></td>
		</tr>
		<tr>
			<td style="width:40%">Ext</td>
			<td colspan="2" style="width:30%">&nbsp;<input type="text" class="form-control" name="ext_pemohon" value="{{$ebookings['ext_pemohon']}}" readonly /></td>
			<td colspan="2" style="width:30%">&nbsp;</td>
		</tr>
		
		<tr>
			<td style="width:40%%">Tarikh Permohonan</td>
			<td colspan="2" style="width:30%">&nbsp;<input type="text" class="form-control" name="tarikh_pemohon" class="text" value="<?php echo date('d-m-Y'); ?>" readonly /></td>
			<td colspan="2" style="width:30%">&nbsp;</td>
		</tr>
		<tr>
			<td style="width:40%">Lampiran</td>
			<td colspan="4" style="width:30%">&nbsp;<input type="file" class="form-control" name="lampiran1" value="" required />
				<a href="{{ asset('lampiran/' . $ebookings['lampiran1']) }}">
					{{ $ebookings['lampiran1'] }}
				</a>
			</td>
		</tr>
		<tr>
			<td style="width:40%"></td>
			<td colspan="4" rowspan="1"><br></td>
		</tr>
		<tr>
			<td style="width:40%"></td>
			<td colspan="4" rowspan="1">&nbsp;<input type="checkbox" name="pengesahan_pemohon" value="sah" required>&nbsp; Pengesahan Pemohon</td>
		</tr>
		
	</tbody>
</table>