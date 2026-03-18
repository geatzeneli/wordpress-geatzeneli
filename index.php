<?php get_header(); ?>

<main class="container my-5">
    <header class="mb-4">
        <h2 class="display-4">Hello Digital School Students</h2>
        <p class="lead">This is our custom WordPress theme.</p>
    </header>

    <div class="row">
        <div class="col-md-8">
            <?php if ( have_posts() ) : ?>
                <?php while ( have_posts() ) : the_post(); ?>
                    <article id="post-<?php the_ID(); ?>" <?php post_class('mb-5 shadow-sm p-3 bg-white rounded'); ?>>
                        <h2 class="text-primary"><?php the_title(); ?></h2>
                        <p class="text-muted small">
                            Posted on <?php echo get_the_date(); ?> 
                            at <?php the_time(); ?> 
                            in <?php the_category(', '); ?>
                        </p>
                        <div class="entry-content">
                            <?php the_content(); ?>
                        </div>
                    </article>
                <?php endwhile; ?>

                <div class="pagination my-4">
                    <?php 
                    the_posts_pagination( array(
                        'mid_size'  => 2,
                        'prev_text' => '&laquo; Previous',
                        'next_text' => 'Next &raquo;',
                        'class'     => 'pagination-container'
                    )); 
                    ?>
                </div>

            <?php else : ?>
                <p>No posts found.</p>
            <?php endif; ?>
        </div>

        <div class="col-md-4">
            <?php if ( is_active_sidebar( 'sidebar-1' ) ) : ?>
                <?php dynamic_sidebar( 'sidebar-1' ); ?>
            <?php else : ?>
                <div class="alert alert-info">Add widgets to "Primary Sidebar" in your admin panel!</div>
            <?php endif; ?>
        </div>
    </div>
</main>

<section class="container py-5 border-top">
    <h1 class="text-center text-primary mb-4">Bootstrap is Working</h1>
    <div class="text-center mb-5">
        <button class="btn btn-success btn-lg">Click Me</button>
    </div>

    <div class="row text-center text-white font-weight-bold">
        <div class="col-md-6 bg-primary py-4">
            Left Column
        </div>
        <div class="col-md-6 bg-warning py-4 text-dark">
            Right Column
        </div>
    </div>

    <div class="row mt-5 justify-content-center">
        <div class="card" style="width: 18rem;">
            <div class="card-body">
                <h5 class="card-title">Card Title</h5>
                <p class="card-text">Example card text for the Digital School project.</p>
                <a href="#" class="btn btn-primary btn-block">Go somewhere</a>
            </div>
        </div>
    </div>
</section>

<?php get_footer(); ?>