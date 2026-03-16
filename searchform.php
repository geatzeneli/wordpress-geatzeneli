<form role="search" method = "get"  action ="<?php echo home_url("/");?>">

<input type="search"
placeholder="search..."
value="<?php echo get_search_query();?>"
name="s" />

<button type="sumbit">
    Search
</button>

</form>