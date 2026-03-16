<?php get_header(); ?>

<div class="wrap">
    <div id="primary" class="content-area">
        <main id="main" class="site-main">
            
            <h1>Search Results</h1>

            <?php
            global $wp_query;
            $total_results = $wp_query->found_posts;
            ?>

            <p><?php echo $total_results; ?> results found</p>

            <?php if ( have_posts() ) : ?>
                
                <?php while ( have_posts() ) : the_post(); ?>

                    <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
                        <h2>
                            <a href="<?php the_permalink(); ?>">
                                <?php the_title(); ?>
                            </a>
                        </h2>

                        <div class="entry-summary">
                            <?php the_excerpt(); ?>
                        </div>
                    </article>

                <?php endwhile; ?>

                <?php 
                // Optional: Adds pagination links if there are multiple pages
                the_posts_pagination(); 
                ?>

            <?php else : ?>

                <p>No results found for your search criteria. Please try again with different keywords.</p>
                <?php get_search_form(); ?>

            <?php endif; ?>

        </main></div></div><?php get_footer(); ?>