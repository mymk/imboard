<article <?php post_class(); ?>>
	<figure>
		<?php the_post_thumbnail('medium' , ['class' => 'img-responsive']); ?>
		<figcaption>

			<h2 class="entry-title"><?php the_title(); ?></h2>
	    	<?php get_template_part('templates/entry-meta'); ?>

	    </figcaption>
	    <a href="<?php the_permalink(); ?>" class="cover--link"></a>
	</figure>
</article>
