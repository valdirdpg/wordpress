<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css2?family=Raleway:wght@400;700&display=swap" rel="stylesheet">
    <style>
        .ev-btn-outline-secondary {
            background-color: #fcf6e8;
            color: #333;
            border: 1px solid #ddd;
            padding: 2px 16px 2px 16px;
            font-family: Raleway;
            font-weight: normal;
            width: 116px;
            height: 29px;
            box-shadow: 5px 5px 5px 0px rgba(0, 0, 0, 0.3);
            font-size: 14px;
            text-align: center;
        }

        .container {
            display: flex;
            gap: 20px;
            max-width: 1140px;
            margin: 0 auto;
        }

        .ev-main-content {
            flex: 2;
            display: flex;
            flex-direction: column;
            gap: 20px;
            overflow-y: auto; /* Permite rolagem */
            max-height: 600px; /* Altura fixa para a área de eventos */
            scrollbar-width: thin; /* Firefox */
            scrollbar-color: #888 #e0e0e0; /* Firefox */
        }

        .ev-calendar {
            margin-top: auto;
        }


        /* Estilo da barra de rolagem no Webkit (Chrome, Safari) */
        .ev-main-content::-webkit-scrollbar {
            width: 12px;
        }

        .ev-main-content::-webkit-scrollbar-track {
            background: #e0e0e0; /* Cor do trilho */
            border-radius: 6px;
        }

        .ev-main-content::-webkit-scrollbar-thumb {
            background-color: #888; /* Cor do "thumb" da barra */
            border-radius: 6px;
            border: 3px solid #e0e0e0; /* Cria um efeito de trilho ao redor */
        }

        .ev-calendar-column {
            flex: 1;
            display: flex;
            flex-direction: column;
            gap: 20px;
            position: sticky;
            top: 0; /* Mantém o calendário fixo ao rolar */
        }

        .camaratas-section {
            background-color: #f9f5e6;
            padding: 15px;
            border-radius: 8px;
            font-family: 'Raleway', sans-serif; /* Caso você queira usar Raleway aqui */
        }

        .camarata {
            font-family: 'Nocturno Display Bold', serif; /* Fonte personalizada */
            font-size: 24px;
        }

        .camarata-item {
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 10px 0;
            border-bottom: 1px solid #ddd;
            font-family: Raleway;
        }

        .camarata-date, .day, .camarata-time {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            color: #fff;
            padding: 10px;
            border-radius: 0px;
            width: 75px;
            /*font-size: 16px;*/
            font-family: 'Nocturno Display Bold', serif; /* Fonte personalizada */
        }

        .day {
            background-color:  #0A246A;
            height: 24px;
            font-size: 16px;
        }

        .camarata-time {
            background-color: #b6b6b6;
            height: 22px;
            font-size: 16px;
        }

        .camarata-title {
            font-weight: bold;
            font-size: 16px;
            margin-bottom: 5px;
            font-weight: 900;
             /* Fonte personalizada */
        }

        .camarata-location {
            font-size: 16px;
            color: #666;
            font-family: 'Raleway'; /* Mantenha Raleway aqui se for o desejado */
        }

    </style>
</head>
<body>

<?php
/*
Template Name: EVENTOS
*/
get_header();
?>

<div id="mainHeader" style="width: 2000px;"></div>

<div class="page-header">
    <div class="ev-title-container">
        <p class="title page-title" id="ev-page-title">Eventos <?php echo date('Y'); ?></p>
        <div class="ev-btn-group">
            <button id="prev-year" class="ev-btn-year circular-btn">&lt;</button>
            <button id="next-year" class="ev-btn-year circular-btn">&gt;</button>
        </div>
    </div>
</div>

<!-- PAGE CONTENT -->

