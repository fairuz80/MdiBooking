
<div id='calendar'></div><!-- FullCalendar CSS -->

    <link href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.10.2/fullcalendar.min.css" rel="stylesheet" />
    <!-- jQuery -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <!-- Moment.js -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"></script>
    <!-- FullCalendar JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.10.2/fullcalendar.min.js"></script>

@verbatim
<script>
        $(document).ready(function() {
            console.log("Document is ready");

            // Fetch the bookings data from the server
            $.ajax({
                url: '/calenderEvent',
                method: 'GET',
                success: function(data) {
                    console.log("Data fetched successfully:", data);
                    // Convert the data to FullCalendar events format
                    var events = data.map(function(booking) {
                        var color;
                        if (booking.ext2 === 'Pagi') {
                            color = '#ddff99'; 
                        } else if (booking.ext2 === 'Petang') {
                            color = '#ffbf80'; 
                        }
                        else if (booking.ext2 === 'Pagi Dan Petang') {
                            color = '#ADD8E6'; 
                        }
                        return {
                            title: booking.mesyuarat,
                            start: booking.tarikhMula,
                            backgroundColor: color,
                            borderColor: color
                        };
                    });

                    console.log("Events array:", events);

                    // Initialize the FullCalendar with the events
                    $('#calendar').fullCalendar({
                        events: events,
                        dayClick: function(date, jsEvent, view) {
                            var tarikhMula = date.format('YYYY-MM-DD');
                            // Redirect to the search URL with the selected date as start_date and end_date
                            window.location.href = "/Booking/reportBooking?start_dateA=" + tarikhMula + "&end_dateB=" + tarikhMula;
                        }
                    });
                },
                error: function(xhr, status, error) {
                    console.error('Failed to fetch bookings:', error);
                }
            });
        });
</script>
@endverbatim

