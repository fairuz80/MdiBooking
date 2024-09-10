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

  <!-- Daftar modal -->
  <a class="btn btn-outline-primary btn-sm text-light float-right mb-3" data-toggle="modal" id="createButton" data-target="#createModal"
      data-attr="{{ route('create.User') }}" title="Pendaftaran Pengguna"><i class="fa fa-file-o" style="font-size:14px;color:black">  Pendaftaran Pengguna</i>
  </a>

  <a class="btn btn-outline-success text-light float-right btn-sm" data-toggle="modal" id="excelButton" data-target="#excelModal"
    data-attr="{{ route('excel.User') }}" title="Muat Naik"><i class="fa fa-file-o" style="font-size:14px;color:black">&nbsp;Muat Naik</i>
</a>

<!-- <a class="btn btn-primary float-right mb-3" href="">filter date</a> -->

<table  class="table table-bordered table-striped table-sm">
  <thead class="thead-dark">
    <tr>
      
      <th scope="col">Bil</th>
      <th scope="col">Nama</th>
      <th scope="col">Email</th>
      <th scope="col">Jawatan</th>
      <th scope="col">Bahagian</th>
      <th scope="col">Dicipta</th>
      <th scope="col"></th>
      
    </tr>
  </thead>
  @foreach ( $users as $user )
  <tbody>
  <tr>
  <td>{{ ++$i }} </td>
  <td><a class="btn btn-sm" data-toggle="modal" id="biodataButton" data-target="#biodataModal" data-attr="{{ route('edit.Bio', $user->id) }}" role="button" aria-pressed="true">{{$user->name}}</a></td>
  <td>{{$user->email}} </td>
  <td>{{$user->jawatan}} </td>
  <td>{{$user->bahagian}} </td>
  <td>{{$user->created_at}}  </td>
  <td> 
  
    
  <a class="btn btn-warning btn-sm" data-toggle="modal" id="passwordButton" data-target="#passwordModal" data-attr="{{ route('edit.Pass', $user->id) }}" role="button" aria-pressed="true"><i class="fa fa-edit" style="font-size:18px;color:black"></i></a> |
  <a href="{{ route('delete.User', $user->id) }}" class="btn btn-danger btn-sm " role="button" aria-pressed="true"><i class="fa fa-trash" style="font-size:18px;color:black"></i></a>
  </td>

 
    </tr>
        <!--<tr>
            <td><hr style="width:100%;text-align:left;margin-left:0"></td>
        </tr>    -->
     
      
 

@endforeach
  </tbody>


</table> 

@if ($users->total())
<div class="clearfix">
    <span style="display: inline-block; vertical-align: middle; line-height: normal;">Papar {{ ($users->currentPage() * $users->perpage()) - ($users->perpage() - 1) }} hingga {{ ($users->hasMorePages()) ? ($users->currentPage() * $users->perpage()) : $users->total() }} daripada {{ $users->total() }} rekod pengguna </span>
    {{ $users->links() }}
</div>
@endif

</div>

</x-app-layout>

<!-- create -->
<div class="modal fade createModal" id="createModal" tabindex="-1" role="dialog" aria-labelledby="mediumModalLabel1"
        aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header text-light bg-dark">
                <h5 class="modal-title" id="exampleModalLabel1">Daftar Pengguna</h5>
                </div>
                    <form action="{{ route('store.User') }}" method="post">
                            @csrf

                    <div class="modal-body" id="createBody">
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

    <!-- edit bio -->
    <div class="modal fade biodataModal" id="biodataModal" tabindex="-1" role="dialog" aria-labelledby="mediumModalLabel1"
            aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header text-light bg-dark">
                    <h5 class="modal-title" id="exampleModalLabel1">Kemaskini Maklumat Pengguna</h5>
                    </div>
                        <form action="{{ route('update.Bio') }}" method="post">
                                @csrf

                        <div class="modal-body" id="biodataBody">
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

    <!-- edit pass -->
    <div class="modal fade passwordModal" id="passwordModal" tabindex="-1" role="dialog" aria-labelledby="mediumModalLabel1"
            aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header text-light bg-dark">
                    <h5 class="modal-title" id="exampleModalLabel1">Kemaskini Katalaluan Pengguna</h5>
                    </div>
                        <form action="{{ route('update.Pass') }}" method="post">
                                @csrf

                        <div class="modal-body" id="passwordBody">
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

    <!-- import -->
    <div class="modal fade excelModal" id="excelModal" tabindex="-1" role="dialog" aria-labelledby="mediumModalLabel1"
            aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header text-light bg-dark">
                    <h5 class="modal-title" id="exampleModalLabel1">Muat Naik</h5>
                    </div>
                        <form action="{{ route('excel.Save') }}" method="post" enctype="multipart/form-data">
                                @csrf

                        <div class="modal-body" id="excelBody">
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