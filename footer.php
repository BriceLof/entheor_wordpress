        <footer>
            <section id="links_footer">
                <div class="container text-center block_links_footer">
                    <nav class="row">
                        <ul>
                           <li><a href="<?php echo get_permalink(get_post(266)->ID) ?>">Mention légales</a></li>
                           <!--<li><a href="">Référence</a></li>-->
                           <li><a href="<?php echo get_permalink(get_post(255)->ID) ?>">Vie privée</a></li>
                           <li><a href="<?php echo get_permalink(get_post(257)->ID) ?>">Conditions générales de ventes</a></li>
                           <li><a href="<?php echo get_permalink(get_post(249)->ID) ?>">Enthéor recrute</a></li>
                        </ul>
                    </nav>
                </div>
                <nav id="social_network_block">
                    <ul id="social_network">
                        <li><a href=""><img src="<?php echo get_template_directory_uri(); ?>/assets/image/twitter-entheor.png" alt="Twitter"></a></li>
                        <li><a href=""><img src="<?php echo get_template_directory_uri(); ?>/assets/image/facebook-entheor.png" alt="Facebook"></a></li>
                    </ul>
                </nav>
            </section>
            <?php wp_footer(); ?>
        </footer>
    </body>
</html>