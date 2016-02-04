<?php
/*
Template Name: Colecciones
*/
get_header();
?>

<!-- main content -->

<main id="main-content">

  <!-- main posts loop -->
  <section id="posts" class="container">
<?php
  $categories = get_terms('category', array('orderby' => 'id', 'hide_empty' => true));

  if ($categories) {
    foreach($categories as $i => $category) {
?>
    <div class="row collection">
<?php
      if ($i % 2 !== 0) {
?>
      <div class="col col-8">
        <h2><?php echo $category->name; ?></h2>
        <p><?php echo $category->description; ?></p>
      </div>
<?php
      } else {
?>
      <div class="col col-2"></div>
      <div class="col col-6">
        <h2><?php echo $category->name; ?></h2>
        <p><?php echo $category->description; ?></p>
      </div>
<?php
      }
      $books = get_posts(array(
        'category' => $category->term_taxonomy_id,
      ));

      if ($books) {
?>
       <div class="col col-4">
        <h2>Titulos</h2>
<?php
        foreach ($books as $book) {
          $releaseDate = get_post_meta($book->ID, '_igv_release_date');
          if (!empty($releaseDate)) {

            if (qtranxf_getLanguage() == 'es') {
              $locale = 'es_ES';
            } else {
              $locale = 'en_US';
            }

            \Moment\Moment::setLocale($locale);
            $m = new \Moment\Moment($releaseDate[0]);
?>

            <div class="collection-book u-cf">
              <div class="book-image"><a href="<?php echo get_permalink($book->ID); ?>"><?php echo get_the_post_thumbnail($book->ID, 'book-cover'); ?></a></div>
              <span class="book-date"><?php echo $m->format('M Y'); ?></span>
              <a href="<?php echo get_permalink($book->ID); ?>"><?php echo $book->post_title; ?></a>
            </div>
<?php
          } else {
?>
            <div class="collection-book u-cf">
              <div class="book-image"><img src="<?php bloginfo('stylesheet_directory'); ?>/img/dist/e-mp-blank.jpg" /></div>
              <span class="book-date">Próximo</span>
              <?php echo $book->post_title; ?>
            </div>
<?php
          }
        }
?>
      </div>
<?php
      }
?>
    </div>
<?php
    }
  }
?>

  <!-- end posts -->
  </section>

<!-- end main-content -->

</main>

<?php
get_footer();
?>