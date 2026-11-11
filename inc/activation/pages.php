<?php
/**
 * Theme activation: pages auto create + front page / blog page set.
 *
 * Theme activate hote hi ye pages ban jate hain (agar pehle se na hon):
 * Home, About Us, Blogs, Contact Us, Start a Project, Thank You,
 * Privacy Policy, Terms and Conditions, Cookie Policy, Disclaimer.
 *
 * Home -> front page (blog nahi)
 * Blogs -> posts page
 *
 * @package Alify
 */

defined( 'ABSPATH' ) || exit;

/**
 * Auto-create pages ki list (filter se badla ja sakta hai).
 *
 * @return array
 */
function alify_auto_pages_config() {
	$pages = array(
		'home'                 => array(
			'title'   => __( 'Home', 'alify' ),
			'template' => 'templates/page-home.php',
		),
		'about-us'             => array(
			'title'   => __( 'About Us', 'alify' ),
			'template' => 'templates/page-about-us.php',
		),
		'blogs'                => array(
			'title'   => __( 'Blogs', 'alify' ),
			'template' => '',
		),
		'contact-us'           => array(
			'title'   => __( 'Contact Us', 'alify' ),
			'template' => 'templates/page-contact-us.php',
		),
		'start-a-project'      => array(
			'title'   => __( 'Start a Project', 'alify' ),
			'template' => 'templates/page-start-a-project.php',
		),
		'thank-you'            => array(
			'title'   => __( 'Thank You', 'alify' ),
			'template' => 'templates/page-thank-you.php',
		),
		'privacy-policy'       => array(
			'title'   => __( 'Privacy Policy', 'alify' ),
			'template' => 'templates/page-privacy-policy.php',
		),
		'terms-and-conditions' => array(
			'title'   => __( 'Terms and Conditions', 'alify' ),
			'template' => 'templates/page-terms-and-conditions.php',
		),
		'cookie-policy'        => array(
			'title'   => __( 'Cookie Policy', 'alify' ),
			'template' => 'templates/page-cookie-policy.php',
		),
		'disclaimer'           => array(
			'title'   => __( 'Disclaimer', 'alify' ),
			'template' => 'templates/page-disclaimer.php',
		),
	);

	/**
	 * Filter: auto-create pages.
	 *
	 * @param array $pages slug => array( title, template ).
	 */
	return apply_filters( 'alify_auto_pages', $pages );
}

/**
 * Page ka default content (legal pages ke liye editable skeleton).
 *
 * @param string $slug Page slug.
 * @return string
 */
function alify_auto_page_content( $slug ) {
	$site = get_bloginfo( 'name' );

	switch ( $slug ) {
		case 'privacy-policy':
			$body = '<h2>1. Information we collect</h2><p>We collect the information you submit through our contact forms, and basic analytics data such as pages visited and device type.</p>'
				. '<h2>2. How we use your information</h2><p>Your information is used to respond to enquiries, deliver projects and improve this website. We never sell your data.</p>'
				. '<h2>3. Cookies</h2><p>We use essential and analytics cookies. You can manage them in your browser settings.</p>'
				. '<h2>4. Third parties</h2><p>We only share data with processors required to run our services (for example hosting and email providers).</p>'
				. '<h2>5. Your rights</h2><p>You can request access, correction or deletion of your personal data at any time.</p>'
				. '<h2>6. Contact</h2><p>For privacy questions, email us at hello@example.com.</p>';
			break;

		case 'terms-and-conditions':
			$body = '<h2>1. Acceptance of terms</h2><p>By using this website you agree to these terms and conditions.</p>'
				. '<h2>2. Services</h2><p>Project scope, deliverables and fees are defined in a separate written proposal or agreement.</p>'
				. '<h2>3. Intellectual property</h2><p>All content on this site belongs to ' . esc_html( $site ) . ' unless stated otherwise.</p>'
				. '<h2>4. Limitation of liability</h2><p>We are not liable for indirect or consequential losses arising from use of this website.</p>'
				. '<h2>5. Changes</h2><p>We may update these terms from time to time; the latest version always applies.</p>';
			break;

		case 'cookie-policy':
			$body = '<h2>1. What are cookies</h2><p>Cookies are small text files stored on your device that help websites work and remember your preferences.</p>'
				. '<h2>2. Cookies we use</h2><ul><li><strong>Essential</strong> — required for the site to function.</li><li><strong>Analytics</strong> — help us understand how the site is used.</li><li><strong>Preferences</strong> — remember your choices.</li></ul>'
				. '<h2>3. Managing cookies</h2><p>You can block or delete cookies in your browser settings at any time.</p>';
			break;

		case 'disclaimer':
			$body = '<h2>1. General information</h2><p>The content on this website is for general information only and does not constitute professional advice.</p>'
				. '<h2>2. Accuracy</h2><p>We aim to keep information accurate and current, but make no guarantees about completeness or accuracy.</p>'
				. '<h2>3. External links</h2><p>We are not responsible for the content of third-party websites linked from this site.</p>';
			break;

		case 'about-us':
			$body = '<h2>Who we are</h2><p>Alify is a strategy-led digital studio. We help companies clarify their positioning, design better digital products and grow with measurable marketing.</p>'
				. '<h2>How we work</h2><p>Small senior teams, short feedback loops and a clear plan from day one. Every engagement starts with a discovery sprint.</p>';
			break;

		case 'contact-us':
			$body = '<h2>Tell us about your project</h2><p>Add your contact form here (or replace this text). Include what you are building, your timeline and your budget range.</p>';
			break;

		case 'start-a-project':
			$body = '<h2>What happens next</h2><ol><li>You share your goals and scope.</li><li>We reply with questions and a plan.</li><li>You get a fixed estimate and timeline.</li><li>We start with discovery.</li></ol>';
			break;

		case 'thank-you':
			$body = '<p>Thanks for reaching out. A member of our team will get back to you shortly.</p>';
			break;

		default:
			$body = '';
	}

	return $body;
}

