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
        <link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/css/osba-eventos.css">
        <link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/css/style.css">
    </head>
    <div id="mainHeader" style="width: 2500px;"></div>
    <main id='mainContent'>
        <!-- Imagem de destaque do evento e banner ocupando toda a largura -->
        <div class="event-header">
            <div class="event-header-img">
                <?php the_post_thumbnail('full'); ?>
            </div>
        </div>

        <div class="page page-single page-event">
            <!-- Container com duas colunas -->
            <div class="event-container">

                <!-- Primeira Coluna: Conteúdo do Evento -->
                <div class="event-content-column">
                    <!-- Removendo contêiner extra -->
                    <div class="ev-grid-item" style="display: flex; height: 147px; align-items: stretch; border: none; border-radius: 0;">
                        <div class="ev-item-left">
                            <div class="ev-date">
                                <div class="ev-day-month">
                                    <span class="ev-day"><?php echo date('d', strtotime(get_field('data'))); ?></span>
                                    <span class="ev-month">/<?php echo date('m', strtotime(get_field('data'))); ?></span>
                                </div>
                                <div class="ev-weekday-time">
                                    <div class="ev-weekday-block"><?php echo date_i18n('D', strtotime(get_field('data'))); ?></div>
                                    <div class="ev-time-block"><?php echo date('H\hi', strtotime(get_field('data'))); ?></div>
                                </div>
                            </div>
                        </div>
                        <div class="ev-item-right">
                            <h3 class="ev-title"><?php the_title(); ?></h3>
                            <p class="ev-location"><?php echo get_field('local'); ?></p>
                            <p class="ev-classification"><?php echo get_field('classificacao'); ?></p>
                            <p class="ev-info">Sujeito à lotação do espaço</p>
                            <div class="ev-button">
                                <?php if (get_field('tipo') === 'Gratuito') : ?>
                                    <span class="ev-free-btn">GRATUITO</span>
                                <?php else : ?>
                                    <a href="<?php echo get_permalink(); ?>" class="ev-paid-btn">COMPRAR INGRESSO</a>
                                <?php endif; ?>
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
                                <span id="calendar-month-year"></span>
                                <div id="calendar-navigation">
                                    <span id="ev-prev-month" style="pointer-events: auto;">&lt;</span>
                                    <span id="ev-next-month" style="pointer-events: auto;">&gt;</span>
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

        // Navegação entre meses
        $("#ev-prev-month").on("click", function() {
            if (currentMonth === 0) {
                currentYear--;
                currentMonth = 11;
            } else {
                currentMonth--;
            }
            loadEventsAndRenderCalendar(currentMonth, currentYear);
        });

        $("#ev-next-month").on("click", function() {
            if (currentMonth === 11) {
                currentYear++;
                currentMonth = 0;
            } else {
                currentMonth++;
            }
            loadEventsAndRenderCalendar(currentMonth, currentYear);
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

    body, html {
        font-family: Arial, sans-serif;
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
        width: 100vw; /* Ocupa 100% da largura da viewport */
        margin-left: calc(-50vw + 50%);
        position: relative;
    }

    .event-header-img {
        width: 100%;
        height: 700px; /* Altura fixa */
        overflow: hidden;
    }

    .event-header-img img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        object-position: center;
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
        max-width: 1140px;
        margin: 0 auto;
        margin-top: -200px;
        min-height: 600px; /* Define uma altura mínima para o container */
    }

    .event-content-column {
        width: 100%;
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
        background-color: #FFFFFF; /* Fundo branco do calendário */
    }

    #calendar-table th, #calendar-table td {
        padding: 10px;
        border: none; /* Remove as linhas de grade */
    }

    .event-day {
        font-weight: bold;
    }

    .event-day-free, .event-day-paid {
        padding: 5px;
        display: flex;
        justify-content: center; /* Centraliza o conteúdo horizontalmente */
        align-items: center; /* Centraliza o conteúdo verticalmente */
        width: 30px;
        height: 30px;
        text-align: center;
    }

    .event-day-free {
        background-color: #5FB085;
        color: #fff;
    }

    .event-day-paid {
        background-color: #0a246a;
        color: #fff;
    }

    .ev-legend {
        margin-top: 20px;
        flex-grow: 0; /* Impede que a legenda cresça além do necessário */
    }

    .ev-legend-item {
        display: flex;
        align-items: center;
        margin-bottom: 10px;
    }

    .color-box {
        width: 20px; /* Largura fixa */
        height: 20px; /* Altura fixa, igual à largura para garantir que seja um quadrado */
        margin-right: 10px;
        flex-shrink: 0; /* Impede que o quadrado diminua de tamanho caso o título da legenda seja longo */
    }

    /* Estilo do banner de detalhamento do evento */
    .ev-grid-item {
        display: flex;
        align-items: stretch; /* Mantém ev-item-left e ev-item-right na mesma altura */
        width: 100%; /* Garante que o grid ocupe toda a largura disponível */
        border: none; /* Remove qualquer borda extra */
    }

    .ev-item-left {
        display: flex;
        flex-direction: column;
        background-color: #5FB085; /* Cor do primeiro tom de verde */
        color: white;
        text-align: center;
        width: 169px; /* Largura fixa conforme especificado */
        height: 147px; /* Altura fixa conforme especificado */
        border-radius: 0; /* Remove o arredondamento dos cantos */
    }

    .ev-item-left .ev-date {
        display: flex;
        flex-direction: column;
        justify-content: flex-start; /* Mantém o topo preenchido */
        height: 100%;
    }

    .ev-day-month {
        display: flex;
        justify-content: center;
        align-items: center;
        background-color: #83c9b1; /* Segundo tom de verde */
        height: 55%; /* Preenche a parte superior */
    }

    .ev-weekday-time {
        display: flex;
        height: 45%; /* Preenche a parte inferior */
    }

    .ev-weekday-block {
        background-color: #65C692; /* Primeiro tom de verde no bloco inferior */
        width: 50%;
        display: flex;
        justify-content: center;
        align-items: center;
        font-size: 16px;
    }

    .ev-time-block {
        background-color: #44996C; /* Segundo tom de verde no bloco inferior */
        width: 50%;
        display: flex;
        justify-content: center;
        align-items: center;
        font-size: 16px;
    }

    .ev-item-right {
        display: flex;
        flex-grow: 1;
        padding: 10px 20px;
        background-color: #FCF6E8; /* Cor de fundo creme */
        height: 147px; /* Altura fixa conforme especificado */
        justify-content: space-between; /* Alinha o texto à esquerda e o botão à direita */
        align-items: center; /* Alinha verticalmente os itens */
        flex-direction: row; /* Alinha os itens na horizontal */
        border-radius: 0; /* Remove o arredondamento dos cantos */
    }

    .ev-title {
        font-size: 20px;
        font-weight: bold;
        margin-bottom: 5px;
    }

    .ev-location {
        font-size: 16px;
        font-weight: bold;
        color: #2e2e2e;
        margin-bottom: 5px;
    }

    .ev-classification, .ev-info {
        font-size: 14px;
        color: #5c5c5c;
        margin-bottom: 5px;
    }

    .ev-button {
        text-align: right;
    }

    .ev-free-btn, .ev-paid-btn {
        display: inline-block;
        padding: 5px 10px;
        border-radius: 20px;
        font-weight: bold;
        text-transform: uppercase;
        background-color: #68a08d;
        color: white;
        text-decoration: none;
    }

    .ev-free-btn {
        background-color: #68a08d;
        color: white;
    }

    .ev-paid-btn {
        background-color: #0a246a;
        color: white;
        text-decoration: none;
    }

</style>
