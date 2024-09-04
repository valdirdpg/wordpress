<?php
get_header();
$template_directory_uri = get_template_directory_uri();
?>
<?php while (have_posts()) : the_post(); ?>
<?php
$descricao = get_field('descricao');
$local = get_field('local');
$tipo = get_field('tipo');
$inicio = get_field('inicio');
$final = get_field('final');
$ingresso_inteira = get_field('ingresso_inteira');
$ingresso_meia = get_field('ingresso_meia');
$link = get_field('link');
$unixtimestamp = strtotime(get_field('data'));
$grupo = get_field('grupos');

// Função para ajustar a cor em PHP
function adjustColor($hex, $steps) {
    $steps = max(-255, min(255, $steps));
    $hex = str_replace('#', '', $hex);

    $r = hexdec(substr($hex, 0, 2));
    $g = hexdec(substr($hex, 2, 2));
    $b = hexdec(substr($hex, 4, 2));

    $r = max(0, min(255, $r + $steps));
    $g = max(0, min(255, $g + $steps));
    $b = max(0, min(255, $b + $steps));

    return '#' . str_pad(dechex($r), 2, '0', STR_PAD_LEFT) .
        str_pad(dechex($g), 2, '0', STR_PAD_LEFT) .
        str_pad(dechex($b), 2, '0', STR_PAD_LEFT);
}

// Determina a cor base com base no grupo de eventos
switch ($grupo) {
    case 'Serie Manuel Inacio':
    case 'Série M. I.':
        $banner_color = '#eda821';
        break;
    case 'Viagens Sinfônicas':
        $banner_color = '#761984';
        break;
    case 'Série Carybé':
        $banner_color = '#d87331';
        break;
    case 'OSBA na Estrada':
        $banner_color = '#8e5a45';
        break;
    case 'Cameratas':
        $banner_color = '#195584';
        break;
    case 'OSBA POP':
        $banner_color = '#106433';
        break;
    case 'Outros Concertos':
        $banner_color = '#595959';
        break;
    case 'CineConcerto':
        $banner_color = '#000000';
        break;
    case 'OSBAcuri':
        $banner_color = '#f57ca4';
        break;
    case 'Verão da OSBA':
        $banner_color = '#ce3d2a';
        break;
    default:
        $banner_color = '#003366'; // Cor padrão
        break;
}

// Ajusta as cores para versões mais claras e escuras
$lighter_color = adjustColor($banner_color, 40);
$darker_color = adjustColor($banner_color, -40);
?>

<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css2?family=Raleway:wght@400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/css/single-evento.css">
    <title>Descrição do Evento</title>
    <style>
        .ev-day-month, .ev-weekday-block, .ev-time-block {
            font-family: "Nocturno Display Bold";
            display: flex;
            justify-content: center;
            align-items: center;
            color: white;
        }
    </style>
</head>
<body>

<div id="mainHeader" style="width: 1940px;"></div>
<main id='mainContent'>
    <!-- Imagem de destaque do evento e banner ocupando toda a largura -->
    <div class="event-header">
        <div class="event-header-img">
            <?php the_post_thumbnail('full'); ?>
            <!-- Texto "Eventos" sobre a imagem -->
            <div class="event-title-overlay">Eventos</div>
        </div>
    </div>

    <div class="page page-single page-event">
        <!-- Container com duas colunas -->
        <div class="event-container">

            <!-- Primeira Coluna: Conteúdo do Evento -->
            <div class="event-content-column">

                <div class="ev-grid-item">
                    <div class="ev-item-left">
                        <div class="ev-date">
                            <div class="ev-day-month" style="background-color: <?php echo esc_attr($banner_color); ?>;">
                                <span class="ev-day"><?php echo date('d', strtotime(get_field('data'))); ?></span>
                                <span class="ev-month">/<?php echo date('m', strtotime(get_field('data'))); ?></span>
                            </div>
                            <div class="ev-weekday-time">
                                <div class="ev-weekday-block" style="background-color: <?php echo esc_attr($lighter_color); ?>;"><?php echo date_i18n('D', strtotime(get_field('data'))); ?></div>
                                <div class="ev-time-block" style="background-color: <?php echo esc_attr($darker_color); ?>;"><?php echo esc_html(get_field('inicio')); ?></div>
                            </div>
                        </div>
                    </div>

                    <div class="ev-item-right">
                        <div class="ev-text-container">
                            <h3 class="ev-title"><?php echo get_field('local'); ?></h3>
                            <p class="ev-classification">Classificação: <?php echo get_field('classificacao'); ?></p>
                            <p class="ev-location"><?php echo get_field('lotacao'); ?></p>
                        </div>
                        <div class="ev-price-button-container">
                            <p class="ev-preco-ingresso"><?php echo get_field('ingresso_inteira'); ?></p>
                            <a href="<?php echo get_field('link'); ?>" class="ev-paid-btn">COMPRAR INGRESSO</a>
                        </div>
                    </div>
                </div>
                <!-- Conteúdo detalhado do evento -->
                <div class="page-content">
                    <article id="post-<?php the_ID(); ?>" class="article event-article">
                        <h2 class="title event-title"><?php the_title(); ?></h2>
                        <div class="event-description">
                            <p><?php the_content(); ?></p>
                        </div>
                    </article>
                </div>

                <!-- Botão "VER TODOS OS EVENTOS" -->
                <div class="ev-todos-os-eventos">
                    <a href="<?php echo esc_url(home_url('/')); ?>eventos" class="ev-btn ev-btn-eventos">VER TODOS OS EVENTOS</a>
                </div>
            </div>

            <!-- Segunda Coluna: Calendário e Legenda -->
            <div class="event-calendar-column">
                <div class="ev-calendar">
                    <div id="calendar">
                        <div id="calendar-header">
                                <span id="calendar-month-year-container">
                                    <span id="calendar-month"></span>
                                    <span id="calendar-year"></span>
                                </span>
                            <div id="calendar-navigation">
                                <span id="ev-prev-month" style="pointer-events: auto;">&lt;</span>
                                <span id="ev-next-month" style="pointer-events: auto;">&gt;</span>
                            </div>
                        </div>

                        <table id="calendar-table">
                            <thead>
                            <tr class="ev-sun-mon-semana">
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
    </div>
