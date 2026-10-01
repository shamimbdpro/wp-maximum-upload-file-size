<?php

if ( ! function_exists( 'codepopular_render_dashboard_feed_posts' ) ) {
	/**
	 * Blog post list for dashboard widget.
	 *
	 * @param array<int, array<string, string>> $posts_data Posts from promotion JSON.
	 * @param string                            $utm_source UTM source.
	 */
	function codepopular_render_dashboard_feed_posts( $posts_data, $utm_source ) {
		if ( empty( $posts_data ) || ! is_array( $posts_data ) ) {
			return;
		}

		$items = array();
		foreach ( $posts_data as $post ) {
			if ( ! empty( $post['title'] ) && ! empty( $post['link'] ) ) {
				$items[] = $post;
			}
		}
		if ( empty( $items ) ) {
			return;
		}

		$total = count( $items );
		echo '<div class="codepopular-feed-list" style="margin:0;padding:0;">';
		foreach ( $items as $index => $post ) {
			$is_last  = ( $index === $total - 1 );
			$date_raw = isset( $post['date'] ) ? $post['date'] : '';
			$date     = $date_raw ? gmdate( 'M j, Y', strtotime( $date_raw ) ) : '';
			$excerpt  = isset( $post['excerpt'] ) ? $post['excerpt'] : '';
			$link     = add_query_arg( 'utm_source', $utm_source, $post['link'] );
			$border   = $is_last ? 'none' : '1px solid rgba(0,0,0,0.06)';
			$padding  = $is_last ? '0' : '0 0 12px';
			$margin   = $is_last ? '0' : '0 0 12px';
			?>
			<article class="codepopular-feed-item" style="margin:<?php echo esc_attr( $margin ); ?>;padding:<?php echo esc_attr( $padding ); ?>;border-bottom:<?php echo esc_attr( $border ); ?>;">
				<h4 style="margin:0 0 4px;font-size:13px;line-height:1.4;font-weight:600;">
					<a href="<?php echo esc_url( $link ); ?>" target="_blank" rel="noopener noreferrer" style="text-decoration:none;color:#2271b1;box-shadow:none;">
						<?php echo esc_html( $post['title'] ); ?>
					</a>
				</h4>
				<?php if ( $date ) : ?>
					<time datetime="<?php echo esc_attr( $date_raw ); ?>" style="display:block;margin:0 0 6px;font-size:11px;line-height:1.3;color:#646970;">
						<?php echo esc_html( $date ); ?>
					</time>
				<?php endif; ?>
				<?php if ( $excerpt ) : ?>
					<p style="margin:0;font-size:12px;line-height:1.5;color:#50575e;">
						<?php echo esc_html( wp_trim_words( wp_strip_all_tags( $excerpt ), 22, '…' ) ); ?>
					</p>
				<?php endif; ?>
			</article>
			<?php
		}
		echo '</div>';
	}
}

