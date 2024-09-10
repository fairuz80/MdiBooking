

<div class="container">
    
@forelse( $tasks as $task )

<table  class="table table-bordered table-striped w-60 table-sm" style="width: 100%; text-align: left;">
<tr>
    <td style="width: 10%; text-align: center; vertical-align: top;" rowspan="2">
        
        </td>
        <td>
            <ul>
                <li><b>TAJUK :</b>&nbsp;{{$task->mesyuarat}}</li>
                <li><b>TARIKH PENGGUNAAN :</b>&nbsp;{{\Carbon\Carbon::parse($task->tarikhMula)->format('d-m-Y')}}</li>
                <li><b>WAKTU PENGGUNAAN :</b>&nbsp;{{$task->ext2}}</li>
                <li><b>LOKASI :</b>&nbsp;{{$task->lokasi}}</li>
                <li><b>TARIKH PERMOHONAN:</b>&nbsp;{{$task->tarikh_pemohon}}</li>
                
            </ul>
        </td>
        </tr>
@empty  

    <B>TIADA CATATAN (Rujuk Senarai)</B>

@endforelse
  </tbody>

</table>

</div>
