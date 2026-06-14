<?php
/**
 * Tag archive template (Kumparan Topic Style).
 *
 * @package Paijo
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

get_header();

$tag_id       = get_queried_object_id();
$current_tag  = get_queried_object();
$paged        = ( get_query_var( 'paged' ) ) ? get_query_var( 'paged' ) : 1;
$total_posts  = $GLOBALS['wp_query']->found_posts;
?>

<main id="main-content" class="paijo-section bg-paijo-card text-paijo-ink transition-colors duration-300 min-h-screen">
	<div class="paijo-container max-w-6xl mx-auto">
		
		<!-- Breadcrumbs -->
		<nav class="flex items-center gap-2 text-[10px] sm:text-xs font-bold text-neutral-400 uppercase tracking-widest mb-6" aria-label="Breadcrumb">
			<a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="hover:text-paijo-accent transition-colors">Home</a>
			<span class="text-neutral-300" aria-hidden="true">/</span>
			<span class="text-neutral-400"><?php esc_html_e( 'Topic', 'paijo' ); ?></span>
			<span class="text-neutral-300" aria-hidden="true">/</span>
			<span class="text-neutral-500"><?php echo esc_html( $current_tag->name ); ?></span>
		</nav>

		<!-- Kumparan Topic Header Section -->
		<div class="bg-white dark:bg-neutral-900 border border-neutral-100 dark:border-neutral-800/80 rounded-2xl p-6 sm:p-8 mb-10 flex flex-col md:flex-row md:items-center md:justify-between gap-6 shadow-[0_4px_20px_rgba(0,0,0,0.02)] transition-colors duration-300">
			<div class="flex items-start sm:items-center gap-5">
				<!-- Topic Circle Icon -->
				<div class="w-14 h-14 sm:w-16 sm:h-16 rounded-full bg-[#f1818f]/10 dark:bg-[#f1818f]/20 flex items-center justify-center text-[#f1818f] font-sans font-black text-2xl sm:text-3xl shrink-0">
					#
				</div>
				
				<div>
					<h1 class="text-2xl sm:text-3xl lg:text-4xl font-sans font-black text-paijo-ink leading-tight mb-2">
						<?php echo esc_html( $current_tag->name ); ?>
					</h1>
					<div class="flex flex-wrap items-center gap-x-4 gap-y-1 text-xs text-paijo-muted font-bold uppercase tracking-wider">
						<span><?php echo esc_html( sprintf( _n( '%d Cerita', '%d Cerita', $total_posts, 'paijo' ), $total_posts ) ); ?></span>
						<?php if ( ! empty( $current_tag->description ) ) : ?>
							<span class="text-neutral-300" aria-hidden="true">•</span>
							<span class="normal-case font-medium text-paijo-muted max-w-xl truncate inline-block"><?php echo esc_html( $current_tag->description ); ?></span>
						<?php endif; ?>
					</div>
				</div>
			</div>

			<!-- Pill Interactive Follow Button -->
			<div class="shrink-0 self-start md:self-auto">
				<button id="topic-follow-btn" class="px-6 py-2.5 rounded-full border border-[#f1818f] text-[#f1818f] hover:bg-[#f1818f] hover:text-white font-sans font-extrabold text-xs uppercase tracking-wider transition-all duration-300 cursor-pointer shadow-sm focus:outline-none" aria-pressed="false">
					<?php esc_html_e( 'Ikuti', 'paijo' ); ?>
				</button>
			</div>
		</div>

		<!-- Main Split Layout Grid -->
		<div class="grid grid-cols-1 lg:grid-cols-3 gap-10">
			
			<!-- Left Column: Vertical Article List (Kumparan Style) -->
			<div class="lg:col-span-2">
				<?php if ( have_posts() ) : ?>
					<div class="divide-y divide-neutral-100 dark:divide-neutral-800/80 -mt-6">
						<?php
						while ( have_posts() ) :
							the_post();
							$thumbnail = paijo_get_thumbnail_url( get_the_ID(), 'paijo-card' );
							$category  = paijo_get_category_label();
							$relative_date = human_time_diff( get_the_time( 'U' ), current_time( 'timestamp' ) ) . ' yang lalu';
							?>
							<article class="flex gap-4 sm:gap-6 py-6 sm:py-8 items-start justify-between group">
								<div class="flex-1 min-w-0">
									<!-- Category Badge -->
									<span class="text-[10px] font-black uppercase text-[#f1818f] tracking-widest mb-2 inline-block">
										<?php echo esc_html( $category ); ?>
									</span>

									<!-- Title -->
									<h2 class="text-base sm:text-xl font-sans font-black leading-snug tracking-tight mb-2 text-paijo-ink hover:text-[#f1818f] transition-colors duration-200">
										<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
									</h2>

									<!-- Excerpt -->
									<p class="text-xs sm:text-sm text-paijo-muted line-clamp-2 leading-relaxed mb-4">
										<?php echo esc_html( paijo_get_card_excerpt( get_the_ID(), 22 ) ); ?>
									</p>

									<!-- Meta Row -->
									<div class="flex items-center gap-2.5 text-[10px] sm:text-xs text-paijo-muted font-semibold">
										<!-- Author Avatar -->
										<img class="w-5 h-5 rounded-full object-cover bg-neutral-200" src="<?php echo esc_url( get_avatar_url( get_the_author_meta( 'ID' ), 40 ) ); ?>" alt="<?php echo esc_attr( get_the_author() ); ?>">
										
										<span class="font-bold text-paijo-ink"><?php echo esc_html( get_the_author() ); ?></span>
										<span class="text-neutral-300" aria-hidden="true">•</span>
										<time datetime="<?php echo esc_attr( get_the_date( DATE_W3C ) ); ?>"><?php echo esc_html( $relative_date ); ?></time>
										<span class="text-neutral-300" aria-hidden="true">•</span>
										<span><?php echo esc_html( paijo_get_reading_time() ); ?></span>
									</div>
								</div>

								<!-- Right Side Image Thumbnail -->
								<?php if ( $thumbnail ) : ?>
									<a href="<?php the_permalink(); ?>" class="block w-24 h-24 sm:w-32 sm:h-32 shrink-0 overflow-hidden rounded-xl border border-neutral-100 dark:border-neutral-800/80 bg-neutral-50 dark:bg-neutral-900 transition-colors duration-300">
										<img class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-105" src="<?php echo esc_url( $thumbnail ); ?>" alt="<?php echo esc_attr( get_the_title() ); ?>">
									</a>
								<?php endif; ?>
							</article>
						<?php endwhile; ?>
					</div>

					<!-- Custom Styled Pagination -->
					<?php
					$big        = 999999999;
					$pagination = paginate_links( array(
						'base'      => str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) ),
						'format'    => '?paged=%#%',
						'current'   => max( 1, $paged ),
						'total'     => $GLOBALS['wp_query']->max_num_pages,
						'prev_text' => '&larr; Prev',
						'next_text' => 'Next &rarr;',
						'type'      => 'array',
					) );

					if ( ! empty( $pagination ) ) :
						?>
						<nav class="flex justify-center items-center gap-2 mt-10 border-t border-neutral-100 dark:border-neutral-800/80 pt-10" aria-label="<?php esc_attr_e( 'Page navigation', 'paijo' ); ?>">
							<?php
							foreach ( $pagination as $page_link ) :
								if ( strpos( $page_link, 'current' ) !== false ) {
									$page_link = str_replace( "class='page-numbers current'", "class='px-4 py-2 rounded-lg bg-paijo-accent text-white font-extrabold shadow-sm'", $page_link );
								} else {
									$page_link = str_replace( "class='page-numbers'", "class='px-4 py-2 rounded-lg bg-white dark:bg-neutral-900 border border-neutral-200 dark:border-neutral-800 text-paijo-ink font-bold hover:bg-neutral-50 dark:hover:bg-neutral-800 transition-colors'", $page_link );
									$page_link = str_replace( "class='prev page-numbers'", "class='px-4 py-2 rounded-lg bg-white dark:bg-neutral-900 border border-neutral-200 dark:border-neutral-800 text-paijo-ink font-bold hover:bg-neutral-50 dark:hover:bg-neutral-800 transition-colors'", $page_link );
									$page_link = str_replace( "class='next page-numbers'", "class='px-4 py-2 rounded-lg bg-white dark:bg-neutral-900 border border-neutral-200 dark:border-neutral-800 text-paijo-ink font-bold hover:bg-neutral-50 dark:hover:bg-neutral-800 transition-colors'", $page_link );
								}
								echo $page_link;
							endforeach;
							?>
						</nav>
					<?php endif; ?>

				<?php else : ?>
					<div class="py-12 text-center bg-white dark:bg-neutral-900 border border-neutral-100 dark:border-neutral-800/80 rounded-2xl p-8 transition-colors duration-300">
						<p class="text-lg font-bold text-paijo-muted mb-4">
							<?php esc_html_e( 'Tidak ada cerita yang ditemukan untuk topik ini.', 'paijo' ); ?>
						</p>
						<a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="inline-block px-6 py-2.5 bg-[#f1818f] text-white font-bold rounded-full hover:bg-[#e06d7c] transition-colors shadow-sm">
							<?php esc_html_e( 'Kembali ke Beranda', 'paijo' ); ?>
						</a>
					</div>
				<?php endif; ?>
			</div>

			<!-- Right Column: Sidebar (Widgets) -->
			<div class="lg:col-span-1 space-y-10">
				
				<!-- Widget: Artikel Terpopuler (Kumparan Style) -->
				<?php
				$popular_query = new WP_Query( array(
					'post_type'           => 'post',
					'post_status'         => 'publish',
					'posts_per_page'      => 5,
					'orderby'             => 'comment_count',
					'order'               => 'DESC',
					'ignore_sticky_posts' => true,
				) );

				if ( $popular_query->have_posts() ) :
					?>
					<div class="bg-white dark:bg-neutral-900 border border-neutral-100 dark:border-neutral-800/80 rounded-2xl p-6 shadow-[0_4px_20px_rgba(0,0,0,0.01)] transition-colors duration-300">
						<div class="flex items-center gap-2 mb-6 border-b border-neutral-100 dark:border-neutral-800/60 pb-3">
							<!-- Flame SVG Icon -->
							<svg class="w-5 h-5 text-[#f1818f] fill-none stroke-current" stroke-width="2" viewBox="0 0 24 24" stroke-linecap="round" stroke-linejoin="round">
								<path d="M8.5 14.5A2.5 2.5 0 0 0 11 12c0-1.38-.5-2-1-3-1.072-2.143-.224-4.054 2-6 .5 2.5 2 4.9 4 6.5 2 1.6 3 3.5 3 5.5a7 7 0 1 1-14 0c0-1.153.433-2.294 1-3a2.5 2.5 0 0 0 2.5 2.5z"></path>
							</svg>
							<h3 class="text-sm font-black uppercase tracking-wider text-paijo-ink">
								<?php esc_html_e( 'Cerita Populer', 'paijo' ); ?>
							</h3>
						</div>

						<div class="divide-y divide-neutral-100 dark:divide-neutral-800/60 -my-4">
							<?php
							$rank = 0;
							while ( $popular_query->have_posts() ) :
								$popular_query->the_post();
								$rank++;
								$category = paijo_get_category_label();
								$rank_formatted = sprintf( '%02d', $rank );
								?>
								<div class="flex items-start gap-4 py-4 group">
									<!-- Giant Number -->
									<span class="text-2xl font-sans font-black text-[#f1818f]/20 group-hover:text-[#f1818f] transition-colors leading-none">
										<?php echo esc_html( $rank_formatted ); ?>
									</span>
									<div class="min-w-0">
										<!-- Category -->
										<span class="text-[9px] font-black uppercase text-[#f1818f]/70 tracking-widest block mb-1">
											<?php echo esc_html( $category ); ?>
										</span>
										<!-- Title -->
										<h4 class="text-sm font-bold text-paijo-ink leading-snug group-hover:text-[#f1818f] transition-colors duration-200">
											<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
										</h4>
									</div>
								</div>
							<?php endwhile; ?>
						</div>
					</div>
					<?php wp_reset_postdata(); ?>
				<?php endif; ?>

				<!-- Widget: Topik Terkait (Related Topics List) -->
				<?php
				$related_tags = get_tags( array(
					'number'  => 8,
					'orderby' => 'count',
					'order'   => 'DESC',
					'exclude' => array( $tag_id ),
				) );

				if ( ! empty( $related_tags ) && ! is_wp_error( $related_tags ) ) :
					?>
					<div class="bg-white dark:bg-neutral-900 border border-neutral-100 dark:border-neutral-800/80 rounded-2xl p-6 shadow-[0_4px_20px_rgba(0,0,0,0.01)] transition-colors duration-300">
						<div class="flex items-center gap-2 mb-4 border-b border-neutral-100 dark:border-neutral-800/60 pb-3">
							<!-- Hashtag SVG Icon -->
							<svg class="w-4 h-4 text-[#f1818f] fill-none stroke-current" stroke-width="2.5" viewBox="0 0 24 24" stroke-linecap="round" stroke-linejoin="round">
								<line x1="4" y1="9" x2="20" y2="9"></line>
								<line x1="4" y1="15" x2="20" y2="15"></line>
								<line x1="10" y1="3" x2="8" y2="21"></line>
								<line x1="16" y1="3" x2="14" y2="21"></line>
							</svg>
							<h3 class="text-sm font-black uppercase tracking-wider text-paijo-ink">
								<?php esc_html_e( 'Topik Terkait', 'paijo' ); ?>
							</h3>
						</div>

						<div class="flex flex-wrap gap-2 mt-4">
							<?php foreach ( $related_tags as $rel_tag ) : ?>
								<a href="<?php echo esc_url( get_tag_link( $rel_tag->term_id ) ); ?>" class="px-3 py-1.5 bg-neutral-50 dark:bg-neutral-950 hover:bg-[#f1818f] dark:hover:bg-[#f1818f] hover:text-white dark:hover:text-white text-paijo-muted hover:border-[#f1818f] border border-neutral-100 dark:border-neutral-800/60 rounded-full text-xs font-bold transition-all duration-200">
									# <?php echo esc_html( $rel_tag->name ); ?>
								</a>
							<?php endforeach; ?>
						</div>
					</div>
				<?php endif; ?>

			</div>
			
		</div>
	</div>
</main>

<!-- Interactive Follow Button micro-interaction Script -->
<script>
document.addEventListener('DOMContentLoaded', function() {
	const followBtn = document.getElementById('topic-follow-btn');
	const tagId = '<?php echo esc_js( $tag_id ); ?>';
	const followKey = `paijo_topic_followed_${tagId}`;

	if (!followBtn) {
		return;
	}

	// Read state
	let isFollowing = localStorage.getItem(followKey) === '1';

	function setFollowState(state) {
		isFollowing = state;
		if (isFollowing) {
			followBtn.setAttribute('aria-pressed', 'true');
			followBtn.textContent = 'Mengikuti';
			followBtn.classList.remove('text-[#f1818f]', 'border-[#f1818f]');
			followBtn.classList.add('bg-[#f1818f]', 'text-white', 'border-transparent');
		} else {
			followBtn.setAttribute('aria-pressed', 'false');
			followBtn.textContent = 'Ikuti';
			followBtn.classList.remove('bg-[#f1818f]', 'text-white', 'border-transparent');
			followBtn.classList.add('text-[#f1818f]', 'border-[#f1818f]');
		}
	}

	// Init
	setFollowState(isFollowing);

	// Toggle on click
	followBtn.addEventListener('click', function() {
		const nextState = !isFollowing;
		localStorage.setItem(followKey, nextState ? '1' : '0');
		setFollowState(nextState);
	});
});
</script>

<?php
get_footer();
