<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css2?family=Raleway:wght@400;700&display=swap" rel="stylesheet">
    <title>Eventos</title>
    <link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/css/style.css">
    <style>
        .ev-calendar {
            border: 0;
            border-radius: 8px;
            background-color: #fff;
            box-shadow: -4px 0 6px -2px rgba(0,0,0,.2),4px 0 6px -2px rgba(0,0,0,.2),0 4px 6px -2px rgba(0,0,0,.2);
            height: auto;
            width: 342px;
            margin-top: 85px;
            margin-bottom: 25px;
        }

        .event-mark {
            padding: 5px;
            display: flex;
            justify-content: center;
            align-items: center;
            width: 30px;
            height: 30px;
            text-align: center;
            color: #fff;  /* Cor das datas marcadas */
            /*border-radius: 50%; !* marcações como círculos *!*/
        }

    </style>
</head>
<body>

<div class="container">
    <div class="ev-last-events">
        <p id="ev-last-events">Próximos Eventos</p>
        <div class="ev-custom-grid" id="ev-custom-grid">
            <!-- Eventos serão carregados aqui via AJAX -->
        </div>
        <div class="ev-slider-controls">
            <button class="ev-slider-control" id="prev-events">&lt;</button>
            <button class="ev-slider-control" id="next-events">&gt;</button>
        </div>
        <div class="ev-todos-os-eventos">
            <a href="<?php echo esc_url( home_url( '/' ) ); ?>eventos" class="ev-btn ev-btn-eventos">VER TODOS OS EVENTOS</a>
        </div>
    </div>

    <div class="ev-third-column">
        <div class="ev-calendar">
            <div id="calendar">
                <div id="calendar-header">
                    <div id="calendar-month-year">
                        <span id="calendar-month"></span>
                        <span id="calendar-year"></span>
                    </div>
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

        function toggleEventButtons(button) {
            // Remove a classe 'active' de ambos os botões
            $('#prev-events, #next-events').removeClass('active');
            // Adiciona a classe 'active' ao botão clicado
            $(button).addClass('active');

            // Alterna as cores dos botões
            if (button.id === "prev-events") {
                $("#prev-events").css("background-color", "#FFF4DA");
                $("#next-events").css("background-color", "white");
            } else {
                $("#next-events").css("background-color", "#FFF4DA");
                $("#prev-events").css("background-color", "white");
            }
        }

        $('#next-events').on('click', function() {
            currentPage++;
            loadEvents(currentPage);
            toggleEventButtons(this);
        });

        $('#prev-events').on('click', function() {
            if (currentPage > 1) {
                currentPage--;
                loadEvents(currentPage);
                toggleEventButtons(this);
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

                // Atualizando mês e ano separadamente
                $("#calendar-month").text(monthNames[month]);
                $("#calendar-year").text(year);

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
                                console.log('Grupo de eventos:', event.grupo); // Verifique o valor do grupo aqui
                                let color = getColorByGroup(event.grupo);
                                cellText.css("background-color", color);
                                cellText.css({
                                    'padding': '5px',
                                    'display': 'flex',
                                    'justify-content': 'center',
                                    'align-items': 'center',
                                    'width': '30px',
                                    'height': '30px',
                                    'text-align': 'center',
                                    'color': '#fff'
                                });

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
                    let usedGroups = {};

                    monthEvents.forEach(event => {
                        let grupo = event.grupo || "Série Padrão"; // Se grupo for null, define como "Série Padrão"

                        // Se o grupo for "Série M. I.", altere para "Série Manuel Inácio"
                        if (grupo === "Série M. I.") {
                            grupo = "Série Manuel Inácio";
                        }

                        let color = getColorByGroup(grupo);

                        if (!usedGroups[grupo]) {
                            legend.append(`
                    <div class="ev-legend-item">
                        <div class="color-box" style="background-color: ${color}; flex-shrink: 0;"></div>
                        <span>${grupo}</span>
                    </div>
                `);
                            usedGroups[grupo] = true;
                        }
                    });
                } else {
                    legend.append('<p>Nenhum evento encontrado para este mês.</p>');
                }
            }


            // Função para obter a cor com base no grupo de eventos
            function getColorByGroup(grupo) {
                if (!grupo) {
                    return '#003366'; // Cor padrão para grupos nulos ou indefinidos
                }

                switch (grupo) {
                    case 'Série Manuel Inácio':
                        return '#eda821';
                    case 'Série M. I.': // Certifique-se de que os valores estão correspondendo aos do JSON
                        return '#eda821';
                    case 'Viagens Sinfônicas':
                        return '#761984';
                    case 'Série Carybé':
                        return '#d87331';
                    case 'OSBA na Estrada':
                        return '#8e5a45';
                    case 'Cameratas':
                        return '#195584';
                    case 'OSBA POP':
                        return '#106433';
                    case 'Outros Concertos':
                        return '#595959';
                    case 'CineConcerto':
                        return '#000000';
                    case 'OSBAcuri':
                        return '#f57ca4';
                    case 'Verão da OSBA':
                        return '#ce3d2a';
                    default:
                        return '#003366'; // Cor padrão para qualquer outro caso
                }
            }

            render(currentMonth, currentYear);

            function toggleActiveButton(button) {
                // Remove a classe 'active' de ambos os botões
                $('#prev-month, #next-month').removeClass('active');
                // Adiciona a classe 'active' ao botão clicado
                $(button).addClass('active');

                // Alterna as cores dos botões
                if (button.id === "prev-month") {
                    $("#prev-month").css("background-color", "#FFF4DA");
                    $("#next-month").css("background-color", "white");
                } else {
                    $("#next-month").css("background-color", "#FFF4DA");
                    $("#prev-month").css("background-color", "white");
                }
            }

            $("#prev-month").on("click", function() {
                toggleActiveButton(this);

                if (currentMonth === 0) {
                    currentYear--;
                    currentMonth = 11;
                } else {
                    currentMonth--;
                }
                render(currentMonth, currentYear);
            });

            $("#next-month").on("click", function() {
                toggleActiveButton(this);

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
                console.log(data.events); // Verifique se os grupos estão sendo enviados corretamente
                renderCalendar(data.events);
            }
        });
    });

</script>

</body>
</html>
