<?php
/* Template Name: User Settings Page */
get_header();

// Handle the form submission
if (isset($_POST['set_post_limit'])) {
    session_start();
    $_SESSION['user_post_limit'] = intval($_POST['post_limit']);
    echo '<div class="alert alert-success mt-3 text-center">Settings Saved!</div>';
}
?>

<main class="container my-5">
    <div class="row justify-content-center">
        <div class="col-md-6 card shadow p-4">
            <h2 class="text-center mb-4">Display Settings</h2>
            <p class="text-center text-muted">Choose how many posts you want to see per page.</p>
            
            <form method="post" class="text-center">
                <div class="form-group">
                    <select name="post_limit" class="form-control form-control-lg">
                        <option value="3">3 Posts per page</option>
                        <option value="5">5 Posts per page</option>
                        <option value="10">10 Posts per page</option>
                    </select>
                </div>
                <button type="submit" name="set_post_limit" class="btn btn-primary btn-block btn-lg">Save My Preference</button>
            </form>
            
            <div class="text-center mt-3">
                <a href="<?php echo home_url(); ?>" class="btn btn-link">← Back to Homepage</a>
            </div>
        </div>
    </div>
</main>

<?php get_footer(); ?>