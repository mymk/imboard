<?php while (have_posts()) : the_post(); ?>
  <article <?php post_class(); ?>>

    <figure class="featured">
      <div class="filter" style="background-image:url('<?= wp_get_attachment_url(get_post_thumbnail_id($post->ID)); ?>')"></div>
      <?php the_post_thumbnail('full', ['class' => 'img-responsive']); ?>
    </figure>
    <div class="container">
      <header>
        <h1 class="entry-title"><?php the_title(); ?></h1>
        <?php get_template_part('templates/entry-meta'); ?>
      </header>
      <div class="entry-content">
          <?php the_content(); ?>
      </div>
      <footer>
      <a href="<?php echo get_permalink(get_adjacent_post(false, '', true)); ?>" id="nextPost" class="btn btn-primary btn-lg">next</a>
      <!-- Button trigger modal -->
      <button type="button" class="btn btn-primary btn-lg" data-toggle="modal" data-target="#myModal">
        Commentaires
      </button>

      </footer>
      <?php comments_template('/templates/comments.php'); ?>
    </div>
  </article>
<?php endwhile; ?>
<!-- Modal -->
<div class="modal" id="myModal" tabindex="1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Modal title</h4>
      </div>
      <div class="modal-body">
        <section id="comments" class="comments">
        <?php if (have_comments()) : ?>
          <h2><?php printf(_nx('One response to &ldquo;%2$s&rdquo;', '%1$s responses to &ldquo;%2$s&rdquo;', get_comments_number(), 'comments title', 'sage'), number_format_i18n(get_comments_number()), '<span>'.get_the_title().'</span>'); ?></h2>

          <ol class="comment-list">
            <?php wp_list_comments(['style' => 'ol', 'short_ping' => true]); ?>
          </ol>

          <?php if (get_comment_pages_count() > 1 && get_option('page_comments')) : ?>
            <nav>
              <ul class="pager">
                <?php if (get_previous_comments_link()) : ?>
                  <li class="previous"><?php previous_comments_link(__('&larr; Older comments', 'sage')); ?></li>
                <?php endif; ?>
                <?php if (get_next_comments_link()) : ?>
                  <li class="next"><?php next_comments_link(__('Newer comments &rarr;', 'sage')); ?></li>
                <?php endif; ?>
              </ul>
            </nav>
          <?php endif; ?>
        <?php endif; // have_comments()?>

        <?php if (!comments_open() && get_comments_number() != '0' && post_type_supports(get_post_type(), 'comments')) : ?>
          <div class="alert alert-warning">
            <?php _e('Comments are closed.', 'sage'); ?>
          </div>
        <?php endif; ?>

        <?php comment_form(); ?>
      </section>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save changes</button>
      </div>
    </div>
  </div>
</div>
