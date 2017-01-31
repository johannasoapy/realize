<form role="search" method="get" id="searchform" class="searchform" action="<?php echo home_url( '/' ); ?>">
    <div>
        <label for="s" class="screen-reader-text"><?php _e('Search for:','bonestheme'); ?></label>
        <input onfocus="jQuery('.search-box').addClass('open');" type="search" id="s" name="s" value="" placeholder="Search site&hellip;" />

        <button type="submit" id="searchsubmit" class="blue-btn"><?php _e('Search','bonestheme'); ?></button>
    </div>
</form>