<?php
/**
 * Template part for process lock information for other users.
 *
 * @package everest-backup
 */

/**
 * Exit if accessed directly.
 */
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( empty( $args['type'] ) ) {
	return;
}

$everest_backup_class = ! empty( $args['class'] ) ? $args['class'] : '';

if ( everest_backup_is_ebwp_page() && $everest_backup_class ) {
	/**
	 * Bail and show only single notice in our pages.
	 */
	return;
}

?>
<style>
	.notice.ebwp-center.ebwp-proc-lock-wrapper {
		background: #ffffff;
		display: flex;
		align-items: center;
		border: 1px solid #a2badd;
		border-left: 4px solid #0b5cd1;
		gap: 20px;
		padding: 1px 12px
	}

	.notice.ebwp-center.ebwp-proc-lock-wrapper img {
		width: 80px;
	}

	.notice.ebwp-center.ebwp-proc-lock-wrapper h1,
	.notice.ebwp-center.ebwp-proc-lock-wrapper p {
		padding: 0;
		margin: 0;
	}

	.ebwp-proc-info {
		padding: 10px;
	}

	.ebwp-proc-stale {
		background-image: linear-gradient(90deg, #ebe5e5, transparent);
		padding: 10px 10px 10px 15px;
		margin: 10px 0 3px;
	}

	.ebwp-proc-stale h2 {
		padding: 0;
		margin: 0 0 5px;
	}

	.ebwp-proc-stale .button {
		margin: 15px 0 5px;
	}
</style>

<div class="<?php echo esc_attr( $everest_backup_class ); ?> ebwp-center ebwp-proc-lock-wrapper">

	<img class="logo-icon" src="<?php echo esc_url( EVEREST_BACKUP_URL . 'assets/images/ebwp-loading.gif' ); ?>">

	<div class="ebwp-proc-info">
		<h1><?php echo esc_html( wptexturize( __( "Everest Backup's process is running", 'everest-backup' ) ) ); ?></h1>

		<p class="ebwp-proc-description">
			<?php
			$everest_backup_userdata      = get_userdata( $args['uid'] );
			$everest_backup_process_types = everest_backup_get_process_types();

			if ( ! empty( $everest_backup_userdata->user_nicename ) ) {
				printf(
					/* translators: %1$s is user nicename, %2$s is process type, %3$s is time started and %4$s is time elapsed. */
					esc_html__( 'The user %1$s is performing %2$s since %3$s', 'everest-backup' ),
					'<strong>"' . esc_html( ucwords( $everest_backup_userdata->user_nicename ) ) . '"</strong>',
					'<strong>' . esc_html( $everest_backup_process_types[ $args['type'] ] ) . '</strong>',
					'<strong class="proc-lock-datetime"></strong>'
				);
			} else {
				printf(
					/* translators: %1$s is Everest Backup plugin name, %2$s is process type, %3$s is time started and %4$s is time elapsed. */
					esc_html__( '%1$s is performing %2$s since %3$s', 'everest-backup' ),
					'<strong>"Everest Backup"</strong>',
					'<strong>' . esc_html( $everest_backup_process_types[ $args['type'] ] ) . '</strong>',
					'<strong class="proc-lock-datetime"></strong>'
				);
			}
			?>
		</p>

		<div class="ebwp-proc-lock-info-wrapper">
			<details style="margin: 10px 0 0;cursor: pointer;border: 1px solid;padding: 5px;">
				<summary>
					<?php esc_html_e( 'Click to view details', 'everest-backup' ); ?>
					<progress min="0" max="100" value="0" style="width: 100%"></progress>
				</summary>

				<textarea  wrap="off" readonly style="height: 125px;width: 100%;background: #000;color: #01e901;margin-top:10px;"></textarea>
			</details>
		</div>

		<?php

		if ( ! empty( $args['is_stale'] ) ) {
			$force_abort_url = add_query_arg(
				array(
					'page'        => 'everest-backup-export',
					'force-abort' => true,
					'uid'         => get_current_user_id(),
				),
				network_admin_url( '/admin.php' )
			);

			?>

			<div class="ebwp-proc-stale">
				<h2><?php esc_html_e( '*** Attention Required ***', 'everest-backup' ); ?></h2>
				<p><?php esc_html_e( 'It seems like this process has been running for too long. If you think Everest Backup is showing a false message, then you can "Force Abort" this process and clear this notice.', 'everest-backup' ); ?></p>

				<a href="<?php echo esc_url( wp_nonce_url( $force_abort_url ) ); ?>" class="button button-hero button-danger force-delete"><?php esc_html_e( 'Force Abort', 'everest-backup' ); ?></a>
			</div>
			<?php
		}
		?>

	</div>


	<script>
	/**
	 * Writing this scripts here in inline because we need to display this template in everywhere needed.
	 */
	(function(){

		document.addEventListener('DOMContentLoaded', function() {

			ebwpProcLockInfoHandler(document.querySelector('.ebwp-proc-lock-info-wrapper details'));

			const dateElement = document.querySelector('.ebwp-proc-info .proc-lock-datetime');

			if (dateElement) {
				const dateTime = new Date(<?php echo absint( "{$args['time']}000" ); ?>);
				dateElement.innerHTML = `${dateTime.toLocaleTimeString()} [ ${dateTime.toDateString()} ]`
			}

		});

		function ebwpProcLockInfoHandler(el) {

			if (!el) {
				return;
			}

			let confirmationShown = false;
			let retry = 1;

			let   lastDetail     = "";
			const processDetails = el.querySelector("textarea");
			const heading        = document.querySelector('.ebwp-proc-info h1');
			const img            = document.querySelector('.ebwp-proc-lock-wrapper .logo-icon');

			function handleHeadingsAndImages() {
				heading.innerHTML = "<?php echo esc_html( wptexturize( __( "Everest Backup's process completed", 'everest-backup' ) ) ); ?>";
				img.setAttribute('src', '<?php echo esc_url( EVEREST_BACKUP_URL . 'assets/images/ebwp-stop.png' ); ?>');

				<?php if ( everest_backup_is_ebwp_page() ) { ?>
					setTimeout(function() {
						if (confirmationShown) {
							return;
						}

						confirmationShown = true;
						if ( confirm("<?php echo esc_html( wptexturize( __( "Everest Backup: Process Completed. Reload Now?", 'everest-backup' ) ) ); ?>") ) {
							return window.location.href = `${window.location.href}&force_reload=true`;
						}
					}, 2000);
				<?php } ?>

				document.querySelector('.ebwp-proc-description').remove();

			}

			function handleProcessDetails(details) {
				if (details === lastDetail) {
					return;
				}
				if (!processDetails) {
					return;
				}
				if ("undefined" === typeof details || !details) {
					return;
				}
				processDetails.value = `${details}\n` + processDetails.value;
				lastDetail = details;
			};

			function handleProgress(percent) {
				const progressEL = el.querySelector('progress');

				if (!progressEL) {
					return;
				}

				progressEL.innerHTML = `${percent}%`;
				progressEL.value = percent;
				progressEL.setAttribute('title', `${percent}%`);

			}

			function sseURL() {
				const url = new URL("<?php echo esc_url( everest_backup_get_sse_url() ); ?>");
				url.searchParams.append('t', `${+new Date()}`);
				return url.toString();
			}

			let timeoutNumber = 0;

			async function onBeaconSent () {
				const response = await fetch(sseURL());
				const result = response.json();
				result
					.then((res) => {
						switch (res.status) {
							case 'done':
								el.remove();
								handleHeadingsAndImages();
								break;
							case 'cloud':
								el.remove();
								break;
							case 'error':
								el.remove();
								break;
							default:
								handleProgress(res.progress);
								handleProcessDetails(res.detail);
								setTimeout(onBeaconSent, 1000);
								break;
						}
					})
					.catch((err) => {
						console.warn(err);

						if (timeoutNumber) clearInterval(timeoutNumber);

						if ( retry > 5 ) {
							return handleProcessDetails("<?php esc_html_e( 'Failed to reconnect 5 times. Try reloading...', 'everest-backup' ); ?>");
						}

						handleProcessDetails("<?php esc_html_e( 'Lost connection with server. Reconnecting...', 'everest-backup' ); ?>");

						const retrySec = retry * 1000;
						timeoutNumber = setTimeout(onBeaconSent, retrySec);

						retry++;
					});
			};

			onBeaconSent();

		}
	}());
	</script>
</div>
