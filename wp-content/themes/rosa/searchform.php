<div id="rosa-search">
    <form action="" method="get" id="searchform"> 
        <input type="hidden" name="lang" value="<?php echo(ICL_LANGUAGE_CODE); ?>"/>
        <label for="search"></label>
            <input type="text" name="s" id="search" value="<?php the_search_query(); ?>" placeholder="Search.."/>
            <input type="submit" value="Search" class="searchSubmit" />

    </form>
</div>
