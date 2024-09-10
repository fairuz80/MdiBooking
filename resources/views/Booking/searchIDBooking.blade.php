<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-100 leading-tight">
            {{ __('Tempahan Bilik MdI') }}
        </h2>
    </x-slot>

    @if(session()->has('warning'))
        <div class="alert alert-warning">
            {{ session()->get('warning') }}
        </div>
    @endif

    @if(session()->has('success'))
        <div class="alert alert-success">
            {{ session()->get('success') }}
        </div>
    @endif

<div class="Bar">
    <!-- Cipta modal -->
    <a class="btn btn-outline-primary btn-sm text-light float-right mb-3" data-toggle="modal" id="ciptaButton1" data-target="#ciptaModal"
        data-attr="{{ route('create.booking') }}" title="Tempahan"><i class="fa fa-file-o" style="font-size:14px;color:black"> Tempahan</i>
    </a>
    <!-- Carian -->

    <form class="d-flex float-right mb-3" type="get" action="{{ route('searchID.booking') }}">
            <input type="text"  name="no_id" value="" class="form-control" title="No. ID" style="height:31px" required>
            <button class="btn btn-outline-success btn-sm float-right mb-3" type="submit">Carian</button>
    </form>
</div>

<div class="container">
    
@forelse( $tasks as $task )

<table  class="table table-bordered table-striped w-60 table-sm" style="width: 100%; text-align: left;">
<tr>
    <td style="width: 10%; text-align: center; vertical-align: top;" rowspan="2">
        
        </td>
        <td>
            <ul>
                <li><b>No. ID :</b>&nbsp;{{$task->sn}}</li>
                <li><b>TAJUK :</b>&nbsp;{{$task->mesyuarat}}</li>
                <li><b>TARIKH PENGGUNAAN :</b>&nbsp;{{\Carbon\Carbon::parse($task->tarikhMula)->format('d-m-Y')}}</li>
                <li><b>WAKTU PENGGUNAAN :</b>&nbsp;{{$task->ext2}}</li>
                <li><b>LOKASI :</b>&nbsp;{{$task->lokasi}}</li>
                <li><b>TARIKH PERMOHONAN:</b>&nbsp;{{$task->tarikh_pemohon}}</li>
                <li><b>STATUS PERMOHONAN:</b>&nbsp;
                @if ($task->pengesahan_bkp == NULL)
                Menunggu Pengesahan BKP
                @else
                {{$task->pengesahan_bkp}}
                @endif</li> <!-- part nie pening jgn tanye -->
                @if ($task->mohon_tukar != NULL && $task->pengesahan_bkp == 'lulus' && $task->sah_tukar == NULL)
                    <li style="color: #696969;">Permohonan Penukaran Tempahan. Menunggu Pengesahan BKP</li>
                @elseif ($task->mohon_tukar != NULL && $task->pengesahan_bkp != 'lulus' && $task->sah_tukar != NULL)
                    <li style="color: #CD5C5C;">Kebenaran Permohonan Pertukaran. Sila Kemaskini Tempahan Baru</li>
                @elseif ($task->mohon_tukar != NULL && $task->pengesahan_bkp != 'lulus' && $task->sah_tukar == NULL)
                    <li style="color: #483D8B;">Penukaran Tempahan dikemaskini. Menunggu Pengesahan BKP</li>
                @elseif ($task->mohon_tukar != NULL && $task->pengesahan_bkp == 'lulus' && $task->sah_tukar != NULL)
                    <li style="color: #556B2F;">Permohonan Penukaran Tempahan diluluskan</li>
                @else 
                @endif
                
                <li>
                    <a href="{{ route('destroy.booking', $task->id) }}" class="btn btn-outline-danger btn-sm fa fa-trash" id="mediumButtonHapus" role="button" aria-pressed="true"> Hapus</a>
                    @if ($task->pengesahan_bkp != 'lulus' && Auth::user()->hasRole('user'))
                    <a class="btn btn-outline-info btn-sm fa fa-edit editButton" data-toggle="modal" id="editButton-{{ $task->id }}" data-target="#editModal" data-attr="{{ route('edit.booking', $task->id) }}" title="Kemaskini" > Kemaskini</a>
                    @elseif ($task->pengesahan_bkp == 'lulus' && Auth::user()->hasRole('user'))
                    <a class="btn btn-outline-info btn-sm fa fa-edit change1Button" data-toggle="modal" id="change1Button-{{ $task->id }}" data-target="#change1Modal" data-attr="{{ route('change1.booking', $task->id) }}" title="Mohon Penukaran" > Mohon Penukaran</a>
                    @endif
                    @if (Auth::user()->hasRole('admin'))                    
                    <a class="btn btn-outline-info btn-sm fa fa-info sahBKPButton" data-toggle="modal" id="sahBKPButton-{{ $task->id }}" data-target="#sahBKPModal" data-attr="{{ route('pengesahanBKP.booking', $task->id) }}" title="Pengesahan Tempahan"> Pengesahan Tempahan </a>@else
                    @endif
                    <button class="btn btn-outline-secondary btn-sm dropdown-toggle" type="button" data-toggle="dropdown"><i class="fa fa-download" style="font-size:14px;color:black">&nbsp;Muatturun</i>
                        <span class="caret"></span></button>
                            <ul class="dropdown-menu">
                                <li><a href="{{ route('pdf.booking', $task->id) }}">Cetak PDF</a></li>
                                <li><a href="{{ asset('lampiran/' . $task->lampiran1) }}">{{ $task->lampiran1 }}</a></li>
                            </ul>
                </li>
            </ul>
        </td>
        </tr>
