<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-100 leading-tight">
            {{ __('myPointJPNM') }}
        </h2>
    </x-slot>



<table style="border-collapse: collapse; width: 100%;" border="1">
<tbody>
<tr>
<td style="width: 100%; text-align: center;" colspan="2">

</td>
</tr>
<tr>
<td style="width: 30%; text-align: left; vertical-align: top;" rowspan="2">@include('Booking.calenderBooking')</td>
<td style="width: 70%; vertical-align: top;" rowspan="2"><br>@include('Booking.reportBooking')</td>
</tr>
</tbody>
</table>



</x-app-layout>