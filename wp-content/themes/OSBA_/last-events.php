<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Eventos</title>
    <link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/css/style.css">

</head>
<body>

<div class="container">
    <div class="ev-last-events">
        <h1>Próximos Eventos</h1>
        <div class="ev-custom-grid" id="ev-custom-grid">
            <!-- Eventos serão carregados aqui via AJAX -->
        </div>
        <div class="ev-slider-controls">
            <button class="ev-slider-control" id="prev-events">&lt;</button>
            <button class="ev-slider-control" id="next-events">&gt;</button>
        </div>
        <div class="ev-todos-os-eventos">
            <a href="<?php echo get_post_type_archive_link('evento'); ?>/eventos" class="ev-btn ev-btn-eventos">VER TODOS OS EVENTOS</a>
        </div>
    </div>

    <div class="ev-sidebar">
        <div class="ev-calendar">
            <h3>Calendário</h3>
            <div id="calendar">
                <div id="calendar-header">
                    <span id="calendar-month-year"></span>
                    <div id="calendar-navigation">
                        <span id="prev-month">&lt;</span>
                        <span id="next-month">&gt;</span>
                    </div>
                </div>
                <table id="calendar-table">
                    <thead>
                        <tr>
                            <th>D</th>
                            <th>S</th>
                            <th>T</th>
                            <th>Q</th>
                            <th>Q</th>
                            <th>S</th>
                            <th>S</th>
                        </tr>
                    </thead>
                    <tbody id="calendar-body"></tbody>
                </table>
            </div>
        </div>
        <div class="ev-legend">
            <h3>Legenda</h3>
            <div id="event-legend"></div>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    jQuery(document).ready(function($) {
        let currentPage = 1;
        const eventsPerPage = 4;

        function loadEvents(page) {
            $.ajax({
                url: '<?php echo admin_url('admin-ajax.php'); ?>',
                type: 'POST',
                data: {
                    action: 'load_events',
                    page: page,
                    per_page: eventsPerPage
                },
                success: function(response) {
                    $('#ev-custom-grid').html(response);
                }
            });
        }

        $('#next-events').on('click', function() {
            currentPage++;
            loadEvents(currentPage);
        });

        $('#prev-events').on('click', function() {
            if (currentPage > 1) {
                currentPage--;
                loadEvents(currentPage);
            }
        });

        loadEvents(currentPage); // Load initial events

        // Função para renderizar o calendário
        function renderCalendar(events) {
            const monthNames = ["Janeiro", "Fevereiro", "Março", "Abril", "Maio", "Junho", "Julho", "Agosto", "Setembro", "Outubro", "Novembro", "Dezembro"];
            const dayNames = ["D", "S", "T", "Q", "Q", "S", "S"];

            let today = new Date();
            let currentMonth = today.getMonth();
            let currentYear = today.getFullYear();

            function render(month, year) {
                let firstDay = new Date(year, month, 1).getDay();
                let daysInMonth = 32 - new Date(year, month, 32).getDate();

                let calendarBody = $("#calendar-body");
                calendarBody.empty();

                $("#calendar-month-year").text(`${monthNames[month]} ${year}`);

                let date = 1;
                for (let i = 0; i < 6; i++) {
                    let row = $("<tr></tr>");

                    for (let j = 0; j < 7; j++) {
                        if (i === 0 && j < firstDay) {
                            row.append($("<td></td>"));
                        } else if (date > daysInMonth) {
                            break;
                        } else {
                            let cell = $("<td></td>").attr("data-date", `${year}-${(month + 1).toString().padStart(2, '0')}-${date.toString().padStart(2, '0')}`);
                            let cellText = $("<span></span>").text(date).addClass('event-day');

                            let event = events.find(e => {
                                let eventDate = new Date(e.date);
                                return eventDate.getDate() === date && eventDate.getMonth() === month && eventDate.getFullYear() === year;
                            });
                            if (event) {
                                const eventClass = event.tipo === 'Gratuito' ? 'event-day-free' : 'event-day-paid';
                                cellText.addClass(eventClass);
                            }

                            cell.append(cellText);
                            row.append(cell);
                            date++;
                        }
                    }

                    calendarBody.append(row);
                }

                renderLegend(month, year, events);
            }

            function renderLegend(month, year, events) {
                let legend = $("#event-legend");
                legend.empty();

                let monthEvents = events.filter(event => {
                    let eventDate = new Date(event.date);
                    return eventDate.getMonth() === month && eventDate.getFullYear() === year;
                });

                if (monthEvents.length > 0) {
                    monthEvents.forEach(event => {
                        let color = event.tipo === 'Gratuito' ? '#44996c' : '#0A246A';
                        legend.append(`
                            <div class="ev-legend-item">
                                <div class="color-box" style="background-color: ${color}; flex-shrink: 0;"></div>
                                <span>${event.grupo} - ${event.title}</span>
                            </div>
                        `);
                    });
                } else {
                    legend.append('<p>Nenhum evento encontrado para este mês.</p>');
                }
            }

            render(currentMonth, currentYear);

            $("#prev-month").on("click", function() {
                if (currentMonth === 0) {
                    currentYear--;
                    currentMonth = 11;
                } else {
                    currentMonth--;
                }
                render(currentMonth, currentYear);
            });

            $("#next-month").on("click", function() {
                if (currentMonth === 11) {
                    currentYear++;
                    currentMonth = 0;
                } else {
                    currentMonth++;
                }
                render(currentMonth, currentYear);
            });
        }

        // Load initial events and calendar data
        $.ajax({
            url: '<?php echo admin_url('admin-ajax.php'); ?>',
            type: 'POST',
            data: {
                action: 'load_initial_data'
            },
            success: function(response) {
                const data = JSON.parse(response);
                loadEvents(currentPage);
                renderCalendar(data.events);
            }
        });
    });
</script>

</body>
</html>
