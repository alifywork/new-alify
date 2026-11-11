<?php
/**
 * Alify theme bootstrap.
 *
 * Sirf loader — har cheez apni alag file mein hai (koi dumping yard nahi).
 *
 * URL STRUCTURE (SEO friendly — "project_category" jaise bases URL mein NAHI):
 *   /services/                     + /services/{service-slug}/
 *   /project/                      + /project/{project-slug}/
 *   /project/category/{term}/      (taxonomy base = "project/category")
 *   /teams/category/{term}/
 *   /industries/category/{term}/
 *   /case-studies/category/{term}/
 *   /pricing/category/{term}/      (sirf archive, single nahi)
 *   /faqs/category/{term}/         (sirf archive, single nahi)
 *   /testimonials/category/{term}/ (sirf archive, single nahi)
 *
 * @package Alify
 */

defined( 'ABSPATH' ) || exit;

define( 'ALIFY_VERSION', '1.0.0' );
define( 'ALIFY_DIR', get_template_directory() );
define( 'ALIFY_URI', get_template_directory_uri() );

/* ---------- Core setup ---------- */
require_once ALIFY_DIR . '/inc/setup.php';
require_once ALIFY_DIR . '/inc/enqueue.php';
require_once ALIFY_DIR . '/inc/widgets.php';
require_once ALIFY_DIR . '/inc/templates.php';

/* ---------- Security (first priority) ---------- */
require_once ALIFY_DIR . '/inc/security/headers.php';
require_once ALIFY_DIR . '/inc/security/hardening.php';
require_once ALIFY_DIR . '/inc/security/sanitization.php';
require_once ALIFY_DIR . '/inc/security/ajax.php';
require_once ALIFY_DIR . '/inc/security/database.php';

/* ---------- Performance ---------- */
require_once ALIFY_DIR . '/inc/performance.php';

/* ---------- Custom Post Types (har CPT apni file + apni taxonomy) ---------- */
require_once ALIFY_DIR . '/inc/cpt/services.php';
require_once ALIFY_DIR . '/inc/cpt/project.php';
require_once ALIFY_DIR . '/inc/cpt/teams.php';
require_once ALIFY_DIR . '/inc/cpt/industries.php';
require_once ALIFY_DIR . '/inc/cpt/case-studies.php';
require_once ALIFY_DIR . '/inc/cpt/pricing.php';
require_once ALIFY_DIR . '/inc/cpt/faqs.php';
require_once ALIFY_DIR . '/inc/cpt/testimonials.php';

/* ---------- Admin (Gutenberg disable, editor tweaks) ---------- */
require_once ALIFY_DIR . '/inc/admin/disable-gutenberg.php';

/* ---------- Components (reusable UI: buttons waghera) ---------- */
require_once ALIFY_DIR . '/inc/components/buttons.php';

/* ---------- Shortcodes (har shortcode apni file) ---------- */
require_once ALIFY_DIR . '/inc/shortcodes/services.php';
require_once ALIFY_DIR . '/inc/shortcodes/project.php';
require_once ALIFY_DIR . '/inc/shortcodes/pricing.php';
require_once ALIFY_DIR . '/inc/shortcodes/faqs.php';
require_once ALIFY_DIR . '/inc/shortcodes/testimonials.php';
