<form action="/" method="get">
  <fieldset>

    <div class="input-group">
      <input id="search" type="text" class="form-control" name="s" value="<?php the_search_query(); ?>" placeholder="Sök tyger här"  />
      <span class="input-group-btn">
         <button class="btn btn-default" type="submit"><i class="glyphicon glyphicon-search"> </i></button>
      </span>
    </div>

   <!--
    <input type="hidden" name="post_type" value="wpboot_tyger" />
    -->
  </fieldset>
</form>