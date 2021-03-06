<!-- Footer -->
<footer id="main-footer">
    <div class="row">
    	
    	<div class="col-md-6">
    		<?php dynamic_sidebar('Home page footer 1') ;?>
    	</div>
    	<div class="col-md-6">
    		<?php dynamic_sidebar('Home page footer 2') ;?>
    	</div>

    	<div class="cleafix"></div>

    	<div class="col-md-12">
    		<p class="copyright">
                <?php 
                    _e('All Rights Reserved To Rosa Luxemburg Stiftung Regional Office Palestine', 'rosa') ;
                ?>
    			<span class="social-links">
    				<a href="https://www.facebook.com/rlfpal" target="_blank"><img src="<?php bloginfo('template_url') ;?>/img/facebook.png" alt=""></a>
    				<a href="https://www.youtube.com/channel/UCd2CsdyCIBK78W-znt4su1Q/videos" target="_blank"><img src="<?php bloginfo('template_url') ;?>/img/youtube.png" alt=""></a>
    			</span>
    		</p>

    	</div>
    </div>
</footer>
<?php wp_footer(); ?>
</div>

<script src="<?php bloginfo('template_url'); ?>/bower_components/jquery/dist/jquery.min.js"></script>
<script src="<?php bloginfo('template_url'); ?>/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<script src="<?php bloginfo('template_url'); ?>/bower_components/owlCarousel/owl-carousel/owl.carousel.js"></script>
<script src="<?php bloginfo('template_url'); ?>/bower_components/accordionMenu/src/jquery.navgoco.min.js"></script>

<?php if(ICL_LANGUAGE_CODE === 'ar') : ;?>
    
    <script src="<?php bloginfo('template_url');?>/js/owl-rtl.js"></script>

<?php endif; ?>
<script src="<?php bloginfo('template_url'); ?>/js/main.js"></script>
</body>
</html>