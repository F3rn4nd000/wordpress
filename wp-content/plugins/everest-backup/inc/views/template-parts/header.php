<?php
if ( everest_backup_is_debug_on() ) {

	/**
	 * @since 1.1.6
	 */
	?>
	<div class="ebwp-debug-mode-notice" style="margin:0 0 10px; padding: 20px; background-color: #ff9800; text-align:center;">
		<h1 style="color:#ffffff;"><?php esc_html_e( 'Everest Backup Debug Mode On', 'everest-backup' ); ?></h1>
	</div>
	<?php
}

?>
<div class="everest-backup-header">
	<div class="everest-backup-logo">
		<svg xmlns="http://www.w3.org/2000/svg" width="200" viewBox="0 0 680.997 152.261">
			<g id="everest-backup-logo" transform="translate(-172.531 -28.9)">
				<g id="Group_4" data-name="Group 4" transform="translate(172.531 28.9)">
					<g id="Group_1" data-name="Group 1" transform="translate(0 0)">
						<path id="Path_1" data-name="Path 1" d="M488.921,103.6a5.251,5.251,0,0,0-6.733,3.131h0l-1.494,4.087a42.749,42.749,0,0,0-24.141-17.749c-.019-.244-.014-.494-.038-.735-.017-.161-.055-.316-.072-.477-.14-1.227-.311-2.444-.557-3.634-.038-.191-.1-.376-.147-.569-.253-1.15-.53-2.292-.877-3.405-.01-.031-.024-.06-.034-.092-.4-1.265-.851-2.506-1.364-3.714l-.015-.029a41.338,41.338,0,0,0-35.035-25.034q-1.027-1.226-2.106-2.4c-.323-.354-.646-.708-.976-1.056-1.111-1.169-2.253-2.3-3.441-3.4-.082-.076-.159-.157-.241-.231q-2.061-1.887-4.263-3.61c-.063-.05-.13-.1-.191-.145q-2.071-1.616-4.261-3.077c-.164-.111-.33-.219-.5-.33a73.786,73.786,0,0,0-105.72,26.712c-.031.055-.063.111-.092.166q-1.486,2.776-2.738,5.69c-.1.229-.21.451-.306.68-.74,1.774-1.4,3.586-2.005,5.429-.125.378-.275.745-.4,1.128-.236.765-.424,1.549-.636,2.323A15.98,15.98,0,0,0,278.4,96.8c-.612.253-1.21.523-1.807.8-.374.176-.747.354-1.116.54q-1.406.712-2.747,1.529c-.231.14-.473.268-.7.414-1.157.732-2.28,1.514-3.355,2.352l-.043.036c-1.044.815-2.034,1.689-2.993,2.6-.181.171-.354.349-.533.525q-1.229,1.207-2.357,2.514c-.142.166-.289.33-.429.5a41.483,41.483,0,0,0,30.4,68.068c.133.01.248.076.382.076h35.388a15.906,15.906,0,0,0,21.986,0h35.717a5.251,5.251,0,1,0,0-10.5H355.407c.026-.378.115-.742.115-1.128a15.963,15.963,0,0,0-2.808-9.054l11.626-15.708h0l12.739-17.209a15.974,15.974,0,0,0,7.787-30.842,30.715,30.715,0,0,1,8.707-17.559c.149-.147.313-.277.465-.421h0a30.751,30.751,0,0,1,40.427-1.972,31.428,31.428,0,0,1,2.733,2.4,30.736,30.736,0,0,1,8.582,16.742c-.227,0-.443-.043-.672-.043A42.646,42.646,0,0,0,404.495,121.1a5.251,5.251,0,1,0,10,3.205,32.077,32.077,0,0,1,57.105-8.3l-5.251-1.918a5.25,5.25,0,1,0-3.6,9.863L479.282,130a5.252,5.252,0,0,0,6.733-3.131l6.04-16.537a5.246,5.246,0,0,0-3.134-6.733ZM308.78,105.514l55.047,5.331a15.963,15.963,0,0,0,3.865,7.34l-23.461,31.7a15.567,15.567,0,0,0-17.554,5.671c-.26-.174-.545-.311-.8-.487-1.673-1.161-3.256-2.436-4.805-3.75-.3-.251-.624-.473-.921-.73a65.1,65.1,0,0,1-9.767-10.772h0a63.359,63.359,0,0,1-3.959-6.256c-.926-1.66-1.75-3.381-2.533-5.126-.209-.473-.417-.947-.617-1.424q-.94-2.241-1.708-4.567c-.333-1.022-.617-2.064-.9-3.107-.323-1.169-.658-2.332-.913-3.528-.128-.614-.181-1.255-.289-1.873a16.034,16.034,0,0,0,9.313-8.417Zm30.7,65.147a5.541,5.541,0,1,1,5.54-5.538,5.541,5.541,0,0,1-5.54,5.538Zm-45.24-77.373a5.541,5.541,0,1,1-5.54,5.543A5.541,5.541,0,0,1,294.238,93.288ZM263.16,135.17a30.953,30.953,0,0,1,2.593-12.416h0a31.2,31.2,0,0,1,2.815-5.1s.007-.007.01-.012a31.266,31.266,0,0,1,3.687-4.458,30.041,30.041,0,0,1,8.43-5.838,16.013,16.013,0,0,0,8.018,6.483c.076.5.164,1,.248,1.5.065.374.115.749.185,1.121a73.541,73.541,0,0,0,1.72,7.157c.1.347.209.692.316,1.036a73.047,73.047,0,0,0,2.569,7.072c.036.082.076.161.111.243a73.9,73.9,0,0,0,13.52,20.828c.1.111.2.222.306.333a74.157,74.157,0,0,0,5.7,5.509c.188.164.382.32.569.482a73.693,73.693,0,0,0,6.2,4.748c.2.137.412.265.617.4.911.61,1.819,1.223,2.759,1.793,0,.065.015.13.019.2H294.238A31.077,31.077,0,0,1,263.16,135.17ZM379.465,112.9a5.541,5.541,0,1,1,5.54-5.543A5.541,5.541,0,0,1,379.465,112.9Zm6.239-45.08,0,0a41.473,41.473,0,0,0-6.852,9.4c-.017.031-.029.063-.046.094-.59,1.118-1.135,2.263-1.624,3.441-.063.153-.109.313-.171.468-.427,1.063-.829,2.141-1.166,3.246-.109.349-.176.716-.275,1.07-.258.93-.518,1.856-.711,2.81-.13.641-.2,1.3-.3,1.957s-.229,1.287-.3,1.945a16,16,0,0,0-9.2,8.162l-55.274-5.352a16,16,0,0,0-8.517-10.588c.344-1.137.65-2.292,1.053-3.4q.553-1.491,1.176-2.944c.475-1.128,1.02-2.217,1.557-3.309a66.748,66.748,0,0,1,4.825-8.232h0a63.008,63.008,0,0,1,72.368-23.75,64.7,64.7,0,0,1,6.427,2.608c.246.115.492.236.737.354,1.8.867,3.543,1.832,5.244,2.858.393.239.791.468,1.176.713,1.542.978,3.02,2.041,4.471,3.145.414.318.851.612,1.258.94,1.22.978,2.359,2.048,3.5,3.116a41.257,41.257,0,0,0-19.352,11.239Z" transform="translate(-252.66 -28.9)" fill="#fff" />
						<path id="Path_2" data-name="Path 2" d="M938.5,484.825a5.253,5.253,0,0,0-6.6,3.4,32.08,32.08,0,0,1-57.115,8.281l4.56,1.359a5.251,5.251,0,1,0,3-10.064l-16.872-5.032a5.248,5.248,0,0,0-6.531,3.53l-5.032,16.865a5.251,5.251,0,1,0,10.064,3h0l1.458-4.887a42.525,42.525,0,0,0,76.471-9.857,5.253,5.253,0,0,0-3.405-6.6Z" transform="translate(-708.846 -373.225)" fill="#fff" />
					</g>
					<path id="Path_3" data-name="Path 3" d="M485.53,313.892a15.67,15.67,0,0,0,1.007-10.452l21.586,2.089-.879,10.464Z" transform="translate(-429.41 -237.278)" fill="#fff" opacity="0.42" />
					<path id="Path_4" data-name="Path 4" d="M648.022,319.012a15.753,15.753,0,0,0-1.258,10.452l-21.335-2.089.879-10.464Z" transform="translate(-535.595 -247.502)" fill="#fff" opacity="0.42" />
					<g id="Group_3" data-name="Group 3" transform="translate(4.965 4.564)">
						<g id="Group_2" data-name="Group 2" transform="translate(0 0)" opacity="0.76">
							<path id="Path_5" data-name="Path 5" d="M463.252,502.08c.1.111.2.224.306.333a74.137,74.137,0,0,0,5.7,5.509c.188.164.382.32.569.482a73.3,73.3,0,0,0,6.2,4.748c.2.137.412.265.617.4.884.59,1.835,1.087,2.745,1.639-.012-.265-.079-.513-.079-.781a15.9,15.9,0,0,1,3.232-9.567c-.258-.174-.537-.32-.793-.5-1.678-1.157-3.25-2.444-4.805-3.75-.3-.253-.627-.47-.921-.73a63.7,63.7,0,0,1-9.767-10.775l-8.235,6.634A74.381,74.381,0,0,0,463.252,502.08Z" transform="translate(-413.495 -382.752)" fill="#fff" opacity="0.42" />
							<path id="Path_6" data-name="Path 6" d="M413.66,187.158a15.9,15.9,0,0,1,6.962,1.652c.347-1.135.713-2.258,1.123-3.364.364-1,.765-1.971,1.176-2.944.484-1.123,1.012-2.22,1.557-3.309a63.151,63.151,0,0,1,4.825-8.232l-9.678-4.549q-1.869,2.816-3.482,5.8c-.031.055-.063.111-.092.166-.994,1.848-1.9,3.752-2.738,5.69-.1.229-.21.451-.306.68-.747,1.771-1.4,3.591-2.005,5.429-.123.378-.277.745-.4,1.128-.236.757-.4,1.547-.607,2.314A15.929,15.929,0,0,1,413.66,187.158Z" transform="translate(-377.047 -137.836)" fill="#fff" opacity="0.42" />
							<path id="Path_7" data-name="Path 7" d="M790.34,57.215s0,0,0,0a62.772,62.772,0,0,1,6.427,2.608c.248.115.492.236.737.354q2.7,1.309,5.244,2.858c.393.239.788.47,1.176.713,1.54.983,3.024,2.036,4.471,3.145.417.318.848.612,1.258.94,1.223.986,2.379,2.039,3.526,3.111A41.314,41.314,0,0,1,823.491,69.6c1.015,0,2.007.08,3,.153-.68-.81-1.364-1.617-2.08-2.4-.323-.354-.646-.708-.976-1.056-1.111-1.166-2.253-2.306-3.441-3.4-.082-.076-.159-.157-.241-.231q-2.061-1.883-4.263-3.61c-.063-.05-.13-.1-.191-.145q-2.071-1.612-4.261-3.077c-.164-.111-.33-.219-.5-.33A73.838,73.838,0,0,0,795.4,47.84Z" transform="translate(-665.729 -47.84)" fill="#fff" opacity="0.42" />
							<path id="Path_8" data-name="Path 8" d="M768.694,190.4a41.621,41.621,0,0,0-6.852,9.4c-.017.031-.029.063-.046.094-.59,1.118-1.135,2.265-1.624,3.441-.063.153-.109.313-.171.468-.427,1.063-.827,2.141-1.166,3.246-.106.349-.178.716-.275,1.07-.258.928-.516,1.856-.711,2.81-.13.641-.2,1.3-.3,1.957s-.224,1.285-.292,1.942a14.986,14.986,0,0,1,10.594.065,30.715,30.715,0,0,1,8.707-17.559c.149-.147.313-.277.465-.421l-8.331-6.518S768.7,190.4,768.694,190.4Z" transform="translate(-640.619 -156.041)" fill="#fff" opacity="0.42" />
							<path id="Path_9" data-name="Path 9" d="M1029.1,213.209c-.017-.161-.055-.316-.072-.477-.14-1.227-.311-2.444-.557-3.634-.038-.191-.1-.376-.147-.569-.253-1.15-.53-2.292-.877-3.405-.01-.031-.024-.06-.034-.092-.4-1.265-.851-2.506-1.364-3.714l-.015-.029a41.445,41.445,0,0,0-8.883-13.129l-10.1,5.078h0a31.1,31.1,0,0,1,2.733,2.4,30.736,30.736,0,0,1,8.582,16.742,42.211,42.211,0,0,1,10.775,1.567C1029.119,213.7,1029.127,213.45,1029.1,213.209Z" transform="translate(-830.212 -154.344)" fill="#fff" opacity="0.42" />
							<path id="Path_10" data-name="Path 10" d="M408,382.427a15.916,15.916,0,0,1-5.458-1.017c.076.489.1.994.181,1.48.063.374.115.749.185,1.121a73.364,73.364,0,0,0,1.72,7.157c.1.347.21.692.316,1.036a73.954,73.954,0,0,0,2.569,7.072c.036.082.076.161.111.244a73.567,73.567,0,0,0,3.509,7.1l9.052-5.509h0c-.926-1.663-1.759-3.374-2.533-5.126-.212-.473-.414-.947-.617-1.424-.622-1.5-1.2-3.012-1.708-4.567-.338-1.02-.612-2.064-.9-3.107-.316-1.174-.663-2.332-.913-3.528-.13-.614-.227-1.239-.338-1.861A15.9,15.9,0,0,1,408,382.427Z" transform="translate(-371.385 -301.022)" fill="#fff" opacity="0.42" />
							<path id="Path_11" data-name="Path 11" d="M641.13,490l11.119-15.021-8.532-6.126L632.65,483.8A16.028,16.028,0,0,1,641.13,490Z" transform="translate(-546.041 -367.39)" fill="#fff" opacity="0.42" />
							<path id="Path_12" data-name="Path 12" d="M694.425,399.37l-11.3,15.257,7.938,6.924,12.739-17.209A15.909,15.909,0,0,1,694.425,399.37Z" transform="translate(-584.355 -314.654)" fill="#fff" opacity="0.42" />
							<path id="Path_13" data-name="Path 13" d="M281.388,336.7a31.206,31.206,0,0,1,2.815-5.1.042.042,0,0,1,.01-.012,31.431,31.431,0,0,1,3.687-4.458,30.076,30.076,0,0,1,8.43-5.836,15.91,15.91,0,0,1-2.5-8.519,15.584,15.584,0,0,1,.2-2c-.6.251-1.212.492-1.8.769-.374.176-.747.354-1.116.54q-1.406.712-2.747,1.529c-.231.14-.473.27-.7.414-1.157.732-2.28,1.514-3.355,2.352l-.043.036c-1.041.815-2.034,1.687-2.993,2.6-.181.171-.354.349-.533.525q-1.229,1.207-2.357,2.514c-.142.166-.289.33-.429.5a41.718,41.718,0,0,0-4.7,6.914Z" transform="translate(-273.262 -247.413)" fill="#fff" opacity="0.42" />
							<path id="Path_14" data-name="Path 14" d="M449.714,598.85H420.4a5.251,5.251,0,0,1,0,10.5c-.513,0-1.012-.058-1.521-.077.133.01.246.076.382.076h35.387A15.937,15.937,0,0,1,449.714,598.85Z" transform="translate(-383.787 -466.061)" fill="#fff" opacity="0.42" />
							<path id="Path_15" data-name="Path 15" d="M658.54,609.342h35.717a5.251,5.251,0,0,0,0-10.5H663.473A15.935,15.935,0,0,1,658.54,609.342Z" transform="translate(-565.691 -466.053)" fill="#fff" opacity="0.42" />
						</g>
					</g>
				</g>
				<g id="Group_8" data-name="Group 8" transform="translate(445.237 53.14)">
					<g id="Group_5" data-name="Group 5" transform="translate(0 0)">
						<path id="Path_16" data-name="Path 16" d="M76.377,775.319v9.714H35.87V732.72H75.408v9.714H47.9V753.8h24.29v9.416H47.9v12.109H76.377Z" transform="translate(-35.87 -731.819)" fill="#fff" />
						<path id="Path_17" data-name="Path 17" d="M281.016,732.72l-22.643,52.313H246.412L223.84,732.72h13.081l15.917,37.368,16.145-37.368Z" transform="translate(-170.106 -731.819)" fill="#fff" />
						<path id="Path_18" data-name="Path 18" d="M514.817,775.319v9.714H474.31V732.72h39.538v9.714H486.342V753.8h24.29v9.416h-24.29v12.109h28.475Z" transform="translate(-348.976 -731.819)" fill="#fff" />
						<path id="Path_19" data-name="Path 19" d="M714.445,785.033,704.35,770.46H693.216v14.573H681.11V732.72h22.64a29.119,29.119,0,0,1,12.081,2.318,17.951,17.951,0,0,1,7.881,6.575,18.2,18.2,0,0,1,2.761,10.093,17.014,17.014,0,0,1-10.766,16.515l11.737,16.818h-13Zm-3.064-40.1q-2.847-2.354-8.3-2.353h-9.865v18.235h9.865q5.454,0,8.3-2.39a9.451,9.451,0,0,0,0-13.494Z" transform="translate(-496.659 -731.819)" fill="#fff" />
						<path id="Path_20" data-name="Path 20" d="M950.388,775.319v9.714H909.88V732.72h39.535v9.714h-27.5V753.8h24.294v9.416H921.912v12.109h28.475Z" transform="translate(-660.032 -731.819)" fill="#fff" />
						<path id="Path_21" data-name="Path 21" d="M1116.845,781.994a27.967,27.967,0,0,1-9.305-4.374l4.111-9.116a27.815,27.815,0,0,0,8,3.965,30.143,30.143,0,0,0,9.262,1.491q5.161,0,7.627-1.532a4.623,4.623,0,0,0,2.464-4.068,3.9,3.9,0,0,0-1.455-3.1,11.137,11.137,0,0,0-3.742-1.984q-2.281-.746-6.16-1.641a85.179,85.179,0,0,1-9.794-2.842,15.928,15.928,0,0,1-6.537-4.562,12.266,12.266,0,0,1-2.73-8.37,14.52,14.52,0,0,1,2.47-8.258,16.561,16.561,0,0,1,7.432-5.863,30.424,30.424,0,0,1,12.146-2.173,40.248,40.248,0,0,1,9.794,1.2,28.918,28.918,0,0,1,8.37,3.436l-3.734,9.19a29.242,29.242,0,0,0-14.5-4.105q-5.081,0-7.512,1.641a5.025,5.025,0,0,0-2.433,4.336,4.237,4.237,0,0,0,2.8,4,43.545,43.545,0,0,0,8.559,2.579,85.174,85.174,0,0,1,9.794,2.842,16.21,16.21,0,0,1,6.537,4.482,12.039,12.039,0,0,1,2.73,8.3,14.319,14.319,0,0,1-2.507,8.187,16.859,16.859,0,0,1-7.512,5.863,30.594,30.594,0,0,1-12.184,2.164A42.6,42.6,0,0,1,1116.845,781.994Z" transform="translate(-801.188 -729.566)" fill="#fff" />
						<path id="Path_22" data-name="Path 22" d="M1321.395,742.585H1304.65V732.72h45.593v9.865H1333.5v42.448h-12.1V742.585Z" transform="translate(-941.951 -731.819)" fill="#fff" />
					</g>
					<g id="Group_7" data-name="Group 7" transform="translate(0 84.202)">
						<g id="Group_6" data-name="Group 6" transform="translate(0 0)">
							<path id="Path_23" data-name="Path 23" d="M324.835,992.633a8.077,8.077,0,0,1,1.567,5.048,7.466,7.466,0,0,1-3.3,6.526q-3.3,2.285-9.614,2.281H296.8V974.21h15.768q5.9,0,9.06,2.255a7.165,7.165,0,0,1,3.159,6.137,7.753,7.753,0,0,1-4.291,7.1A8.495,8.495,0,0,1,324.835,992.633Zm-20.611-12.8v7.61h7.424a7.516,7.516,0,0,0,4.2-.966,3.242,3.242,0,0,0,1.429-2.859,3.183,3.183,0,0,0-1.429-2.842,7.68,7.68,0,0,0-4.2-.944Zm13.164,20.059a3.316,3.316,0,0,0,1.5-3q0-4.014-5.949-4.014h-8.716v7.982h8.716a8.338,8.338,0,0,0,4.451-.966Z" transform="translate(-296.8 -973.652)" fill="#fff" />
							<path id="Path_24" data-name="Path 24" d="M472.8,999.565H457.813l-2.859,6.915H447.3l14.385-32.28h7.381l14.433,32.28h-7.841Zm-2.353-5.674-5.117-12.358-5.117,12.358Z" transform="translate(-404.277 -973.644)" fill="#fff" />
							<path id="Path_25" data-name="Path 25" d="M625.865,1003.5a16.006,16.006,0,0,1-6.272-5.949,17.339,17.339,0,0,1,0-17.2,16.005,16.005,0,0,1,6.272-5.949,20.013,20.013,0,0,1,16.553-.663,15.175,15.175,0,0,1,5.7,4.239l-4.8,4.43a10.3,10.3,0,0,0-8.113-3.782,10.748,10.748,0,0,0-5.349,1.315,9.312,9.312,0,0,0-3.668,3.668,11.535,11.535,0,0,0,0,10.7,9.33,9.33,0,0,0,3.668,3.668,10.778,10.778,0,0,0,5.349,1.315,10.251,10.251,0,0,0,8.113-3.831l4.8,4.428a14.864,14.864,0,0,1-5.717,4.288,18.941,18.941,0,0,1-7.61,1.478A18.536,18.536,0,0,1,625.865,1003.5Z" transform="translate(-525.687 -972.258)" fill="#fff" />
							<path id="Path_26" data-name="Path 26" d="M796.357,993.806l-4.334,4.519v8.161H784.6V974.21h7.424v15.079l14.293-15.079h8.3l-13.375,14.385,14.159,17.9h-8.716Z" transform="translate(-645.156 -973.652)" fill="#fff" />
							<path id="Path_27" data-name="Path 27" d="M945.57,1003.225q-3.85-3.834-3.85-10.93V974.22h7.47v17.8q0,8.675,7.192,8.673a6.736,6.736,0,0,0,5.349-2.1q1.848-2.1,1.847-6.576v-17.8h7.378v18.075q0,7.1-3.851,10.929t-10.768,3.825Q949.419,1007.053,945.57,1003.225Z" transform="translate(-757.36 -973.659)" fill="#fff" />
							<path id="Path_28" data-name="Path 28" d="M1126.706,975.631a11.568,11.568,0,0,1,4.865,16.483,10.928,10.928,0,0,1-4.865,4.062,18.192,18.192,0,0,1-7.447,1.4h-6.5v8.9h-7.47V974.2h13.97a17.907,17.907,0,0,1,7.446,1.429Zm-2.741,14.408a5.047,5.047,0,0,0,1.752-4.125,5.126,5.126,0,0,0-1.752-4.179,7.86,7.86,0,0,0-5.117-1.447h-6.089v11.2h6.089a7.814,7.814,0,0,0,5.117-1.449Z" transform="translate(-874.172 -973.644)" fill="#fff" />
						</g>
					</g>
				</g>
			</g>
		</svg>
	</div>

	<div class="everest-backup-status-bar">
	</div>
	<div class="everest-backup-header-links">
		<a href="<?php echo esc_url('https://docs.wpeverestbackup.com?utm_medium=wpd&utm_source=eb&utm_campaign=viewdocumentation'); ?>" target="_blank" class="button-secondary">
			<span class="dashicons dashicons-external"></span><?php esc_html_e('View Documentation', 'everest-backup'); ?>
		</a>

		<a href="<?php echo esc_url( add_query_arg( 'page', 'everest-backup-changelogs' ) ); ?>" class="button-secondary">
			<span class="dashicons dashicons-analytics"></span><?php esc_html_e('Changelogs', 'everest-backup'); ?>
		</a>

		<a href="<?php echo esc_url('https://wpeverestbackup.com/contact-us?utm_medium=wpd&utm_source=eb&utm_campaign=contactus'); ?>" class="button-secondary" target="_blank">
			<span class="dashicons dashicons-email-alt"></span><?php esc_html_e('Contact Us', 'everest-backup'); ?>
		</a>
	</div>
</div>

<?php
everest_backup_breadcrumb();

if ( ! everest_backup_is_php_function_enabled( 'fopen' ) ) {
?>
	<div style="margin:0 0 10px; padding: 20px; background-color: #ff9800; color: white;">
		<strong><?php esc_html_e( 'Warning!', 'everest-backup' ); ?></strong> <?php esc_html_e( 'PHP default function "fopen" is disabled by your server. Some functionality might not work properly.', 'everest-backup' ); ?>
	</div>
<?php
}

if ( ! everest_backup_is_gzip_lib_enabled() ) {
	?>
	<div class="notice notice-error" style="display:flex;">
		<img style="width: 70px;object-fit: cover;padding-right: 12px;" class="logo-icon" src="<?php echo esc_url( EVEREST_BACKUP_URL . 'assets/images/ebwp-loading.gif' ); ?>">

		<div class="notice-wrapper">
			<h1><?php esc_html_e( 'Heads Up !!!', 'everest-backup' ); ?></h1>
			<strong><?php esc_html_e( 'Everest Backup since version 2.0.0 requires PHP gzip library to work. Please contact your host to enable the library or rollback to previous version.', 'everest-backup' ); ?></strong>
		</div>
	</div>
	<?php
}
