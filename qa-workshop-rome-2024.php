<?php

declare( strict_types=1 );

/*
Plugin Name: QA Workshop
Plugin URI: https://github.com/gmazzap/qa-workshop-rome-2024
Description: Sample plugin for my session at Rome Core Days 2024
Version: 0.1.0
Author URI: https://gmazzap.me
*/

namespace Gmazzap\CoreDays24;

/**
 * Return a line from 'Roma nun fa la stupida stasera' song by Lando Fiorini
 */
function nun_fa_la_stupida_line(): string {

	$lyrics = <<<'TXT'
	Roma nun fa' la stupida stasera
	damme 'na mano a faje di' de si'
	sceji tutte le stelle piu' brillarelle
	che puoi e un friccico de luna
	tutta pe' noi
	Faje senti' ch'e' quasi primavera
	manna li mejo grilli pe' fa' cri cri
	prestame er ponentino
	piu' malandrino che c'hai
	roma reggeme er moccolo stasera
	Sceji tutte le stelle piu' brillarelle
	che puoi e un friccico de luna
	tutta pe' noi
	Faje senti' ch'e' quasi primavera
	manna li mejo grilli pe' fa' cri cri
	prestame er ponentino
	piu' malandrino che c'hai
	roma reggeme er moccolo stasera
	Roma nun fa' la stupida stasera
	TXT;

	$lines = explode( "\n", $lyrics );

	return trim( $lines[ array_rand( $lines ) ] );
}

/**
 * Whether is evening when the function is called.
 */
function is_evening(): bool {

	return current_datetime()->format( 'H' ) > 17;
}

/**
 * Add a line from 'Roma nun fa la stupida stasera' lyrics into admin notices.
 */
function nun_fa_la_stupida(): void {
	if ( ! is_evening() ) {
		return;
	}

	$is_it = str_starts_with( get_user_locale(), 'it_' );
	$line  = nun_fa_la_stupida_line();

	?>
	<div id="nun_fa_la_stupida" class="notice is-dismissible">
		<p>
			<span class="screen-reader-text">
			<?php
			esc_html_e(
				'Quote from Roma nun fa la stupida stasera song, by Lando Fiorini:',
				'hello-dolly'
			);
			?>
			</span>
			<span dir="ltr"<?php print $is_it ? '' : ' lang="it"'; ?>>
				🎵 <?php print esc_html( nun_fa_la_stupida_line() ); ?> 🎵
			</span>
		</p>
	</div>
	<?php
}

add_action( 'admin_notices', __NAMESPACE__ . '\\nun_fa_la_stupida' );