/**
 * Pages create karo (theme activation par).
 *
 * @return void
 */
function alify_create_pages_on_activation() {
	$alify_pages = alify_auto_pages_config();
	$alify_ids   = array();

	foreach ( $alify_pages as $alify_slug => $alify_page ) {
		$alify_slug = sanitize_title( $alify_slug );
		$alify_hit  = get_page_by_path( $alify_slug );

		if ( $alify_hit instanceof WP_Post ) {
			$alify_ids[ $alify_slug ] = (int) $alify_hit->ID;
			continue;
		}

		$alify_post_id = wp_insert_post(
			array(
				'post_title'   => $alify_page['title'],
				'post_name'    => $alify_slug,
				'post_type'    => 'page',
				'post_status'  => 'publish',
				'post_content' => alify_auto_page_content( $alify_slug ),
			),
			true
		);

		if ( is_wp_error( $alify_post_id ) ) {
			continue;
		}

		$alify_ids[ $alify_slug ] = (int) $alify_post_id;

		if ( ! empty( $alify_page['template'] ) ) {
			update_post_meta( $alify_post_id, '_wp_page_template', $alify_page['template'] );
		}
	}

	/* ---------- Front page = Home, Blog page = Blogs ---------- */
	if ( ! empty( $alify_ids['home'] ) ) {
		update_option( 'show_on_front', 'page' );
		update_option( 'page_on_front', $alify_ids['home'] );
	}

	if ( ! empty( $alify_ids['blogs'] ) ) {
		update_option( 'page_for_posts', $alify_ids['blogs'] );
	}

	/* Auto-created pages ki list (dobara create na hon). */
	update_option(
		'alify_auto_pages_created',
		array(
			'time'  => time(),
			'pages' => $alify_ids,
		)
	);

	flush_rewrite_rules();
}
add_action( 'after_switch_theme', 'alify_create_pages_on_activation' );

/**
 * Fallback: agar theme pehle activate ho chuki ho aur front page set na ho
 * (blog index par site khul rahi ho) to Home page ko front par set karo.
 *
 * @return void
 */
function alify_ensure_front_page() {
	if ( ! get_option( 'alify_auto_pages_created' ) ) {
		return;
	}

	if ( 'page' === get_option( 'show_on_front' ) && get_option( 'page_on_front' ) ) {
		return;
	}

	$alify_home = get_page_by_path( 'home' );

	if ( $alify_home instanceof WP_Post ) {
		update_option( 'show_on_front', 'page' );
		update_option( 'page_on_front', (int) $alify_home->ID );
	}

	$alify_blogs = get_page_by_path( 'blogs' );

	if ( $alify_blogs instanceof WP_Post && ! get_option( 'page_for_posts' ) ) {
		update_option( 'page_for_posts', (int) $alify_blogs->ID );
	}
}
add_action( 'admin_init', 'alify_ensure_front_page' );
