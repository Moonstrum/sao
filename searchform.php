<form class="search-form" action="<?php echo home_url( '/' ); ?>">
  <label><span class="screen-reader-text"><?php echo esc_attr_x( 'Search ', 'label', 'sao' ) ?></span></label>
  <input type="search" id="search-box" class="search-input" name="s" value="<?php echo get_search_query() ?>"
    placeholder="<?php echo esc_attr_x( 'Search ...', 'placeholder', 'sao' ) ?>" title="<?php echo esc_attr_x( 'Search for:', 'label', 'sao' ) ?>"/>
  <input type="submit" class="search-submit" value="">
  </input>
</form>