</main>
<?php endwhile; ?>
</body>
</html>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    jQuery(document).ready(function($) {
        let currentMonth = new Date().getMonth();
        let currentYear = new Date().getFullYear();

        // Data do evento selecionado na página
        const selectedEventDate = '<?php echo date('Y-m-d', strtotime(get_field('data'))); ?>'; // Data do evento da página de descrição

        function loadEventsAndRenderCalendar(month, year) {
            $.ajax({
                url: '<?php echo admin_url('admin-ajax.php'); ?>',
                type: 'POST',
                data: {
                    action: 'load_events_for_month',
                    month: month + 1, // Meses no JS são indexados a partir de 0
                    year: year
                },
                success: function(response) {
                    const data = JSON.parse(response);
                    renderCalendar(data.events, month, year);
                },
                error: function(xhr, status, error) {
                    console.error("Erro ao carregar eventos: ", status, error);
                }
            });
        }

        function renderCalendar(events, month, year) {
            const monthNames = ["Janeiro", "Fevereiro", "Março", "Abril", "Maio", "Junho", "Julho", "Agosto", "Setembro", "Outubro", "Novembro", "Dezembro"];

            let firstDay = new Date(year, month, 1).getDay();
            let daysInMonth = 32 - new Date(year, month, 32).getDate();

            let calendarBody = $("#calendar-body");
            calendarBody.empty();

            $("#calendar-month").text(monthNames[month]); // Atualiza o mês
            $("#calendar-year").text(year); // Atualiza o ano

            let date = 1;
            for (let i = 0; i < 6; i++) {
                let row = $("<tr></tr>");

                for (let j = 0; j < 7; j++) {
                    if (i === 0 && j < firstDay) {
                        row.append($("<td></td>"));
                    } else if (date > daysInMonth) {
                        break;
                    } else {
                        let formattedDate = `${year}-${(month + 1).toString().padStart(2, '0')}-${date.toString().padStart(2, '0')}`;
                        let cell = $("<td></td>").attr("data-date", formattedDate);
                        let cellText = $("<span></span>").text(date).addClass('event-day-year');

                        let event = events.find(e => {
                            let eventDate = new Date(e.date);
                            return eventDate.getDate() === date && eventDate.getMonth() === month && eventDate.getFullYear() === year;
                        });

                        if (event) {
                            let color = getColorByGroup(event.grupo); // Usando a função de cor baseada em grupo
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

                            // Adiciona borda preta apenas para a data do evento selecionado
                            if (formattedDate === selectedEventDate) {
                                cellText.css('border', '2px solid black');
                            }
                        }

                        cell.append(cellText);
                        row.append(cell);
                        date++;
                    }
                }

                calendarBody.append(row);
            }

            renderLegend(events, month, year);
        }

        function renderLegend(events, month, year) {
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

        function getColorByGroup(grupo) {
            if (!grupo || grupo.trim().toLowerCase() === "série padrão") {
                return '#003366'; // Cor padrão para grupos nulos ou indefinidos
            }

            // Normaliza o nome do grupo para evitar problemas de comparação
            grupo = grupo.trim().toLowerCase();

            switch (grupo) {
                case 'série manuel inácio':
                case 'série m. i.': // Certifique-se de que os valores estão correspondendo aos do JSON
                    return '#eda821';
                case 'viagens sinfônicas':
                    return '#761984';
                case 'série carybé':
                    return '#d87331';
                case 'osba na estrada':
                    return '#8e5a45';
                case 'cameratas':
                    return '#195584';
                case 'osba pop':
                    return '#106433';
                case 'outros concertos':
                    return '#595959';
                case 'cineconcerto':
                    return '#000000';
                case 'osbacuri':
                    return '#f57ca4';
                case 'verão da osba':
                    return '#ce3d2a';
                default:
                    return '#003366'; // Cor padrão para qualquer outro caso
            }
        }

        function navigateMonth(direction) {
            if (direction === 'prev') {
                if (currentMonth === 0) {
                    currentYear--;
                    currentMonth = 11;
                } else {
                    currentMonth--;
                }
            } else if (direction === 'next') {
                if (currentMonth === 11) {
                    currentYear++;
                    currentMonth = 0;
                } else {
                    currentMonth++;
                }
            }
            loadEventsAndRenderCalendar(currentMonth, currentYear);
        }

        // Navegação entre meses
        $("#ev-prev-month").on("click", function() {
            navigateMonth('prev');
        });

        $("#ev-next-month").on("click", function() {
            navigateMonth('next');
        });

        // Carregar eventos iniciais e renderizar o calendário
        loadEventsAndRenderCalendar(currentMonth, currentYear);
    });
</script>


<?php get_footer(); ?>
