<?php
/**
 * Share template
 *
 * @author YITH
 * @package YITH\Wishlist\Templates
 * @version 3.0.0
 */

/**
 * Template variables:
 *
 * @var $wishlist                YITH_WCWL_Wishlist Wishlist object
 * @var $share_title             string Title for share section
 * @var $share_facebook_enabled  bool Whether to enable FB sharing button
 * @var $share_twitter_enabled   bool Whether to enable Twitter sharing button
 * @var $share_pinterest_enabled bool Whether to enable Pintereset sharing button
 * @var $share_email_enabled     bool Whether to enable Email sharing button
 * @var $share_whatsapp_enabled  bool Whether to enable WhatsApp sharing button (mobile online)
 * @var $share_url_enabled       bool Whether to enable share via url
 * @var $share_link_title        string Title to use for post (where applicable)
 * @var $share_link_url          string Url to share
 * @var $share_summary           string Summary to use for sharing on social media
 * @var $share_image_url         string Image to use for sharing on social media
 * @var $share_twitter_summary   string Summary to use for sharing on Twitter
 * @var $share_facebook_icon     string Icon for facebook sharing button
 * @var $share_twitter_icon      string Icon for twitter sharing button
 * @var $share_pinterest_icon    string Icon for pinterest sharing button
 * @var $share_email_icon        string Icon for email sharing button
 * @var $share_whatsapp_icon     string Icon for whatsapp sharing button
 * @var $share_whatsapp_url      string Sharing url on whatsapp
 */

if ( ! defined( 'YITH_WCWL' ) ) {
	exit;
} // Exit if accessed directly
?>

<?php
// we want spaces to be encoded as + instead of %20, so we use urlencode instead of rawurlencode.
// phpcs:disable WordPress.PHP.DiscouragedPHPFunctions.urlencode_urlencode

/**
 * DO_ACTION: yith_wcwl_before_wishlist_share
 *
 * Allows to render some content or fire some action before the share wishlist section.
 */
do_action( 'yith_wcwl_before_wishlist_share', $wishlist );
?>

<div class="yith-wcwl-share">
	<h4 class="yith-wcwl-share-title"><?php echo esc_html( $share_title ); ?></h4>
	<ul>
		<?php if ( $share_facebook_enabled ) : ?>
			<li class="share-button">
				<a target="_blank" rel="noopener" class="facebook" href="https://www.facebook.com/sharer.php?u=<?php echo urlencode( $share_link_url ); ?>&p[title]=<?php echo esc_attr( $share_link_title ); ?>" title="<?php esc_html_e( 'Facebook', 'yith-woocommerce-wishlist' ); ?>">
					<svg width="17" height="30" viewBox="0 0 17 30" fill="none" xmlns="http://www.w3.org/2000/svg">
