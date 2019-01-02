<?php get_header(); ?>
			
		<div id="content" class="clearfix row padded-top">
			 
			<div class="container">
			
				<div id="main" class="col col-lg-12 clearfix role="main"> 

					<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
					
						<article id="post-<?php the_ID(); ?>" <?php post_class('clearfix'); ?>>
				
							<section class="post_content clearfix" itemprop="articleBody">
								<?php the_content(); ?>
							</section> <!-- end article section -->
						
						</article> <!-- end article -->
					
					
					<?php endwhile;  endif; ?>
			
				</div> <!-- end #main -->
    
			</div>

		</div> <!-- end #content -->
	
	<?php if ( is_singular('campaign') && $post->post_parent > 0 ) { ?>
	
	<?php } else  { ?>
	
		<div id="top-tabbber" class="row clearfix bggray padded-small">
		
			<div class="container">
				
				<div class="col-lg-12 clearfix">
				
					<!-- Nav tabs --> 
					<ul class="nav nav-tabs" role="tablist">
						<li role="presentation" class="active"><a href="#team" aria-controls="team" role="tab" data-toggle="tab" class="hover1">Team Leaderboard </a></li>
						<li role="presentation"><a href="#topindividuals" aria-controls="topindividuals" role="tab" data-toggle="tab" class="hover1">Top Individuals</a></li>
						<li role="presentation"><a href="#sponsors" aria-controls="sponsors" role="tab" data-toggle="tab" class="hover1">Sponsors</a></li>
						<li role="presentation"><a href="#pgallery" aria-controls="pgallery" role="tab" data-toggle="tab" class="hover1">Photo Gallery</a></li>
					</ul>

				  <!-- Tab panes -->
					<div class="tab-content">
						<div role="tabpanel" class="tab-pane active" id="team">
							<?php //echo do_shortcode('[campaigns category=leaderboard columns=4]');?>	
							<?php

							$args = array(
								'post_type'      => 'campaign',
								'posts_per_page' => -1,
								'post_parent'    => $post->ID,
								'order'          => 'ASC',
								'orderby'        => 'menu_order',
								'tax_query' => array(
									array(
										'taxonomy' => 'campaign_category',
										'field'    => 'slug',
										'terms'    => 'leaderboard',
									),
								),								
							 );


							$parent = new WP_Query( $args );

							if ( $parent->have_posts() ) : ?>
								
								<ol class="campaign-loop campaign-grid campaign-grid-4">
									<?php while ( $parent->have_posts() ) : $parent->the_post(); ?>

										<li id="campaign-<?php the_ID(); ?>" class="post-<?php the_ID(); ?> campaign type-campaign status-publish has-post-thumbnail hentry campaign_category-individual campaign-has-goal campaign-has-end-date">
											<a href="<?php the_permalink();?>"> 
												<?php the_post_thumbnail('campaign_thumbnail');?>
												<h5 class="text-center"><?php the_title();?></h5>	
												<div class="campaign-donation-stats"><span class="amount"></span></div>
											</a>																				
										</li>

									<?php endwhile; ?>
								</ol>
							 
							<?php endif; wp_reset_postdata(); ?>							
						</div>
						
						<div role="tabpanel" class="tab-pane" id="topindividuals">
							<?php //echo do_shortcode('[campaigns category=individual columns=4]');?>
							<?php

							$args = array(
								'post_type'      => 'campaign',
								'posts_per_page' => -1,
								'post_parent'    => $post->ID,
								'order'          => 'ASC',
								'orderby'        => 'menu_order',
								'tax_query' => array(
									array(
										'taxonomy' => 'campaign_category',
										'field'    => 'slug',
										'terms'    => 'individual',
									),
								),								
							 );


							$parent = new WP_Query( $args );

							if ( $parent->have_posts() ) : ?>
								
								<ol class="campaign-loop campaign-grid campaign-grid-4">
									<?php while ( $parent->have_posts() ) : $parent->the_post(); ?>

										<li id="campaign-<?php the_ID(); ?>" class="post-<?php the_ID(); ?> campaign type-campaign status-publish has-post-thumbnail hentry campaign_category-individual campaign-has-goal campaign-has-end-date">
											<a href="<?php the_permalink();?>"> 
												<?php the_post_thumbnail('campaign_thumbnail');?>
												<h5 class="text-center"><?php the_title();?></h5>	
												<div class="campaign-donation-stats"><span class="amount"></span></div>
											</a>																				
										</li> 

									<?php endwhile; ?>
								</ol>
							 
							<?php endif; wp_reset_postdata(); ?>							
						</div>
						<div role="tabpanel" class="tab-pane" id="sponsors"><?php echo do_shortcode('[charitable_donors campaign=current show_name=1 show_location=0 show_amount=0 show_avatar=1]');?></div>
						<div role="tabpanel" class="tab-pane" id="pgallery">...</div>
					</div>
				</div>
			</div>
		</div>
		
	<?php };?>
			
<?php get_footer(); ?>