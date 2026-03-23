<?php get_header(); ?>

<div class="container my-5">
    <?php
    if ( have_posts() ) :
        while ( have_posts() ) : the_post();
    ?>

        <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
            <div class="row">
                
                <div class="col-md-4 mb-4">
                    <?php if ( has_post_thumbnail() ) : ?>
                        <div class="movie-poster shadow-sm">
                            <?php the_post_thumbnail('large', array('class' => 'img-fluid rounded')); ?>
                        </div>
                    <?php else : ?>
                        <div class="bg-light d-flex align-items-center justify-content-center rounded" style="height: 450px;">
                            <p class="text-muted">No Poster Available</p>
                        </div>
                    <?php endif; ?>
                </div>

                <div class="col-md-8">
                    <header class="entry-header mb-3">
                        <h1 class="display-4"><?php the_title(); ?></h1>
                        <hr>
                    </header>

                    <div class="movie-description entry-content">
                        <h4 class="text-uppercase text-muted small font-weight-bold">Synopsis</h4>
                        <?php the_content(); ?>
                    </div>

                    <?php 
                    // Example: If you use Advanced Custom Fields (ACF) for movie metadata
                    // $director = get_field('director');
                    // if( $director ): echo '<p><strong>Director:</strong> ' . $director . '</p>'; endif;
                    ?>
                </div>
            </div>
        </article>

        <hr class="my-5">

        <div class="row">
            <div class="col-12">
                <?php
                if ( comments_open() || get_comments_number() ) :
                    comments_template();
                endif;
                ?>
            </div>
        </div>

    <?php
        endwhile;
    endif;
    ?>
</div>

<?php get_footer(); ?>