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
    ?>

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="https://fonts.googleapis.com/css2?family=Raleway:wght@400;700&display=swap" rel="stylesheet">
        <title>Descrição do Evento</title>
    </head>
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
                                <div class="ev-day-month<?php echo (get_field('tipo') === 'Pago') ? '-paid' : ''; ?>">
                                    <span class="ev-day<?php echo (get_field('tipo') === 'Pago') ? '-paid' : ''; ?>"><?php echo date('d', strtotime(get_field('data'))); ?></span>
                                    <span class="ev-month<?php echo (get_field('tipo') === 'Pago') ? '-paid' : ''; ?>">/<?php echo date('m', strtotime(get_field('data'))); ?></span>
                                </div>
                                <div class="ev-weekday-time<?php echo (get_field('tipo') === 'Pago') ? '-paid' : ''; ?>">
                                    <div class="ev-weekday-block<?php echo (get_field('tipo') === 'Pago') ? '-paid' : ''; ?>"><?php echo date_i18n('D', strtotime(get_field('data'))); ?></div>
                                    <div class="ev-time-block<?php echo (get_field('tipo') === 'Pago') ? '-paid' : ''; ?>"><?php echo date('H', strtotime(get_field('data'))); ?>h</div>
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
                                <a href="<?php echo get_permalink(); ?>" class="ev-paid-btn">COMPRAR INGRESSO</a>
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
                        <a href="<?php echo get_post_type_archive_link('evento'); ?>/eventos" class="ev-btn ev-btn-eventos">VER TODOS OS EVENTOS</a>
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
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    jQuery(document).ready(function($) {
        let currentMonth = new Date().getMonth();
        let currentYear = new Date().getFullYear();

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
                monthEvents.forEach(event => {
                    console.log(event);

                    let titleText = event.title ? event.title : 'Título não disponível';

                    let color = event.tipo === 'Gratuito' ? '#44996c' : '#BE7229';
                    legend.append(`
            <div class="ev-legend-item">
                <div class="color-box" style="background-color: ${color}; flex-shrink: 0;"></div>
                <span>${titleText}</span>
            </div>
            `);
                });
            } else {
                legend.append('<p>Nenhum evento encontrado para este mês.</p>');
            }
        }


        // Navegação entre meses
        $("#ev-prev-month").on("click", function() {
            if (currentMonth === 0) {
                currentYear--;
                currentMonth = 11;
            } else {
                currentMonth--;
            }
            loadEventsAndRenderCalendar(currentMonth, currentYear);

            // Ajusta a cor dos botões
            $("#ev-prev-month").css("background-color", "#FFF4DA");
            $("#ev-next-month").css("background-color", "white");
        });

        $("#ev-next-month").on("click", function() {
            if (currentMonth === 11) {
                currentYear++;
                currentMonth = 0;
            } else {
                currentMonth++;
            }
            loadEventsAndRenderCalendar(currentMonth, currentYear);

            // Ajusta a cor dos botões
            $("#ev-next-month").css("background-color", "#FFF4DA");
            $("#ev-prev-month").css("background-color", "white");
        });

        // Carregar eventos iniciais e renderizar o calendário
        $.ajax({
            url: '<?php echo admin_url('admin-ajax.php'); ?>',
            type: 'POST',
            data: {
                action: 'load_initial_data'
            },
            success: function(response) {
                const data = JSON.parse(response);
                renderCalendar(data.events, currentMonth, currentYear);
            },
            error: function(xhr, status, error) {
                console.error("Erro ao carregar dados iniciais: ", status, error);
            }
        });
    });

</script>

<?php get_footer(); ?>

