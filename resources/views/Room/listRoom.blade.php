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

    <div class="container">

    @if (Auth::user()->hasRole('admin'))
    <button class="btn btn-outline-secondary btn-sm text-light float-right mb-3" data-toggle="modal" data-target="#carianTarikhModal" >
        <i class="fa fa-search-o" style="font-size:14px;color:black">Statistik Penggunaan</i>
    </button>&nbsp;
    @else
    @endif
  
    <!-- Daftar modal -->
    <a class="btn btn-outline-primary btn-sm text-light float-right mb-3" data-toggle="modal" id="createRoomButton" data-target="#createRoomModal"
        data-attr="{{ route('create.Room') }}" title="Cipta Bilik"><i class="fa fa-file-o" style="font-size:14px;color:black">  Cipta Bilik</i>
    </a>
<!-- <a class="btn btn-primary float-right mb-3" href="">filter date</a> -->

<table  class="table table-bordered table-striped table-sm">
  <thead class="thead-dark">
    <tr>
      
      <th scope="col">Bil</th>
      <th scope="col">Nama Bilik Mesyuarat</th>
      <th scope="col">Dicipta / Kemaskini</th>
      <th scope="col"></th>
      
    </tr>
  </thead>
  @foreach ( $rooms as $room )
  <tbody>
  <tr>
  <td>{{ ++$i }} </td>
  <td>{{$room->bilik}}</td>
  <td>{{$room->updated_at}}  </td>
  <td> 
  <a class="btn btn-secondary btn-sm" data-toggle="modal" id="editRoomButton" data-target="#editRoomModal" data-attr="{{ route('edit.Room', $room->id) }}" role="button" aria-pressed="true"><i class="fa fa-edit" style="font-size:18px;color:black"></i></a> |
  <a href="{{ route('delete.Room', $room->id) }}" class="btn btn-danger btn-sm " role="button" aria-pressed="true"><i class="fa fa-trash" style="font-size:18px;color:black"></i></a>
  </td>

 
    </tr>
        <!--<tr>
            <td><hr style="width:100%;text-align:left;margin-left:0"></td>
        </tr>    -->
     
      
 

@endforeach
</tbody>

</table> 

@if ($rooms->total())
<div class="clearfix">
    <span style="display: inline-block; vertical-align: middle; line-height: normal;">Papar {{ ($rooms->currentPage() * $rooms->perpage()) - ($rooms->perpage() - 1) }} hingga {{ ($rooms->hasMorePages()) ? ($rooms->currentPage() * $rooms->perpage()) : $rooms->total() }} daripada {{ $rooms->total() }} rekod bilik </span>
    {{ $rooms->links() }}
</div>
@endif

</div>

</x-app-layout>

    <!-- Cipta Bilik-->
    <div class="modal fade createRoomModal" id="createRoomModal" tabindex="-1" role="dialog" aria-labelledby="mediumModalLabel1"
        aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header text-light bg-dark">
                <h5 class="modal-title" id="exampleModalLabel1">Cipta Bilik</h5>
                </div>
                    <form action="{{ route('store.Room') }}" method="post" enctype="multipart/form-data" >
                            @csrf

                    <div class="modal-body" id="createRoomBody">
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

    <!-- Kemaskini Bilik -->
    <div class="modal fade editRoomModal" id="editRoomModal" tabindex="-1" role="dialog" aria-labelledby="mediumModalLabel1"
    aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header text-light bg-dark">
            <h5 class="modal-title" id="exampleModalLabel1">Kemaskini Bilik</h5>
            </div>
                <form id = "bookingeditRoom" method="POST" action="{{ route('update.Room') }}" enctype="multipart/form-data" >
                        @csrf

                <div class="modal-body" id="editRoomBody">
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

    <!-- Carian Tarikh -->
    <div class="modal fade" id="carianTarikhModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Statistik</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form class="d-flex float-center mb-3" type="get" action="{{ route('statistik.Room') }}">
                <table style="width: 100%; border-collapse: collapse;" border="0">
                    <tbody>
                        <tr>
                            <td style="width: 50%;">&nbsp;<input type="date" name="start_date" value="" class="form-control" title="Tarikh Mula" style="height:31px" required></td>
                            <td style="width: 50%;">&nbsp;<input type="date" name="end_date" value="" class="form-control" title="Tarikh Akhir" style="height:31px" required></td>
                        </tr>
                        <tr>
                            <td style="width: 50%;" colspan="2">&nbsp;
                            <select name="lokasiBilik" id="lokasiBilik" class="form-control" required>
                                @foreach ($rooms as $room)
                                    <option value="{{ $room->bilik }}">{{ $room->bilik }}</option>
                                @endforeach
                            </select>
                            </td>
                        </tr>
                    </tbody>
                </table>
                </div>
            <div class="modal-footer">
                <button class="btn btn-outline-success btn-sm float-center mb-3" type="submit">Carian</button>
            </div>
            </form>
            
            </div>
        </div>
    </div>