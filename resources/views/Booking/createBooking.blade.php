<input type="hidden" class="form-control" name="email_pemohon" value="{{ Auth::user()->email }}" />
<input type="hidden" class="form-control" name="jawatan_pemohon" value="{{ Auth::user()->jawatan }}" />
<input type="hidden" class="form-control" name="sn" value="" />input type=date min today

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
			<td style="width: 40%">Mesyuarat</td>
			<td colspan="4" rowspan="1">&nbsp;<textarea class="form-control" name="mesyuarat" value="" style="height:80px" required ></textarea></td>
		</tr>
		<tr>
			<td style="width:40%">Tarikh Penggunaan</td>
			<td colspan="2" style="text-align:center; width:30%">&nbsp;<input type="date" class="form-control" name="tarikhMula" title="Bermula" min="<?php echo date("Y-m-d"); ?>" required /></td>
			
		</tr>
		<tr>
			<td style="width:40%">Waktu Penggunaan</td>
			<td colspan="4" rowspan="1">&nbsp;
            <select name="ext2" id="ext2" class="form-control" required>
                    <option value="">-</option>
                    <option value="Pagi">Pagi</option>
                    <option value="Petang">Petang</option>
					<option value="Pagi Dan Petang">Pagi Dan Petang</option>
                </select>
            </td>
		</tr>
		<tr>
			<td style="width:40%">Lokasi / Aras</td>
			<td colspan="4" rowspan="1">&nbsp;
                
				<select name="lokasi" class="form-control" required>
						<option value="">--</option>
						@foreach ($rooms as $room)
							<option value="{{$room->bilik}}">{{$room->bilik}}</option>
						@endforeach
            </select>
            </td>
		</tr>
		<tr>
			<td style="width:40%">Pengerusi</td>
			<td colspan="4" rowspan="1">&nbsp;<input type="text" class="form-control" name="pengerusi" value="" required /></td>
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
			<td colspan="4" rowspan="1">&nbsp;<textarea class="form-control" name="makanan" value="" style="height:80px" ></textarea></td>
		</tr>
		<tr>
			<td style="width:40%">Minuman</td>
			<td colspan="4" rowspan="1">&nbsp;<textarea class="form-control" name="minuman" value="" style="height:80px" ></textarea></td>
		</tr>
		<tr>
			<td style="width:40%">Bilangan Ahli Mesyuarat</td>
			<td colspan="3" rowspan="1" style="width:30%">&nbsp;<input type="text" class="form-control" name="bil_ahli" value=""  required /></td>
			<td style="width:30%">&nbsp;</td>
		</tr>
		<tr>
			<td colspan="5" style="vertical-align:top; width:40%">
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
			<td colspan="4" rowspan="1" style="width:30%">&nbsp;<input type="text" class="form-control" name="nama_pemohon" value="{{ Auth::user()->name }}"  readonly /></td>
		</tr>
		<tr>
			<td style="width:40%">Bahagian</td>
			<td colspan="4" style="width:30%">&nbsp;<input type="text" class="form-control" name="bahagian_pemohon" value="{{ Auth::user()->bahagian }}"  readonly /></td>
		</tr>
		<tr>
			<td style="width:40%">Ext</td>
			<td colspan="2" style="width:30%">&nbsp;<input type="text" class="form-control" name="ext_pemohon" value="{{ Auth::user()->ext }}"  readonly /></td>
			<td colspan="2" style="width:30%">&nbsp;</td>
		</tr>
		
		<tr>
			<td style="width:40%">Tarikh</td>
			<td colspan="2" style="width:30%">&nbsp;<input type="text" class="form-control" name="tarikh_pemohon" class="text"  value="<?php echo date('d-m-Y'); ?>" readonly /></td>
			<td colspan="2" style="width:30%">&nbsp;</td>
		</tr>
		<tr>
			<td style="width:40%">Dokumen Sokongan</td>
			<td colspan="4" style="width:30%">&nbsp;<input type="file" class="form-control" name="lampiran1" required /></td>
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