<path fill-rule="evenodd" clip-rule="evenodd" d="M16.8 4.8H12.15C11.55 4.8 10.8 4.95 10.8 6V10.8H16.8V15.6H10.8V30H6V15.6H0V10.8H6V6.6C6 2.25 8.1 0 12.15 0H16.8V4.8Z" fill="#093c2e"/>
</svg>
				</a>
			</li>
		<?php endif; ?>

		<?php if ( $share_twitter_enabled ) : ?>
			<li class="share-button">
				<a target="_blank" rel="noopener" class="twitter" href="https://twitter.com/share?url=<?php echo urlencode( $share_link_url ); ?>&amp;text=<?php echo esc_attr( $share_twitter_summary ); ?>" title="<?php esc_html_e( 'Twitter', 'yith-woocommerce-wishlist' ); ?>">
					<?php echo $share_twitter_icon ? yith_wcwl_kses_icon( $share_twitter_icon ) : esc_html__( 'Twitter', 'yith-woocommerce-wishlist' ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
				</a>
			</li>
		<?php endif; ?>

		<?php if ( $share_pinterest_enabled ) : ?>
			<li class="share-button">
				<a target="_blank" rel="noopener" class="pinterest" href="http://pinterest.com/pin/create/button/?url=<?php echo urlencode( $share_link_url ); ?>&amp;description=<?php echo esc_attr( $share_summary ); ?>&amp;media=<?php echo esc_attr( $share_image_url ); ?>" title="<?php esc_html_e( 'Pinterest', 'yith-woocommerce-wishlist' ); ?>" onclick="window.open(this.href); return false;">
					<?php echo $share_pinterest_icon ? yith_wcwl_kses_icon( $share_pinterest_icon ) : esc_html__( 'Pinterest', 'yith-woocommerce-wishlist' ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
				</a>
			</li>
		<?php endif; ?>

		<?php if ( $share_email_enabled ) : ?>
			<li class="share-button">
				<?php
				/**
				 * APPLY_FILTERS: yith_wcwl_email_share_subject
				 *
				 * Filter the subject for the share email.
				 *
				 * @param string $subject Email subject
				 *
				 * @return string
				 */

				/**
				 * APPLY_FILTERS: yith_wcwl_email_share_body
				 *
				 * Filter the body for the share email.
				 *
				 * @param string $body Email body
				 *
				 * @return string
				 */

				?>
				<a class="email" href="mailto:?subject=<?php echo esc_attr( apply_filters( 'yith_wcwl_email_share_subject', $share_link_title ) ); ?>&amp;body=<?php echo esc_attr( apply_filters( 'yith_wcwl_email_share_body', urlencode( $share_link_url ) ) ); ?>&amp;title=<?php echo esc_attr( $share_link_title ); ?>" title="<?php esc_html_e( 'Email', 'yith-woocommerce-wishlist' ); ?>">
					<?php echo $share_email_icon ? yith_wcwl_kses_icon( $share_email_icon ) : __( 'Email', 'yith-woocommerce-wishlist' ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
				</a>
			</li>
		<?php endif; ?>

		<?php if ( $share_whatsapp_enabled ) : ?>
			<li class="share-button">
				<a class="whatsapp" href="<?php echo esc_attr( $share_whatsapp_url ); ?>" data-action="share/whatsapp/share" target="_blank" rel="noopener" title="<?php esc_html_e( 'WhatsApp', 'yith-woocommerce-wishlist' ); ?>">
					<svg width="30" height="30" viewBox="0 0 30 30" fill="none" xmlns="http://www.w3.org/2000/svg">
<path d="M15.0065 0C6.73255 0 0.00376974 6.72607 6.42139e-07 14.9939C-0.000823848 17.8272 0.792334 20.5864 2.29361 22.9738L2.65015 23.5412L1.13462 29.0747L6.81182 27.5859L7.35975 27.9107C9.66243 29.2772 12.3026 30 14.9941 30.0009H14.9999C23.2674 30.0009 29.9963 23.2743 30 15.0059C30.0014 10.9989 28.4427 7.23172 25.6108 4.39759C22.7789 1.56335 19.0125 0.00129563 15.0065 0ZM23.8293 21.4409C23.4533 22.4935 21.652 23.4547 20.7857 23.5845C20.0086 23.7003 19.0259 23.7487 17.9456 23.4058C17.2904 23.198 16.4507 22.9206 15.3746 22.4563C10.8513 20.5036 7.89708 15.9506 7.67164 15.6495C7.4462 15.3487 5.83032 13.2051 5.83032 10.9861C5.83032 8.76751 6.9952 7.6767 7.40851 7.22571C7.82205 6.77436 8.31074 6.66164 8.61109 6.66164C8.91156 6.66164 9.21249 6.66447 9.47527 6.67731C9.75218 6.69109 10.1239 6.57201 10.4897 7.45115C10.8656 8.35396 11.7675 10.5724 11.8802 10.798C11.9929 11.0238 12.0678 11.287 11.9179 11.588C11.7675 11.8888 11.2677 12.538 10.7907 13.1298C10.5905 13.3777 10.3297 13.5985 10.5928 14.0499C10.8555 14.5008 11.761 15.9772 13.1013 17.1726C14.8239 18.7084 16.2767 19.1841 16.7277 19.41C17.1781 19.6355 17.4413 19.5976 17.7045 19.2973C17.9672 18.9964 18.8317 17.9809 19.132 17.5296C19.4326 17.0782 19.7335 17.1536 20.1466 17.3042C20.5603 17.4541 22.777 18.545 23.2279 18.7704C23.6788 18.9964 23.9793 19.1091 24.0919 19.2973C24.2051 19.4854 24.2051 20.3877 23.8293 21.4409Z" fill="#093c2e"/>
</svg>

				</a>
			</li>
		<?php endif; ?>
	</ul>

	<?php if ( $share_url_enabled ) : ?>
		<div class="yith-wcwl-after-share-section">
			<input class="copy-target" readonly="readonly" type="url" name="yith_wcwl_share_url" id="yith_wcwl_share_url" value="<?php echo esc_attr( $share_link_url ); ?>"/>
			<?php echo ( ! empty( $share_link_url ) ) ? sprintf( '<small>%s <span class="copy-trigger">%s</span> %s</small>', esc_html__( '(Now', 'yith-woocommerce-wishlist' ), esc_html__( 'copy', 'yith-woocommerce-wishlist' ), esc_html__( 'this wishlist link and share it anywhere)', 'yith-woocommerce-wishlist' ) ) : ''; ?>
		</div>
	<?php endif; ?>

	<?php
	/**
	 * DO_ACTION: yith_wcwl_after_share_buttons
	 *
	 * Allows to render some content or fire some action after the share buttons in the Wishlist page.
	 *
	 * @param string $share_link_url   Share link URL
	 * @param string $share_title      Share title
	 * @param string $share_link_title Share link title
	 */
	do_action( 'yith_wcwl_after_share_buttons', $share_link_url, $share_title, $share_link_title );
	?>
</div>

<?php
/**
 * DO_ACTION: yith_wcwl_after_wishlist_share
 *
 * Allows to render some content or fire some action after the share wishlist section.
 */
do_action( 'yith_wcwl_after_wishlist_share', $wishlist );

// phpcs:enable WordPress.PHP.DiscouragedPHPFunctions.urlencode_urlencode
?>
