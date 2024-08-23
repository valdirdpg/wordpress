<?php
/* Template Name: Blog */
get_header(); ?>

<heade>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css2?family=Raleway:wght@400;700&display=swap" rel="stylesheet">
</heade>
<div id="mainHeader" style="width: 2000px;"></div>
<div class="main-content">

    <!-- Swiper Slider -->
    <div class="swiper-container main-slider">
        <div class="swiper-wrapper">
            <?php
            // Query para pegar os posts mais recentes para o slider
            $args = array(
                'post_type' => 'blog',
                'posts_per_page' => 5, // Número de posts no slider
            );
            $slider_query = new WP_Query($args);

            if ($slider_query->have_posts()) :
                while ($slider_query->have_posts()) : $slider_query->the_post();
                    $imagem_de_destaque = get_field('imagem_de_destaque');
                    if (is_array($imagem_de_destaque)) {
                        $imagem_url = $imagem_de_destaque['url'];
                    } else {
                        $imagem_url = $imagem_de_destaque;
                    }
                    $categoria = get_field('categorias');
                    ?>
                    <div class="swiper-slide" style="background-image: url('<?php echo esc_url($imagem_url); ?>');">
                        <div class="slide-content">
                            <div class="overlay"></div>
                            <?php if ($categoria): ?>
                                <span class="slide-category" style="margin-left: 250px; "><?php echo esc_html($categoria); ?></span>
                            <?php endif; ?>
                            <p class="slide-title" style="margin-left: 250px; "><?php the_title(); ?></p>
                        </div>
                    </div>
                <?php
                endwhile;
                wp_reset_postdata();
            else :
                echo '<p>Nenhum post encontrado para o slider.</p>';
            endif;
            ?>
        </div>
        <!-- Adicionando Paginação (Bolinhas) -->
        <div class="swiper-pagination"></div>
    </div>

    <div class="cards-section">
        <div class="cards-container-wrapper">
            <div id="cards-container" class="cards-container">
                <!-- Os cards serão carregados dinamicamente aqui -->
            </div>
        </div>

        <!-- Botões de navegação personalizados -->
        <div class="navigation-buttons">
            <button id="prev-cards" class="circular-btn">&lt;</button>
            <button id="next-cards" class="circular-btn">&gt;</button>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        let currentPage = 1;

        function loadCards(page) {
            $.ajax({
                url: '/wp-admin/admin-ajax.php', // Certifique-se de que este caminho está correto
                type: 'POST',
                data: {
                    action: 'load_cards', // Nome da ação do AJAX
                    page: page
                },
                success: function(response) {
                    $('#cards-container').html(response); // Insere os cards no container
                }
            });
        }

        function toggleEventButtons(button) {
            // Remove a classe 'active' de ambos os botões
            $('#prev-cards, #next-cards').removeClass('active');
            // Adiciona a classe 'active' ao botão clicado
            $(button).addClass('active');

            // Alterna as cores dos botões
            if (button.id === "prev-cards") {
                $("#prev-cards").css("background-color", "#FFF4DA");
                $("#next-cards").css("background-color", "white");
            } else {
                $("#next-cards").css("background-color", "#FFF4DA");
                $("#prev-cards").css("background-color", "white");
            }
        }

        $('#next-cards').on('click', function() {
            currentPage++;
            loadCards(currentPage);
            toggleEventButtons(this);
        });

        $('#prev-cards').on('click', function() {
            if (currentPage > 1) {
                currentPage--;
                loadCards(currentPage);
                toggleEventButtons(this);
            }
        });

        loadCards(currentPage); // Carrega os cards iniciais

    </script>



    <?php get_footer(); ?>
