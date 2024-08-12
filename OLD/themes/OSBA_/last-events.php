<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Exibição de Eventos</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f9f9f9;
            padding: 20px;
            display: flex;
            justify-content: center;
        }

        .container {
            width: 100%;
            max-width: 1140px;
            margin: 0 auto;
            background-color: #fff;
            padding: 20px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            display: flex;
            flex-direction: row; /* Adiciona a exibição em linha para o container principal */
        }

        .ev-last-events {
            flex: 1; /* Permite que a seção de eventos ocupe o máximo de espaço disponível */
        }

        .ev-custom-grid {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 20px;
            width: 100%;
        }

        .ev-grid-item {
            background-color: white;
            border: 1px solid #ddd;
            border-radius: 20px;
            overflow: hidden;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
            position: relative;
        }

        .ev-custom-img {
            width: 100%;  /* Remove a definição de altura */
            height: auto;  /* Remove a definição de altura */
            object-fit: cover;  /* Nova propriedade para redimensionar a imagem */
            position: relative;
        }

        .ev-img-wrapper {
            width: 100%;
            height: auto;
            position: relative;
        }

        .ev-banner {
            position: absolute;
            bottom: 0; /* Posiciona o banner no final da imagem */
            left: 0; /* Remove o padding para a margem esquerda */
            width: 100px; /* Ajuste conforme necessário */
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
        }

        .ev-banner-date,
        .ev-banner-time {
            width: 100%; /* Ajusta a largura para 100% do contêiner */
            padding: 5px 0; /* Remove o padding para a margem esquerda e direita */
            text-align: center;
        }

        .ev-banner-date {
            background: #da35ce;
            color: white;
            padding: 10px 15px;
            font-family: "Nocturno Display Bold", Sans-serif;
            font-weight: bold;
            font-size: 20px;
            line-height: 1.2;
            text-align: center;
            width: 100%;
        }

        .ev-banner-time {
            background: #bc1bb0;
            color: white;
            padding: 5px 15px;
            font-family: "Nocturno Display Bold", Sans-serif;
            font-weight: bold;
            font-size: 16px;
            line-height: 1.2;
            text-align: center;
            width: 100%;
        }

        .ev-horizontal-line {
            position: absolute;
            top: 97%;
            left: 100px;
            width: calc(100% - 80px);
            height: 8px;
            background-color: #da35ce;
            z-index: 1;
        }

        .ev-events-body {
            padding: 15px;
        }

        .ev-title {
            font-size: 18px;
            margin: 0 0 10px;
            color: #333;
        }

        .ev-btn-outline-secondary, .ev-btn-primary {
            display: inline-block;
            padding: 5px 10px;
            text-decoration: none;
            border-radius: 30px;
            transition: background-color 0.3s;
            margin-top: 10px;
            font-weight: bold;
        }

        .ev-btn-outline-secondary {
            background-color: #fcf6e8;
            color: #333;
            border: 1px solid #ddd;
            padding: 2px 16px 2px 16px;
        }

        .ev-btn-outline-secondary:hover {
            background-color: #ddd;
        }

        .ev-btn-primary {
            background-color: #004085;
            color: white;
            border: none;
            font-size: 12px;
            padding: 5px 16px 3px 16px;
            margin-left: 45px;
        }

        .ev-btn-primary:hover {
            background-color: #003366;
        }

        .ev-banner-title {
            text-transform: uppercase;
        }

        .ev-content {
            font-size: 16px;
            margin: 0 0 10px;
            color: #000;
            font-weight: normal;
        }

        /* Estilos para a barra lateral */
        .ev-sidebar {
            margin-top: 50px;
            width: 30%;
            background-color: #fff;
            border: 1px solid #ddd;
            border-radius: 8px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
            padding: 10px;
            margin-left: 20px; /* Adiciona um espaço entre a seção de eventos e a barra lateral */
        }

        .ev-sidebar h3 {
            font-size: 20px;
            text-align: center;
            margin-bottom: 15px;
        }

        .ev-calendar {
            border: 1px solid #ddd;
            border-radius: 8px;
            background-color: #fff;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
            padding: 15px;
            margin-bottom: 20px;
            height: 30%;
        }

        .ev-legend {
            background-color: #fff;
            border: 1px solid #ddd;
            border-radius: 8px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
            padding: 15px;
        }

        .ev-legend-item {
            margin-bottom: 10px;
        }

        .ev-legend-item span {
            font-weight: bold;
            color: #333;
        }

        @media (max-width: 768px) {
            body {
                padding: 10px;
            }

            .container {
                flex-direction: column; /* Muda a direção do layout para coluna em telas menores */
            }

            .ev-sidebar {
                width: 100%;
                margin-left: 0;
                margin-top: 20px;
            }

            .ev-custom-grid {
                grid-template-columns: 1fr;
                width: 100%;
            }
            .ev-btn-primary {
                background-color: #004085;
                color: white;
                border: none;
                font-size: 5px;
                padding: 5px 16px 3px 16px;
                align-items: center;
            }
        }

        @media (max-width: 576px) {
            .ev-title {
                font-size: 16px;
            }
            .ev-content {
                font-size: 14px;
            }

            .ev-banner-date, .ev-banner-time {
                width: 60px;
                font-size: 14px;
            }
            .ev-horizontal-line {
                top: 98%;
                left: 60px;
                width: calc(100% - 60px);
            }
            .ev-btn-outline-secondary,
            .ev-btn-primary {
                font-size: 10px;
                padding: 4px 10px;
            }
        }

        /* Estilos para resolução específica de 390px x 844px */
        @media (max-width: 390px) and (max-height: 844px) {
            .ev-title {
                font-size: 14px;
            }
            .ev-content {
                font-size: 12px;
            }
            .ev-banner{
                top: 82.5%;
                left: -9px;
            }
            .ev-banner-date, .ev-banner-time {
                width: 50px;
                font-size: 12px;
            }
            .ev-horizontal-line {
                top: 96%;
                left: 50px;
                width: calc(100% - 50px);
            }
            .ev-btn-outline-secondary,
            .ev-btn-primary {
                font-size: 8px;
                padding: 3px 8px;
            }
        }
         /* Estilos para resolução específica de 360px x 740px */
        @media (max-width: 360px) and (max-height: 800px) {
            .ev-title {
                font-size: 14px;
            }
            .ev-content {
                font-size: 12px;
            }
            .ev-banner{
                top: 79.5%;
                left: -0.5px;

            }
            .ev-banner-date, .ev-banner-time {
                width: 60px;
                font-size: 12px;
            }
            .ev-horizontal-line {
                margin-top:1%;
                /*margin-left: -9px;*/
                width: calc(100% - 50px);
            }
            .ev-btn-outline-secondary,
            .ev-btn-primary {
                font-size: 8px;
                padding: 3px 8px;
            }
        }

        /* Estilos para resolução específica de 768px x 1154px */
        @media (max-width: 786px) and (max-height: 1154px) {
            .ev-title {
                font-size: 17px;
            }
            .ev-content {
                font-size: 15px;
            }
            .ev-banner{
                margin-top: -3%;
                margin-left: -10px;
            }
            .ev-banner-date, .ev-banner-time {
                width: 70px;
                font-size: 16px;
                margin-left: -10px;
            }
            .ev-horizontal-line {
                top: 94.5%;
                left: 70px;
                width: calc(100% - 70px);
            }
             .ev-btn-outline-secondary,
             .ev-btn-primary {
                font-size: 11px;
                padding: 4px 12px;
                margin-left: 0; /* Remove o margem esquerda */
                display: flex;
                justify-content: center; /* Centraliza horizontalmente */
                align-items: center; /* Alinha verticalmente */
                margin: 8px auto; /* Adiciona margem automática para centralizar */
            }

             /* Estilos para resolução específica de 768px x 866px */
        @media (max-width: 786px) and (max-height: 866px) {
            .ev-title {
                font-size: 17px;
            }
            .ev-content {
                font-size: 15px;
            }
            .ev-banner{
                margin-top: -8.5%;
                margin-left: -10px
            }
            .ev-banner-date, .ev-banner-time {
                width: 70px;
                font-size: 16px;
                margin-left: -10px;
            }
            .ev-horizontal-line {
                top: 95%;
                left: 70px;
                width: calc(100% - 70px);
            }
             .ev-btn-outline-secondary,
             .ev-btn-primary {
                font-size: 11px;
                padding: 4px 12px;
                margin-left: 0; /* Remove o margem esquerda */
                display: flex;
                justify-content: center; /* Centraliza horizontalmente */
                align-items: center; /* Alinha verticalmente */
                margin: 8px auto; /* Adiciona margem automática para centralizar */
            }


        }
    </style>
</head>
<body>

<div class="container">
    <div class="ev-last-events">
        <h1>Próximos Eventos</h1>
        <div class="ev-custom-grid">
            <?php
            // Verifica se a função já foi definida
            if (!function_exists('limit_words')) {
                // Função para limitar o texto a 200 palavras
                function limit_words($text, $limit) {
                    $text = wp_strip_all_tags($text);
                    $words = explode(' ', $text);
                    if (count($words) > $limit) {
                        $text = implode(' ', array_slice($words, 0, $limit)) . '...';
                    }
                    return $text;
                }
            }

            // Query para obter os eventos
            $args = array(
                'post_type' => 'evento',
                'posts_per_page' => 4, // Número de eventos a serem exibidos
            );

            $eventos_query = new WP_Query($args);

            if ($eventos_query->have_posts()) {
                $eventos = array(); // Array para armazenar os eventos e suas datas

                while ($eventos_query->have_posts()) : $eventos_query->the_post();
                    $content = get_the_content();
                    // Limita o conteúdo a 50 palavras
                    $short_content = limit_words($content, 50);
                    // Adiciona o evento ao array para uso na legenda
                    $eventos[] = [
                        'title' => get_the_title(),
                        'date' => get_field('data'), // Ajuste conforme o seu campo de data
                    ];
                    ?>
                    <div class="ev-grid-item">
                        <div class="ev-item">
                            <div class="ev-img-wrapper ev-events-img">
                                <picture>
                                    <?php the_post_thumbnail('full', array('class' => 'ev-custom-img')); ?>
                                </picture>
                                <div class="ev-banner">
                                    <span class="ev-banner-date"><?php echo date('d/m', strtotime(get_field('data'))); ?></span>
                                    <span class="ev-banner-time"><?php echo date('H', strtotime(get_field('inicio'))); ?>h</span>
                                </div>
                                <div class="ev-horizontal-line"></div>
                            </div>
                            <div class="ev-events-body ev-item-body">
                                <h2 class="ev-title ev-banner-title"><?php the_title(); ?></h2>
                                <div class="ev-content"><?php echo $short_content; ?></div>
                                <a href="<?php the_permalink(); ?>" class="ev-btn ev-btn-outline-secondary">saiba mais</a>
                                <a href="<?php the_permalink(); ?>" class="ev-btn ev-btn-primary">COMPRAR INGRESSO</a>
                            </div>
                        </div>
                    </div>
                <?php endwhile;
            } else {
                echo '<p>Nenhum evento encontrado.</p>';
            }
            ?>
        </div>
    </div>

    <!-- Barra lateral com calendário e legenda -->
    <div class="ev-sidebar">
        <div class="ev-calendar">
            <h3>Calendário</h3>
            <!-- shortcode de calendário -->
            <?php echo do_shortcode('[fullcalendar]'); ?>
        </div>
        <div class="ev-legend">
            <h3>Legenda dos Eventos</h3>
            <?php foreach ($eventos as $evento) : ?>
                <div class="ev-legend-item">
                    <span><?php echo esc_html($evento['date']); ?>:</span> <?php echo esc_html($evento['title']); ?>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</div>

</body>
</html>
