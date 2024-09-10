<?php
/* Template Name: Blog */
get_header(); ?>
<div id="mainHeader" style="width: 2000px;"></div>
<div class="main-content">

    <!-- Exibição da Imagem de Destaque -->



        <?php
        if (have_posts()) :
            while (have_posts()) : the_post();
                $autor = get_the_author();
                $atividade = get_field('atividade');
                $categoria = get_field('categorias');
                $data_de_publicacao = get_the_date();
                $tempo_de_leitura = get_field('tempo_de_leitura'); // Supondo que o tempo de leitura seja um campo personalizado
                $imagem_de_destaque = get_field('imagem_de_destaque');
                ?>
                <div class="post-image-container">
                    <img src="<?php echo esc_url($imagem_de_destaque['url']); ?>" alt="<?php the_title(); ?>" class="post-image" />
                </div>
    <!-- Contêiner para o conteúdo do post -->
        <div class="post-content-container">
                <div class="post-header">
                    <p class="post-categoria"><?php echo esc_html($categoria) ?></p>


                    <p class="post-title"><?php the_title(); ?></p>

                    <div class="post-meta">
                        <!-- Linha para Autor e Atividade -->
                        <span class="post-author">Por: <?php echo esc_html($autor); ?> - <?php echo esc_html($atividade); ?></span>

                        <!-- Linha para Data, Tempo de Leitura e Ícones de Redes Sociais -->
                        <div class="post-meta-second-line">
                            <span class="post-date"><?php echo esc_html($data_de_publicacao); ?> - </span>
                            <?php if ($tempo_de_leitura > 1) { ?>
                                <span class="post-reading-time"><?php echo esc_html($tempo_de_leitura); ?> minutos de leitura</span>
                            <?php } else { ?>
                                <span class="post-reading-time"><?php echo esc_html($tempo_de_leitura); ?> minuto de leitura</span>
                            <?php } ?>

                            <!-- Ícones de Redes Sociais e Compartilhamento -->
                            <span class="social-share-inline">
                                    Compartilhar:
                                    <a href="https://www.facebook.com/sharer/sharer.php?u=<?php echo rawurlencode(get_permalink()); ?>&quote=<?php echo rawurlencode(get_the_title()); ?>" target="_blank" class="social-icon">
                                        <i class="icon-facebook"></i>
                                    </a>
                                    <a href="https://twitter.com/intent/tweet?text=<?php echo rawurlencode(get_the_title() . ' ' . get_permalink()); ?>" target="_blank" class="social-icon">
                                        <i class="icon-twitter"></i>
                                    </a>
                                    <a href="https://www.youtube.com/channel/UCVdO0C1V84b4Ei4m36qmUtw" target="_blank" class="social-icon">
                                        <i class="icon-youtube-play"></i>
                                    </a>
                                    <a href="https://www.instagram.com/orquestrasinfonicadabahia/" target="_blank" class="social-icon">
                                        <i class="icon-instagram"></i>
                                    </a>
                                </span>
                        </div>
                    </div>
                </div>

                <div class="post-content">
                    <?php the_content(); ?>
                </div>
            <p class="post-leia-tambem">Leia também</p>
            <?php
            endwhile;
        else :
            echo '<p>Nenhum conteúdo encontrado.</p>';
        endif;
        ?>
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

</div>

<?php get_footer(); ?>
