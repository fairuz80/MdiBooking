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
    
    <!-- Carian -->
    @if (Auth::user()->hasRole('admin'))
    <button class="btn btn-outline-secondary btn-sm text-light float-right mb-3" data-toggle="modal" data-target="#carianTarikhModal">
        <i class="fa fa-search-o" style="font-size:14px;color:black">Statistik Penggunaan</i>
    </button>&nbsp;
    @else
    @endif
    
</div>

<div class="container">
    
<br><h3>Carta Penggunaan Tempahan Mengikut Bulan / Tahun : {{ $selectedRoom->bilik }}</h3>

    @if($tasks->isEmpty())
        <p>TIADA TEMPAHAN </p>
        @else
        <canvas id="bookingChart" width="300" height="100"></canvas>

        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
        <script>
            document.addEventListener('DOMContentLoaded', function () {
                const ctx = document.getElementById('bookingChart').getContext('2d');
                const bookingChart = new Chart(ctx, {
                    type: 'bar',
                    data: {
                        labels: {!! json_encode($chartData->keys()) !!},
                        datasets: [{
                            label: 'Bilangan Tempahan',
                            data: {!! json_encode($chartData->values()) !!},
                            backgroundColor: 'rgba(54, 162, 235, 0.2)',
                            borderColor: 'rgba(54, 162, 235, 1)',
                            borderWidth: 1
                        }]
                    },
                    options: {
                        scales: {
                            y: {
                                beginAtZero: true
                            }
                        }
                    }
                });
            });
        </script>
    @endif

    

</div>

</x-app-layout>

<!-- Carian Tarikh -->
<div class="modal fade" id="carianTarikhModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Carian Tarikh</h5>
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