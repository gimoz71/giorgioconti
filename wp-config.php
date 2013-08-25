<?php
/**
 * Il file base di configurazione di WordPress.
 *
 * Questo file definisce le seguenti configurazioni: impostazioni MySQL,
 * Prefisso Tabella, Chiavi Segrete, Lingua di WordPress e ABSPATH.
 * E' possibile trovare ultetriori informazioni visitando la pagina: del
 * Codex {@link http://codex.wordpress.org/Editing_wp-config.php
 * Editing wp-config.php}. E' possibile ottenere le impostazioni per
 * MySQL dal proprio fornitore di hosting.
 *
 * Questo file viene utilizzato, durante l'installazione, dallo script
 * rimepire i valori corretti.
 *
 * @package WordPress
 */

// ** Impostazioni MySQL - E? possibile ottenere questoe informazioni
// ** dal proprio fornitore di hosting ** //
/** Il nome del database di WordPress */
define('DB_NAME', 'conti');

/** Nome utente del database MySQL */
define('DB_USER', 'root');

/** Password del database MySQL */
define('DB_PASSWORD', 'l0v3cr4ft');

/** Hostname MySQL  */
define('DB_HOST', 'localhost');

/** Charset del Database da utilizare nella creazione delle tabelle. */
define('DB_CHARSET', 'utf8');

/** Il tipo di Collazione del Database. Da non modificare se non si ha
idea di cosa sia. */
define('DB_COLLATE', '');

/**#@+
 * Chiavi Univoche di Autenticazione e di Salatura.
 *
 * Modificarle con frasi univoche differenti!
 * E' possibile generare tali chiavi utilizzando {@link https://api.wordpress.org/secret-key/1.1/salt/ servizio di chiavi-segrete di WordPress.org}
 *
 * @since 2.6.0
 */
define('AUTH_KEY',         '/] N#/vPvE9|$0WUta*ExG;w.}`f)0HFca4ao~-BmQdn`Bore_.r>*~{weQ@ n.O');
define('SECURE_AUTH_KEY',  '!gk<]gX&:1ZiSEZ[3Gu: ;OW{,Suq^[r]PogWc1VxHEf&jp_Pj0qIqin]L<.}&B+');
define('LOGGED_IN_KEY',    '%oAT5Gl3)@|k<n o.lW~%+~6`+EitDu[Q^3K!F A*$:{_k_)Uu08MsZ0MZV]BuCK');
define('NONCE_KEY',        'k|9*Ys|)bedp h}GHk>-;w$AgtB;TEkn7B$X40;`?!Fed,L-6/v7nh2+F^f|LxKe');
define('AUTH_SALT',        '!h+H8w#q|JM^-s-45;<&[Q<*V,^>ux|27-w{@O*E8#YhD>b#{o1E jK%bL_z7Lmq');
define('SECURE_AUTH_SALT', 'a2`/aZn:G]>V`!l[l-,A}iWAx.#A:uf$#0Q}dSY:7N]Ql>Z_<;8?Xu;Q-sB8:bd}');
define('LOGGED_IN_SALT',   'InH:xeS.KfE<6Yp+*06g?-C!s81w7k(sidT!R<9jY4H<G0=&jW`rRt>GY:u_~EQj');
define('NONCE_SALT',       'nXv{dd,XqR/*AhLc/(cY8f<@GE!}|<ZXQ|d<S7[#ErhJ<U{gf,xa8CV5lK% )9ek');

/**#@-*/

/**
 * Prefisso Tabella del Database WordPress .
 *
 * E' possibile avere installazioni multiple su di un unico database if you give each a unique
 * fornendo a ciascuna installazione un prefisso univoco.
 * Solo numeri, lettere e sottolineatura!
 */
$table_prefix  = 'wp_';

/**
 * Lingua di Localizzazione di WordPress, di base Inglese.
 *
 * Modificare questa voce per localizzare WordPress. Occorre che nella cartella
 * wp-content/languages sia installato un file MO corrispondente alla lingua
 * selezionata. Ad esempio, installare de_DE.mo in to wp-content/languages ed
 * impostare WPLANG a 'de_DE' per abilitare il supporto alla lingua tedesca.
 *
 */
define('WPLANG', 'it_IT');

/**
 *
 * Modificare questa voce a TRUE per abilitare la visualizzazione degli avvisi
 * durante lo sviluppo.
 * E' fortemente raccomandato agli svilupaptori di temi e plugin di utilizare
 * WP_DEBUG all'interno dei loro ambienti di sviluppo.
 */
define('WP_DEBUG', false);

/* Finito, interrompere le modifiche! Buon blogging. */

/** Path assoluto alla directory di WordPress. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Imposta lle variabili di WordPress ed include i file. */
require_once(ABSPATH . 'wp-settings.php');