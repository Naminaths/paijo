<?php
/**
 * Template Name: Kebijakan Cookies
 *
 * @package Paijo
 */

get_header();

$site_name   = get_bloginfo( 'name' );
$site_url    = get_site_url();
$admin_email = get_option( 'admin_email' );
?>

<main id="main-content" class="paijo-section bg-paijo-paper min-h-screen">
	<div class="paijo-container py-12">
		<?php
		while ( have_posts() ) :
			the_post();
			?>
			<article <?php post_class( 'mx-auto max-w-4xl bg-white dark:bg-neutral-900 border border-paijo-line rounded-3xl p-8 sm:p-12 shadow-sm' ); ?>>
				
				<!-- Header Section -->
				<div class="text-center mb-12 pb-8 border-b border-paijo-line">
					<span class="inline-block bg-[#f1818f]/10 text-[#f1818f] text-xs font-black uppercase tracking-[0.15em] px-4 py-1.5 rounded-full mb-4">
						Legal & Privasi
					</span>
					<h1 class="text-4xl md:text-5xl font-sans font-black tracking-tight text-paijo-ink mb-4">
						<?php 
						$title = get_the_title();
						echo esc_html( $title ? $title : 'Kebijakan Cookies' ); 
						?>
					</h1>
					<p class="text-paijo-muted text-base">Terakhir diperbarui: <?php echo get_the_modified_date( 'd F Y' ); ?></p>
				</div>

				<!-- Content Section -->
				<div class="paijo-prose prose-lg dark:prose-invert max-w-none text-paijo-ink space-y-6">
					
					<?php 
					$content = get_the_content();
					if ( ! empty( $content ) ) : 
						// Jika user mengisi konten di editor, tampilkan konten tersebut
						the_content();
					else : 
						// Konten Dinamis Default jika editor WordPress dibiarkan kosong
					?>
						<p>Kebijakan Cookies ini menjelaskan apa itu cookies dan bagaimana <strong><?php echo esc_html( $site_name ); ?></strong> menggunakannya di website <a href="<?php echo esc_url( $site_url ); ?>" class="text-[#f1818f] hover:underline"><?php echo esc_url( $site_url ); ?></a>. Anda disarankan untuk membaca kebijakan ini agar Anda dapat memahami jenis cookie apa yang kami gunakan, informasi yang kami kumpulkan menggunakan cookie, dan bagaimana informasi tersebut diproses.</p>

						<h3 class="text-2xl font-black mt-10 mb-4">Apa itu Cookies?</h3>
						<p>Cookies adalah file teks kecil yang dikirim ke browser web Anda oleh situs web yang Anda kunjungi. File cookie disimpan di perangkat Anda dan memungkinkan layanan kami (atau pihak ketiga penyedia layanan) untuk mengenali Anda, membuat kunjungan Anda berikutnya lebih mudah, dan layanan kami lebih personal bagi Anda.</p>

						<h3 class="text-2xl font-black mt-10 mb-4">Bagaimana <?php echo esc_html( $site_name ); ?> Menggunakan Cookies</h3>
						<p>Saat Anda menggunakan dan mengakses website kami, kami mungkin menempatkan sejumlah file cookie di web browser Anda. Kami menggunakan cookie untuk tujuan esensial dan fungsional berikut:</p>
						<ul class="list-disc pl-6 space-y-2 mt-4 mb-6">
							<li><strong>Cookie Esensial:</strong> Cookie yang sangat diperlukan untuk pengoperasian situs web kami. Ini termasuk cookie yang memungkinkan Anda untuk masuk ke area aman di situs web kami.</li>
							<li><strong>Cookie Analitik / Kinerja:</strong> Membantu kami mengenali dan menghitung jumlah pengunjung dan melihat bagaimana pengunjung bergerak di sekitar situs web saat menggunakannya. Ini membantu kami memperbaiki cara kerja situs web.</li>
							<li><strong>Cookie Fungsionalitas:</strong> Digunakan untuk mengenali Anda saat Anda kembali ke situs web. Ini memungkinkan kami mempersonalisasi konten untuk Anda dan mengingat preferensi Anda.</li>
							<li><strong>Cookie Pihak Ketiga:</strong> Selain cookie kami sendiri, kami mungkin juga menggunakan berbagai cookie dari pihak ketiga untuk melaporkan statistik lalu lintas dan menayangkan iklan fungsional.</li>
						</ul>

						<h3 class="text-2xl font-black mt-10 mb-4">Pilihan Anda Terkait Cookies</h3>
						<p>Jika Anda ingin menghapus cookie atau menginstruksikan browser web Anda untuk selalu menghapus atau menolak cookie secara otomatis, silakan kunjungi halaman bantuan pada pengaturan browser web Anda.</p>
						<p>Harap diperhatikan bahwa jika Anda menghapus cookie atau menolak untuk menerimanya, Anda mungkin tidak dapat menggunakan semua fitur interaktif yang kami tawarkan, dan beberapa halaman mungkin tidak ditampilkan dengan semestinya.</p>

						<h3 class="text-2xl font-black mt-10 mb-4">Hubungi Kami</h3>
						<p>Jika Anda memiliki pertanyaan tentang Kebijakan Cookies kami atau bagaimana kami menangani data Anda, silakan hubungi administrator kami melalui email di: <a href="mailto:<?php echo esc_attr( $admin_email ); ?>" class="text-[#f1818f] font-bold hover:underline"><?php echo esc_html( $admin_email ); ?></a>.</p>
					<?php endif; ?>

				</div>
			</article>
		<?php endwhile; ?>
	</div>
</main>

<?php
get_footer();
