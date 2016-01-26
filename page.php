<?php
get_header();
?>

<!-- main content -->

<main id="main-content">

  <!-- main posts loop -->
  <section id="posts" class="container">
<?php
if( have_posts() ) {
  while( have_posts() ) {
    the_post();
?>
    <article <?php post_class('row'); ?> id="post-<?php the_ID(); ?>">
      <div class="col col-12">
        <?php the_content(); ?>
      </div>
    </article>

<?php
  }
} else {
?>
    <div class="row">
      <div class="col col-12 u-alert"><?php _e('Sorry, no posts matched your criteria'); ?></div>
    </div>
<?php
} ?>

  <!-- end posts -->
  </section>

<!-- end main-content -->

</main>

<?php
get_footer();
?>