<div class="container-fluid">
    <div class="container">
        <div class="ev-main-content" id="ev-last-events">
            <!-- Eventos serão carregados aqui -->
            <?php load_events_year(date('Y')); ?>
        </div>

        <div class="ev-calendar-column">
            <div class="ev-calendar">
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
                <div id="event-legend"></div>
            </div>

            <!-- Camaratas Section -->
            <div class="camaratas-section">
                <p class="camarata">Camaratas</p>
                <?php
                $camarata = get_posts(array(
                    'post_type' => 'camarata',
                    'posts_per_page' => -1,
                ));

                if ($camarata) {
                    foreach ($camarata as $camaratas) {
                        $titulo = get_field('titulo', $camaratas->ID);
                        $local = get_field('local', $camaratas->ID);
                        $date = get_field('data', $camaratas->ID);
                        $horario = get_field('horario', $camaratas->ID);
//                        $date = new DateTime($data);
                        ?>
                        <div class="camarata-item">
                            <div class="camarata-date">
                                <span class="day"><?php echo date('d/m', strtotime(get_field('data'))); ?></span>
                                <span class="camarata-time"><?php echo esc_html($horario); ?></span>
                            </div>
                            <div class="camarata-details">
                                <div class="camarata-title"><?php echo esc_html($titulo); ?></div>
                                <div class="camarata-location">Local: <?php echo esc_html($local); ?></div>

                            </div>
                        </div>
                        <?php
                    }
                } else {
                    echo '<p>Nenhuma camarata encontrada.</p>';
                }
                ?>
            </div>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    jQuery(document).ready(function($) {
        console.log('Script carregado e funcionando');
        let currentPage = 1;
        let currentYear = new Date().getFullYear();
        const eventsPerPage = -1;

        function loadEvents(page, year) {
            $.ajax({
                url: '<?php echo admin_url('admin-ajax.php'); ?>',
                type: 'POST',
                data: {
                    action: 'load_events_year',
                    year: year,
                    page: page
                },
                success: function(response) {
                    $('#ev-last-events').html(response); // Atualiza a área com os novos eventos
                },
                error: function(xhr, status, error) {
                    console.error("Erro ao carregar eventos: ", status, error);
                }
            });
        }

        function updateYearTitle(year) {
            $('#ev-page-title').text(`Eventos ${year}`);
        }

        $('#next-events').on('click', function() {
            currentPage++;
            loadEvents(currentPage, currentYear);
        });

        $('#prev-events').on('click', function() {
            if (currentPage > 1) {
                currentPage--;
                loadEvents(currentPage, currentYear);
            }
        });

        $('#next-year').on('click', function() {
            toggleActiveButton(this, 'year');

            currentYear++;
            updateYearTitle(currentYear);
            loadEvents(1, currentYear);
        });

        $('#prev-year').on('click', function() {
            toggleActiveButton(this, 'year');

            currentYear--;
            updateYearTitle(currentYear);
            loadEvents(1, currentYear);
        });

        loadEvents(currentPage, currentYear); // Load initial events

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
                                <div class="color-box" style="background-color: ${color};flex-shrink: 0;"></div>
                                <span>${event.title}</span>
                            </div>
                        `);
                    });
                } else {
                    legend.append('<p>Nenhum evento encontrado para este mês.</p>');
                }
            }

            render(currentMonth, currentYear);

            $("#prev-month").on("click", function() {
                toggleActiveButton(this, 'month');

                if (currentMonth === 0) {
                    currentYear--;
                    currentMonth = 11;
                } else {
                    currentMonth--;
                }
                render(currentMonth, currentYear);
            });

            $("#next-month").on("click", function() {
                toggleActiveButton(this, 'month');

                if (currentMonth === 11) {
                    currentYear++;
                    currentMonth = 0;
                } else {
                    currentMonth++;
                }
                render(currentMonth, currentYear);
            });
        }

        // Função para alternar os botões entre ativo e inativo
        function toggleActiveButton(button, group) {
            // Remove a classe 'active' de ambos os botões do grupo especificado
            $(`#prev-${group}, #next-${group}`).removeClass('active');
            // Adiciona a classe 'active' ao botão clicado
            $(button).addClass('active');

            // Alterna as cores dos botões
            if (button.id === `prev-${group}`) {
                $(`#prev-${group}`).css("background-color", "#FFF4DA");
                $(`#next-${group}`).css("background-color", "white");
            } else {
                $(`#next-${group}`).css("background-color", "#FFF4DA");
                $(`#prev-${group}`).css("background-color", "white");
            }
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
                loadEvents(currentPage, currentYear);
                renderCalendar(data.events);

            }
        });
    });
</script>

<!-- / PAGE CONTENT -->

<?php get_footer(); ?>
</body>
</html>
