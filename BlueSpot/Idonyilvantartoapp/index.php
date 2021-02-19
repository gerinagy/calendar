<?php
session_start();

include("./connection/connection.php");
include("functions.php");

$user_data = check_login($con);

?>



<!DOCTYPE html>
<html>

<head>
    <title>Idonyilvantarto Webalkalmazas</title>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.4.0/fullcalendar.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.0.0-alpha.6/css/bootstrap.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" />
    <link rel="stylesheet" href="./css/style.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.18.1/moment.min.js"></script>
    <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.4.0/fullcalendar.min.js"></script> -->
    <script src="js/fullcalendar.js"></script>

    <script>
        $(document).ready(function() {
            var calendar = $('#calendar').fullCalendar({
                editable: true,
                header: {
                    left: 'prev,next today',
                    center: 'title',
                    right: 'month,agendaWeek,agendaDay'
                },
                events: './calevents/load.php',
                selectable: true,
                selectHelper: true,
                select: function(start, end, allDay) {
                    var title = prompt("Enter Event Title");

                    if (title) {
                        var start = $.fullCalendar.formatDate(start, "Y-MM-DD HH:mm");
                        var end = $.fullCalendar.formatDate(end, "Y-MM-DD HH:mm");
                        var hours = prompt("Enter the hours");
                        $.ajax({
                            url: "./calevents/insert.php",
                            type: "POST",
                            data: {
                                title: title,
                                hours: hours,
                                start: start,
                                end: end
                            },
                            success: function() {
                                calendar.fullCalendar('refetchEvents');
                                alert("Added Successfully");
                            }
                        })
                        console.log(title, hours, start, end)
                        $.ajax(
                            calendar.fullCalendar('refetchEvents')
                        )

                    }
                },





                editable: true,
                s: function(event) {
                    var start = $.fullCalendar.formatDate(event.start, "Y-MM-DD HH:mm");
                    var end = $.fullCalendar.formatDate(event.end, "Y-MM-DD HH:mm");
                    var title = event.title;
                    var id = event.id;
                    $.ajax({
                        url: "./calevents/update.php",
                        type: "POST",
                        data: {
                            title: title,
                            hours: hours,
                            start: start,
                            end: end,
                            id: id
                        },
                        success: function() {
                            calendar.fullCalendar('refetchEvents');
                            alert('Event Update');
                        }
                    })
                },

                eventDrop: function(event) {
                    var start = $.fullCalendar.formatDate(event.start, "Y-MM-DD HH:mm");
                    var end = $.fullCalendar.formatDate(event.end, "Y-MM-DD HH:mm");
                    var title = event.title;
                    var id = event.id;
                    $.ajax({
                        url: "./calevents/update.php",
                        type: "POST",
                        data: {
                            title: title,
                            hours: hours,
                            start: start,
                            end: end,
                            id: id
                        },
                        success: function() {
                            calendar.fullCalendar('refetchEvents');
                            alert("Event Updated");
                        }
                    });
                },

                eventClick: function(event) {
                    if (confirm("Are you sure you want to remove it?")) {
                        var id = event.id;
                        $.ajax({
                            url: "./calevents/delete.php",
                            type: "POST",
                            data: {
                                id: id
                            },
                            success: function() {
                                calendar.fullCalendar('refetchEvents');
                                alert("Event Removed");
                            }
                        })
                    }
                },

            });
        });
    </script>


    <script>
        $(document).ready(function() {

            $('#newEventModal').submit(function(e) {
                var end = moment(event.end).format('Y-MM-DD HH:mm:ss');

                var formData = {
                    'start': $('input[name=start]').val(),
                    'end': $('input[name=start]').val(),
                    'hours': $('input[name=hours]').val(),
                    'title': $('input[name=title]').val()
                };

                $.ajax({
                    url: "./calevents/insert.php",
                    type: "POST",
                    data: formData,
                    success: function() {
                        alert('form was submitted');
                    }

                });

            });

        });
    </script>






</head>

<body>

    <a href="logout.php">
        <h3>Logout</h3>
    </a>

    <br>
    <h2 style="text-align: center;">Hello, <?php echo $user_data['user_name']; ?></h2 <section>
    <button type="submit" id="newEvent">
        <h1>Új Esemény</h1>
    </button>
    <div class="modal-container"></div>
    <form action="" id="newEventModal" class="newEventModal">
        <h1>Uj esemeny letrehozasa</h1>
        <div class="modal-div">
            <button class="close-btn">
                <i class="fa fa-close" style="font-size: 24px; padding: 10px"></i>
            </button>
        </div>
        <div class="modal-div">
            <h2>Datum</h2>
            <input type="date" name="start" id="start" required />
        </div>
        <div class="modal-div">
            <h2>Ora</h2>
            <input type="number" name="hours" id="hours" required />
        </div>
        <div>
            <h2>Megjegyzes</h2>
            <input type="text" name="title" id="title" required />
        </div>
        <div class="modal-bottom-btn">
            <button id='cancel' class="padding-5">Megsem</button>
            <input type="submit" value="Mentes" name="submit" class="padding-5">
        </div>
    </form>
    </section>




    <br />
    <h2 align="center"><a href="#">Idonyilvantarto Webalkalmazas</a></h2>
    <br />
    <div class="container">
        <div id="calendar"></div>
    </div>
    <div class="total-hours" style="position: absolute; top: 10px; right: 5px; ">
        <h1>Total oraszam</h1>
        <h3>

            <?php

            require_once('./connection/dbConfig.php');

            // $user_id = $user_data['user_id'];


            foreach ($connect->query('SELECT YEAR(start_event),MONTH(start_event),SUM(hours) 
FROM events GROUP BY YEAR(start_event), MONTH(start_event)
order by year(start_event),MONTH(start_event)') as $row) {
                echo "<table>";
                echo "<td>" . $row['YEAR(start_event)'] . "</td>";
                echo "<td> / </td>";
                echo "<td>" . $row['MONTH(start_event)'] . "</td>";
                echo "<td> -  </td>";
                echo "<td>" . $row['SUM(hours)'] . "</td>";
                echo "<td>  óra </td>";
                echo "</table>";
            }

            ?>
        </h3>
    </div>
    <script src="./js/main.js"></script>
</body>

</html>