<?php
/**
 * Template Name: Kategori Konten Khusus
 *
 * @package Paijo
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

get_header();
?>

<main id="main-content" class="paijo-section bg-paijo-card text-paijo-ink transition-colors duration-300 min-h-screen">
	<div class="paijo-container">
		
		<!-- Breadcrumbs -->
		<nav class="flex items-center gap-2 text-[10px] sm:text-xs font-bold text-neutral-400 uppercase tracking-widest mb-4" aria-label="Breadcrumb">
			<a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="hover:text-paijo-accent transition-colors">Home</a>
			<span class="text-neutral-300" aria-hidden="true">/</span>
			<span class="text-neutral-500"><?php esc_html_e( 'Kategori Konten Khusus', 'paijo' ); ?></span>
		</nav>

		<!-- Header -->
		<div class="max-w-3xl mb-12 border-b border-neutral-100 dark:border-neutral-800/60 pb-8">
			<span class="inline-block bg-[#f1818f] text-white px-3 py-1 rounded-full text-[10px] font-black uppercase tracking-[0.15em] mb-3">
				<?php esc_html_e( 'Rubrik Spesial', 'paijo' ); ?>
			</span>
			<h1 class="text-3xl sm:text-4xl lg:text-5xl font-sans font-extrabold text-paijo-ink leading-tight mb-4">
				<?php esc_html_e( 'Kategori Konten Khusus', 'paijo' ); ?>
			</h1>
			<p class="text-paijo-muted text-sm sm:text-base leading-relaxed">
				<?php esc_html_e( 'Jelajahi berbagai liputan khas, kisah kebudayaan, sorotan skena lokal, serta riwayat kuliner istimewa Yogyakarta yang ditulis secara mendalam.', 'paijo' ); ?>
			</p>
		</div>

		<!-- Categories Grid -->
		<?php
		$terms = get_terms( array(
			'taxonomy'   => 'paijo_content_category',
			'hide_empty' => false,
		) );

		if ( ! empty( $terms ) && ! is_wp_error( $terms ) ) :
			?>
			<div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
				<?php
				foreach ( $terms as $term ) :
					$term_link = get_term_link( $term );
					if ( is_wp_error( $term_link ) ) {
						continue;
					}

					// Get latest post in this category for background image
					$latest_post = paijo_get_latest_content_for_category( $term->term_id );
					$bg_image    = '';
					if ( $latest_post ) {
						$bg_image = paijo_get_thumbnail_url( $latest_post->ID, 'paijo-card' );
					}
					?>
					<a class="group relative aspect-square w-full overflow-hidden bg-paijo-ink text-white flex flex-col justify-end p-6 sm:p-8 rounded-lg shadow-sm border border-neutral-100 dark:border-neutral-800" href="<?php echo esc_url( $term_link ); ?>">
						<!-- Background Image -->
						<?php if ( $bg_image ) : ?>
							<img class="absolute inset-0 h-full w-full object-cover transition-transform duration-700 group-hover:scale-105 opacity-40 group-hover:opacity-55" src="<?php echo esc_url( $bg_image ); ?>" alt="<?php echo esc_attr( $term->name ); ?>">
						<?php else : ?>
							<div class="absolute inset-0 bg-[#050b14] transition-colors duration-700 group-hover:bg-[#0c1424]"></div>
						<?php endif; ?>

						<!-- Dark Gradient Overlay -->
						<div class="absolute inset-0 bg-gradient-to-t from-[#050b14]/95 via-[#050b14]/50 to-transparent z-0"></div>

						<!-- Card Content -->
						<div class="relative z-10">
							<!-- Article Count Badge -->
							<span class="inline-block bg-[#f1818f] text-white text-[9px] font-black px-2 py-0.5 rounded-full uppercase tracking-wider mb-2">
								<?php echo esc_html( sprintf( _n( '%d Artikel', '%d Artikel', $term->count, 'paijo' ), $term->count ) ); ?>
							</span>
							
							<!-- Title -->
							<h3 class="text-xl sm:text-2xl font-sans font-black leading-tight tracking-tight text-white mb-2 transition-colors group-hover:text-[#f1818f]">
								<?php echo esc_html( $term->name ); ?>
							</h3>

							<!-- Description -->
							<?php if ( ! empty( $term->description ) ) : ?>
								<p class="text-xs sm:text-sm text-neutral-300 line-clamp-2 leading-relaxed opacity-95 group-hover:opacity-100">
									<?php echo esc_html( $term->description ); ?>
								</p>
							<?php else : ?>
								<p class="text-xs sm:text-sm text-neutral-400 italic line-clamp-2 leading-relaxed">
									<?php esc_html_e( 'Jelajahi rubrik ini lebih lanjut.', 'paijo' ); ?>
								</p>
							<?php endif; ?>
						</div>
					</a>
				<?php endforeach; ?>
			</div>
		<?php else : ?>
			<div class="max-w-md mx-auto py-12 text-center">
				<p class="text-lg font-bold text-paijo-muted mb-4">
					<?php esc_html_e( 'Tidak ada kategori konten khusus yang ditemukan.', 'paijo' ); ?>
				</p>
			</div>
		<?php endif; ?>

	</div>
</main>

<?php
get_footer();
