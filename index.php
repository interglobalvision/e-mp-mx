<?php
get_header();
?>

<!-- main content -->

<main id="main-content">

  <!-- main posts loop -->
  <section id="posts" class="container">
<?php
  $categories = get_terms('category', array('orderby' => 'id', 'hide_empty' => false));

  if ($categories) {
    $i = 1;
    foreach($categories as $category) {
?>
    <div class="row">
<?php
      if ($i % 2 === 0) {
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
        <h3>Titulos</h3>
<?php
        foreach ($books as $book) {
          $releaseDate = get_post_meta($book->ID, '_igv_release_date');
          if (!empty($releaseDate)) {

            $date = date_create_from_format('d/m/Y', $releaseDate);

            if (qtranxf_getLanguage() == 'es') {
              $locale = 'es_ES';
            } else {
              $locale = 'en_US';
            }

            \Moment\Moment::setLocale($locale);
            $m = new \Moment\Moment($date);

            echo '<div class="collection-book">';
            echo '<span class="book-date">' . $m->format('M Y') . '</span>';
            echo '<a href="' . get_permalink($book->ID) . '">' . $book->post_title . '</a>';
            echo '</div>';
          } else {
            echo '<div class="collection-book">';
            echo '<span class="book-date">Próximo</span>';
            echo $book->post_title;
            echo '</div>';
          }
        }
?>
      </div>
<?php
      }
?>
    </div>
<?php
      $i++;
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