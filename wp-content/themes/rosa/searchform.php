<div id="rosa-search">
    <form action="" method="get" id="searchform"> 
        <input type="hidden" name="lang" value="<?php echo(ICL_LANGUAGE_CODE); ?>"/>
        <label for="search"></label>
            <input type="text" name="s" id="search" value="<?php the_search_query(); ?>" placeholder="<?php _e('Search..','rosa');?>"/>
            <input type="submit" value="<?php _e('Search','rosa') ;?>" class="searchSubmit" />

    </form>
</div>