@empty  

        <tr>
            <td></td>
        </tr>    

@endforelse
  </tbody>

</table>

</div>

</x-app-layout>

<!-- Cipta -->
<div class="modal fade ciptaModal" id="ciptaModal" tabindex="-1" role="dialog" aria-labelledby="mediumModalLabel1"
        aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header text-light bg-dark">
                <h5 class="modal-title" id="exampleModalLabel1">Cipta Tempahan</h5>
                </div>
                    <form action="{{ route('store.booking') }}" method="post">
                            @csrf

                    <div class="modal-body" id="ciptaBody">
                        <div>
                            <!-- the result to be displayed apply here -->
                        </div>
                    </div>
                        <div class="modal-footer">
                           <table style="border-collapse: collapse; width: 100%;" border="0">
                                <tbody>
                                    <tr>
                                        <td style="width: 25%; text-align: right;" colspan="2">&nbsp;<button type="submit" class="btn btn-outline-success btn-sm" >Simpan</button></td>
                                        <td style="width: 25%; text-align: left;" colspan="2">&nbsp;<button type="button" class="btn btn-outline-secondary btn-sm" data-dismiss="modal">Tutup</button></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </form>
            </div>
        </div>
    </div>

    <!-- Kemaskini -->
    <div class="modal fade editModal" id="editModal" tabindex="-1" role="dialog" aria-labelledby="mediumModalLabel1"
        aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header text-light bg-dark">
                <h5 class="modal-title" id="exampleModalLabel1">Kemaskini Tempahan</h5>
                </div>
                    <form id = "bookingedit" method="POST" action="{{ route('update.booking') }}" enctype="multipart/form-data">
                            @csrf

                    <div class="modal-body" id="editBody">
                        <div>
                            <!-- the result to be displayed apply here -->
                        </div>
                    </div>
                        <div class="modal-footer">
                           <table style="border-collapse: collapse; width: 100%;" border="0">
                                <tbody>
                                    <tr>
                                        <td style="width: 25%; text-align: right;" colspan="2">&nbsp;<button type="submit" class="btn btn-outline-success btn-sm" >Simpan</button></td>
                                        <td style="width: 25%; text-align: left;" colspan="2">&nbsp;<button type="button" class="btn btn-outline-secondary btn-sm" data-dismiss="modal">Tutup</button></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </form>
            </div>
        </div>
    </div>

    <!-- Pengesahan BKP -->
    <div class="modal fade sahBKPModal" id="sahBKPModal" tabindex="-1" role="dialog" aria-labelledby="mediumModalLabel1"
        aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header text-light bg-dark">
                <h5 class="modal-title" id="exampleModalLabel1">Pengesahan Tempahan</h5>
                </div>
                    <form id = "approveedit" method="POST" action="{{ route('pengesahanBKP2.booking') }}" enctype="multipart/form-data">
                            @csrf

                    <div class="modal-body" id="sahBKPBody">
                        <div>
                            <!-- the result to be displayed apply here -->
                        </div>
                    </div>
                        <div class="modal-footer">
                           <table style="border-collapse: collapse; width: 100%;" border="0">
                                <tbody>
                                    <tr>
                                        <td style="width: 25%; text-align: right;" colspan="2">&nbsp;<button type="submit" class="btn btn-outline-success btn-sm" >Simpan</button></td>
                                        <td style="width: 25%; text-align: left;" colspan="2">&nbsp;<button type="button" class="btn btn-outline-secondary btn-sm" data-dismiss="modal">Tutup</button></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </form>
            </div>
        </div>
    </div>

    <!-- Hilangkan buttton lebih tarikhMula -->
    <script type="text/javascript">
        $(document).ready(function() {
            function TimePeriod() {
                var now = new Date();
                @foreach ($tasks as $task)
                
                    var targetDate = new Date("{{ date('Y-m-d', strtotime($task->tarikhMula)) }}");
                    
                    if (now <= targetDate) {
                        $("#sahBKPButton-{{ $task->id }}").show();
                        $("#editButton-{{ $task->id }}").show();
                        $("#change1Button-{{ $task->id }}").show();
                    } else {
                        $("#sahBKPButton-{{ $task->id }}").hide();
                        $("#editButton-{{ $task->id }}").hide();
                        $("#change1Button-{{ $task->id }}").hide();
                    }
                @endforeach
            }

            // Call the function when the page loads
            TimePeriod();
        });
    </script>
    

    