if ( ! function_exists( 'codepopular_dashboard_feed_footer' ) ) {
	/**
	 * Footer nav for dashboard blog widget.
	 *
	 * @param string $utm_source UTM source slug.
	 */
	function codepopular_dashboard_feed_footer( $utm_source ) {
		static $styles_printed = false;

		$site = 'https://codepopular.com';
		$utm  = rawurlencode( $utm_source );
		$links = array(
			array(
				'label' => __( 'Hire', 'wp-maximum-upload-file-size' ),
				'url'   => $site . '/contact/?utm_source=' . $utm . '&utm_medium=dashboard_feed_nav&utm_campaign=hire',
			),
			array(
				'label' => __( 'Products', 'wp-maximum-upload-file-size' ),
				'url'   => $site . '/product/?utm_source=' . $utm . '&utm_medium=dashboard_feed_nav&utm_campaign=products',
			),
			array(
				'label' => __( 'Help', 'wp-maximum-upload-file-size' ),
				'url'   => $site . '/contact/?utm_source=' . $utm . '&utm_medium=dashboard_feed_nav&utm_campaign=help',
			),
			array(
				'label' => __( 'Blog', 'wp-maximum-upload-file-size' ),
				'url'   => $site . '/blog/?utm_source=' . $utm . '&utm_medium=dashboard_feed_nav&utm_campaign=blog',
			),
		);

		?>
		<?php if ( ! $styles_printed ) : ?>
			<?php $styles_printed = true; ?>
			<style>
				.codepopular-feed-footer__nav .codepopular-feed-footer__btn {
					display: inline-flex;
					align-items: center;
					justify-content: center;
					flex: 1 1 0;
					min-width: 0;
					min-height: 32px;
					padding: 0 6px;
					border-radius: 6px;
					text-decoration: none;
					font-size: 11px;
					font-weight: 500;
					line-height: 1.2;
					white-space: nowrap;
					color: #3c434a;
					background: #fff;
					border: 1px solid rgba(0, 0, 0, 0.1);
					box-shadow: none;
					transition: background 0.15s ease, border-color 0.15s ease, color 0.15s ease;
				}
				.codepopular-feed-footer__nav .codepopular-feed-footer__btn:hover,
				.codepopular-feed-footer__nav .codepopular-feed-footer__btn:focus {
					background: rgba(var(--wp-admin-theme-color--rgb, 34, 113, 177), 0.14);
					border-color: rgba(var(--wp-admin-theme-color--rgb, 34, 113, 177), 0.38);
					color: var(--wp-admin-theme-color, #2271b1);
					outline: none;
					box-shadow: none;
				}
			</style>
		<?php endif; ?>
		<div class="codepopular-feed-footer" style="margin-top:12px;padding-top:12px;border-top:1px solid rgba(0,0,0,0.08);">
			<p style="margin:0 0 8px;font-size:11px;font-weight:600;letter-spacing:0.06em;text-transform:uppercase;color:#646970;">
				<?php esc_html_e( 'Explore CodePopular', 'wp-maximum-upload-file-size' ); ?>
			</p>
			<nav class="codepopular-feed-footer__nav" aria-label="<?php esc_attr_e( 'CodePopular links', 'wp-maximum-upload-file-size' ); ?>" style="display:flex;flex-direction:row;flex-wrap:nowrap;gap:5px;">
				<?php foreach ( $links as $link ) : ?>
					<a class="codepopular-feed-footer__btn" href="<?php echo esc_url( $link['url'] ); ?>" target="_blank" rel="noopener noreferrer">
						<?php echo esc_html( $link['label'] ); ?>
					</a>
				<?php endforeach; ?>
			</nav>
		</div>
		<?php
	}
}

if ( ! function_exists( 'codepopular_add_dashboard_widgets' ) ) {
	/**
	 * Add a widget to the dashboard.
	 */
	function codepopular_add_dashboard_widgets() {
		add_meta_box(
			'codepopular_latest_news_dashboard_widget',
			__( 'Latest from CodePopular', 'wp-maximum-upload-file-size' ),
			'codepopular_dashboard_widget_render',
			'dashboard',
			'side',
			'high'
		);
	}
	add_action( 'wp_dashboard_setup', 'codepopular_add_dashboard_widgets', 1 );
}

if ( ! function_exists( 'codepopular_dashboard_widget_render' ) ) {
	/**
	 * Render the dashboard widget content with transient cache.
	 */
	function codepopular_dashboard_widget_render() {

		// ✅ PROMOTION + posts (cached; GitHub failure never affects front-end or fatal errors)
		$promo_data = get_transient( 'codepopular_promo_data' );

		if ( false === $promo_data ) {
			$promo_data  = array();
			$promo_response = wp_remote_get(
				'https://raw.githubusercontent.com/shamimbdpro/promotion/main/promotion.json',
				array(
					'timeout'   => 5,
					'sslverify' => true,
				)
			);

			if ( ! is_wp_error( $promo_response ) && 200 === (int) wp_remote_retrieve_response_code( $promo_response ) ) {
				$decoded = json_decode( wp_remote_retrieve_body( $promo_response ), true );
				if ( is_array( $decoded ) ) {
					$promo_data = $decoded;
					set_transient( 'codepopular_promo_data', $promo_data, 2 * HOUR_IN_SECONDS );
				} else {
					set_transient( 'codepopular_promo_data', array(), 15 * MINUTE_IN_SECONDS );
				}
			} else {
				// Short cache when GitHub/network is down — avoids repeated slow requests.
				set_transient( 'codepopular_promo_data', array(), 15 * MINUTE_IN_SECONDS );
			}
		}

		if ( ! is_array( $promo_data ) ) {
			$promo_data = array();
		}

		// ✅ Show promo if active
		if ( isset( $promo_data['active'] ) && 'yes' === $promo_data['active'] && ! empty( $promo_data['link'] ) && ! empty( $promo_data['square_banner'] ) ) {
			?>
            <div class="codepopular-pro-widget" style="margin-bottom:14px;">
                <a href="<?php echo esc_url( $promo_data['link'] ); ?>?utm_source=maxuploader_dashboard_feed_banner" target="_blank">
                    <img src="<?php echo esc_url( $promo_data['square_banner'] ); ?>" alt="CodePopular" style="width: 100%;"/>
                </a>
            </div>
			<?php
		}

		// ✅ BLOG POSTS (from GitHub promotion.json, same cache as promo)
		$posts_data = ( is_array( $promo_data ) && ! empty( $promo_data['posts'] ) && is_array( $promo_data['posts'] ) )
			? $promo_data['posts']
			: array();

		// ✅ Show blog posts
		if ( ! empty( $posts_data ) ) {
			codepopular_render_dashboard_feed_posts( $posts_data, 'maxuploader-dashboard-feed' );
			codepopular_dashboard_feed_footer( 'maxuploader-dashboard-feed' );
		} elseif ( empty( $posts_data ) ) {
			echo '<p class="description">' . esc_html__( 'News feed is temporarily unavailable. Your site is working normally.', 'wp-maximum-upload-file-size' ) . '</p>';
			codepopular_dashboard_feed_footer( 'maxuploader-dashboard-feed' );
		}
	}
}

// ✅ ADMIN NOTICE: Load only if the notice is not hidden
if ( time() > get_option( 'wmufs_notice_disable_time' ) ) {
	add_action( 'load-index.php', function () {
		add_action( 'admin_notices', 'codepopular_wmufs_promotions' );
	} );
}

if ( ! function_exists( 'codepopular_wmufs_promotions' ) ) {
	/**
	 * Display admin notice for support/promotion.
	 */
	function codepopular_wmufs_promotions() { ?>
        <div class="notice notice-success is-dismissible hideWmufsNotice">
            <div class="codepopular_notice">
                <h4><?php esc_html_e( 'Thank you for using our Plugin EasyMedia!', 'wp-maximum-upload-file-size' ); ?></h4>
                <p><?php esc_html_e( 'We are glad that you are using our plugin... Thank you to everyone.', 'wp-maximum-upload-file-size' ); ?></p>
                <div class="codepopular__buttons">
                    <a href="https://ko-fi.com/codepopular?utm_source=easymedia-dashboard-feed" target="_blank" class="codepopular__button btn__green dashicons-heart">
						<?php esc_html_e( 'Buy me a coffee', 'wp-maximum-upload-file-size' ); ?>
                    </a>
                    <a href="https://wordpress.org/support/plugin/wp-maximum-upload-file-size/reviews/#new-post" target="_blank" class="codepopular__button btn__yellow dashicons-star-filled">
						<?php esc_html_e( 'Add a Plugin review', 'wp-maximum-upload-file-size' ); ?>
                    </a>
                    <a href="https://codepopular.com/contact?utm_source=easymedia-dashboard-feed" target="_blank" class="codepopular__button btn__dark dashicons-email">
						<?php esc_html_e( 'Contact Us', 'wp-maximum-upload-file-size' ); ?>
                    </a>
                    <button type="button" id="hideWmufsNotice" class="codepopular__button btn__blue dashicons-no"><?php esc_html_e( 'Hide for 6 months', 'wp-maximum-upload-file-size' ); ?></button>
                </div>
            </div>
        </div>
	<?php }
}