<style>
    .container {
        display: grid;
        grid-template-columns: 1fr 1fr; /* Duas colunas de tamanho igual */
        gap: 20px; /* Espaçamento entre as colunas */
    }

    .item {
        padding: 20px;
    }

    @font-face {
        font-family: 'Raleway';
        font-weight: normal;
        font-style: normal;
    }

    body, html {
        font-family: 'Raleway', Arial, sans-serif;
        background-color: #f9f9f9;
        margin: 0;
        padding: 0;
        width: 100%;
        overflow-x: hidden; /* Isso ajuda a evitar qualquer rolagem horizontal indesejada */
    }

    #ev-prev-month, #ev-next-month {
        cursor: pointer;
        font-size: 1.2em;
        user-select: auto;
    }

    .event-header {
        display: flex;
        justify-content: center; /* Centraliza horizontalmente */
        align-items: center; /* Centraliza verticalmente */
        height: 50vh; /* Garante que o container tenha altura da tela */
    }

    .event-header-img {
        width: 75%;
        height: 50vh; /* Altura de 50% da altura da viewport */
        overflow: hidden;
        position: relative;
    }

    .event-header-img img {
        width: 100%; /* Ajusta a largura da imagem para caber no container */
        height: 100%; /* Mantém a altura especificada */
        object-fit: cover;
        object-position: center;
    }

    .event-title-overlay {
        position: absolute;
        top: 200px;
        left: 135px;
        font-family: 'Nocturno Display Pro';
        font-weight: bold;
        font-size: 32px;
        color: white;
        z-index: 10;
    }

    .event-description {
        font-size: 16px;
    }

    .ev-banner {
        display: flex;
        align-items: center;
        justify-content: center;
        background-color: #67a989; /* Cor de fundo do banner */
        color: white;
        padding: 15px;
        text-align: center;
    }

    .ev-banner-date-time {
        display: flex;
        flex-direction: column;
        align-items: center;
    }

    .ev-banner-date,
    .ev-banner-time {
        padding: 5px 10px;
        margin: 5px 0;
        background-color: #83c9b1;
    }

    .event-details-section {
        display: flex;
        flex-direction: column;
        justify-content: center;
        background-color: #FFF7E6;
        padding: 15px;
    }

    .event-location {
        font-size: 18px;
        font-weight: bold;
        margin-bottom: 5px;
        color: #2E2E2E;
    }

    .event-classification, .event-availability {
        font-size: 14px;
        margin-bottom: 5px;
        color: #5C5C5C;
    }

    .event-free-badge, .btn-event {
        background-color: #44996c;
        color: white;
        padding: 10px 20px;
        text-align: center;
        font-weight: bold;
        margin-top: 10px;
    }

    .event-container {
        display: grid;
        grid-template-columns: 1fr 0.4fr;
        gap: 20px;
        width: 80%; /* Largura percentual para ser responsiva */
        max-width: 1140px; /* Largura fixa máxima */
        margin: 0 auto; /* Centraliza o container horizontalmente */
        margin-top: -110px;
        min-height: 600px; /* Define uma altura mínima para o container */
    }

    .event-content-column {
        width: 100%;
        padding-top: 50px;
    }

    .event-title {
        padding-top: 60px;
        padding-bottom: 10px;
        font-family: "Nocturno Display Bold";
        font-size: 32px;
        font-weight: bold;
        text-transform: uppercase;
    }

    .event-calendar-column {
        background: #fff;
        padding: 20px;
        display: flex;
        flex-direction: column;
        justify-content: space-between;
        height: 100%; /* Faz o calendário e a legenda ocuparem a altura completa */
        min-height: 600px; /* Define uma altura mínima para o calendário */
        max-height: 700px;
        width: 372px;
    }

    .ev-calendar {
        border: 1px dashed #ddd;
        background-color: #fff;
        padding: 15px;
        margin-bottom: 20px;
        height: 30%;
    }

    .ev-legend {
        background-color: #fff;
        border: 1px dashed #ddd;
        padding: 15px;
    }

    #calendar-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 15px;
        font-weight: bold;
    }

    #calendar-month {
        font-size: 22px;
        text-transform: uppercase;
    }

    #calendar-year {
        font-size: 20px;
    }

    #calendar-month-year-container {
        white-space: nowrap;
    }

    #calendar-month::after {
        content: " ";
    }

    #calendar-navigation span {
        cursor: pointer;
        font-size: 20px;
        color: #333;
        z-index: 1000;
    }

    #calendar-table {
        width: 100%;
        text-align: center;
        border-collapse: collapse;
        background-color: #FFFFFF;
    }

    #calendar-table th, #calendar-table td {
        padding: 10px;
        border: none;
    }

    .event-day {
        font-weight: bold;
    }

    th {
        font-family: Raleway;
        font-weight: 400;
        font-size: 12px;
        color: #696969;
    }

    #calendar-body {
        font-family: Raleway;
        color: #696969;
        font-weight: normal;
        font-size: 16px;
    }

    .event-day-free, .event-day-paid {
        padding: 5px;
        display: flex;
        justify-content: center;
        align-items: center;
        width: 30px;
        height: 30px;
        text-align: center;
    }

    .event-day-free {
        background-color: #5FB085;
        color: #fff;
    }

    .event-day-paid {
        background-color: #BE7229;
        color: #fff;
    }

    .ev-legend {
        margin-top: 20px;
        flex-grow: 0;
        font-family: Raleway;
        font-size: 14px;
        font-weight:normal;
    }

    .ev-legend-item {
        display: flex;
        align-items: center;
        margin-bottom: 10px;
    }

    .color-box {
        width: 20px;
        height: 20px;
        margin-right: 10px;
        flex-shrink: 0;
    }

    .ev-grid-item {
        display: flex;
        align-items: stretch;
        width: 100%;
        border: none;
        height: 147px;
        border-radius: 0;
    }

    .ev-item-left {
        display: flex;
        flex-direction: column;
        background-color: #5FB085;
        color: white;
        text-align: center;
        width: 169px;
        height: 147px;
        border-radius: 0;
    }

    .ev-item-left .ev-date {
        display: flex;
        flex-direction: column;
        justify-content: flex-start;
        height: 100%;
    }

    .ev-day-month-paid {
        display: flex;
        justify-content: center;
        align-items: center;
        background-color: #BE7229;
        height: 70%;
        font-size: 48px;
        font-family: "Nocturno Display Bold";
    }

    .ev-weekday-block-paid {
        background-color: #DF8835;
        width: 50%;
        display: flex;
        justify-content: center;
        align-items: center;
        font-size: 30px;
        font-family: "Nocturno Display Bold";
    }

    .ev-time-block-paid {
        background-color: #AE5907;
        width: 50%;
        display: flex;
        justify-content: center;
        align-items: center;
        font-size: 30px;
        font-family: "Nocturno Display Bold";
    }

    .ev-weekday-time-paid {
        display: flex;
        height: 30%;
    }

    .ev-weekday-time {
        display: flex;
        height: 30%;
    }

    .ev-day-month {
        display: flex;
        justify-content: center;
        align-items: center;
        background-color: #5FB085;
        height: 70%;
        font-size: 48px;
        font-family: "Nocturno Display Bold";
    }

    .ev-weekday-block {
        background-color: #65C692;
        width: 50%;
        display: flex;
        justify-content: center;
        align-items: center;
        font-size: 30px;
        font-family: "Nocturno Display Bold";
    }

    .ev-time-block {
        background-color: #44996C;
        width: 50%;
        display: flex;
        justify-content: center;
        align-items: center;
        font-size: 30px;
        font-family: "Nocturno Display Bold";
    }

    .ev-item-right {
        width: 601px;
        padding: 10px 20px;
        background-color: #FCF6E8;
        height: 147px;
        border-radius: 0;
        flex-grow: 0;
        overflow: hidden;
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    .ev-text-container {
        flex: 1;
        white-space: normal;
        word-wrap: break-word;
        overflow: hidden;
    }

    .ev-price-button-container {
        display: flex;
        flex-direction: column;
        align-items: flex-end;
        flex-shrink: 0;
    }

    .event-article {
        line-height: 1.8;
        font-family: Raleway;
        font-weight: normal;
        font-size: 16px;
    }

    .ev-title, .ev-location, .ev-classification, .ev-info {
        margin: 0;
        font-size: 20px;
        line-height: 1.4;
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
        font-family: Raleway;
    }

    .ev-title {
        font-weight: 900;
    }

    .ev-preco-ingresso {
        font-family: Raleway;
        font-size: 20px;
        font-weight: 900;
    }

    .ev-button {
        flex-shrink: 0;
        margin-left: 10px;
    }

    .ev-free-btn, .ev-paid-btn {
        display: inline-block;
        padding: 5px 10px;
        border-radius: 20px;
        font-weight: normal;
        text-transform: uppercase;
        background-color: #68a08d;
        color: white;
        text-decoration: none;
        font-family: Raleway;
        width: 170px;
        text-align: center;
    }

    .ev-free-btn {
        background-color: #4D9C72;
        color: white;
        font-size: 16px;
    }

    .ev-paid-btn {
        background-color: #0a246a;
        color: white;
        text-decoration: none;
        font-size: 14px;
    }

    .ev-todos-os-eventos {
        display: flex;
        justify-content: flex-start;
        align-items: center;
        margin-top: 20px;
    }

    .ev-btn-eventos {
        background-color: #ECECEC;
        font-size: 14px;
        font-family: Raleway;
        font-weight: normal;
        width: 222px;
        height: 29px;
        text-align: center;
        box-shadow: 5px 5px 5px 0px rgba(0, 0, 0, 0.3);
        margin-left: 0;
        margin-top: -60px;
        margin-bottom: 40px;
    }

    /* Responsividade */
    @media (max-width: 1024px) {
        .event-container {
            grid-template-columns: 1fr; /* Coloca as colunas em uma única coluna em telas menores */
            width: 90%; /* Aumenta a largura para preencher mais a tela */
        }
    }

    @media (max-width: 768px) {
        .event-container {
            width: 100%; /* Preenche completamente a tela em dispositivos móveis */
            margin-top: 20px; /* Remove a margem negativa superior para um layout melhor em telas pequenas */
            gap: 10px; /* Reduz o espaçamento entre os elementos */
        }

        .container {
            grid-template-columns: 1fr; /* Coloca as colunas em uma única coluna em telas pequenas */
            gap: 10px; /* Reduz o espaçamento entre os elementos */
        }

        .item {
            padding: 10px; /* Reduz o padding nos itens para telas menores */
        }

        .event-header {
            flex-direction: column; /* Muda a direção do flex para coluna em dispositivos móveis */
            height: auto; /* Ajusta a altura para conteúdo em vez de viewport */
        }

        .event-header-img {
            width: 100%; /* Ajusta a largura da imagem para caber no container */
            height: auto; /* Ajusta a altura da imagem */
        }

        .event-title-overlay {
            top: 50px; /* Ajusta a posição do título no overlay */
            left: 20px; /* Reduz o espaçamento da esquerda */
            font-size: 24px; /* Reduz o tamanho da fonte */
        }

        .event-calendar-column {
            width: 100%; /* Ajusta a largura do calendário */
            min-height: auto; /* Remove a altura mínima */
            max-height: auto; /* Remove a altura máxima */
        }

        .ev-item-right {
            width: 100%; /* Ajusta a largura do item direito */
            height: auto; /* Remove a altura fixa */
        }

        .ev-grid-item {
            flex-direction: column; /* Organiza os itens em coluna para melhor visualização */
            height: auto; /* Remove a altura fixa */
        }

        .ev-title, .ev-location, .ev-classification, .ev-info {
            font-size: 18px; /* Ajusta o tamanho da fonte para dispositivos móveis */
        }

        .ev-free-btn, .ev-paid-btn {
            width: 100%; /* Ajusta a largura do botão para preencher o container */
            font-size: 14px; /* Ajusta o tamanho da fonte */
        }

        .ev-todos-os-eventos {
            justify-content: center; /* Centraliza o botão de ver todos os eventos */
        }

        .ev-btn-eventos {
            width: 100%; /* Ajusta a largura do botão para preencher o container */
            font-size: 14px; /* Ajusta o tamanho da fonte */
        }
    }

    @media (max-width: 480px) {
        .event-title-overlay {
            top: 20px; /* Ajusta a posição do título no overlay */
            left: 10px; /* Reduz o espaçamento da esquerda */
            font-size: 18px; /* Reduz ainda mais o tamanho da fonte */
        }

        .event-title {
            font-size: 24px; /* Ajusta o tamanho da fonte */
            padding-top: 30px; /* Ajusta o espaçamento superior */
        }

        .event-description {
            font-size: 14px; /* Ajusta o tamanho da fonte */
        }

        .ev-banner {
            flex-direction: column; /* Altera a direção do flex para coluna */
            padding: 10px; /* Reduz o padding */
        }

        .ev-banner-date-time {
            flex-direction: row; /* Organiza a data e a hora em linha */
        }

        .ev-banner-date,
        .ev-banner-time {
            margin: 5px; /* Ajusta a margem */
        }

        .ev-item-left, .ev-item-right {
            width: 100%; /* Ajusta a largura dos itens */
            height: auto; /* Remove a altura fixa */
        }

        .ev-item-right {
            padding: 10px; /* Ajusta o padding */
        }

        .ev-free-btn, .ev-paid-btn {
            font-size: 12px; /* Ajusta o tamanho da fonte */
        }
    }

</style>
