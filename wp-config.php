<?php
/**
 * The base configurations of the WordPress.
 *
 * This file has the following configurations: MySQL settings, Table Prefix,
 * Secret Keys, WordPress Language, and ABSPATH. You can find more information
 * by visiting {@link http://codex.wordpress.org/Editing_wp-config.php Editing
 * wp-config.php} Codex page. You can get the MySQL settings from your web host.
 *
 * This file is used by the wp-config.php creation script during the
 * installation. You don't have to use the web site, you can just copy this file
 * to "wp-config.php" and fill in the values.
 *
 * @package WordPress
 */

// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define('WP_CACHE', true); //Added by WP-Cache Manager
define( 'WPCACHEHOME', '/Applications/MAMP/htdocs/calvestocows/wp-content/plugins/wp-super-cache/' ); //Added by WP-Cache Manager
define('DB_NAME', 'calvesto_wo6490');

/** MySQL database username */
define('DB_USER', 'root');

/** MySQL database password */
define('DB_PASSWORD', 'root');

/** MySQL hostname */
define('DB_HOST', 'localhost');

/** Database Charset to use in creating database tables. */
define('DB_CHARSET', 'utf8');

/** The Database Collate type. Don't change this if in doubt. */
define('DB_COLLATE', '');

/**#@+
 * Authentication Unique Keys and Salts.
 *
 * Change these to different unique phrases!
 * You can generate these using the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * You can change these at any point in time to invalidate all existing cookies. This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define('AUTH_KEY', 'KsoPasDZTSZN%Bb$*|I%KrICs=jCd{K_;gmY]?zUegm^QA<XX+lQEEqq^<jHNss?ta]l=*YhkMp&s]y]i]m/AH|}Pr=GYSQYhm};%TLsSXl}C*VsONGQ[]](ii)<DcdG');
define('SECURE_AUTH_KEY', 'k{m;rZY&u%_R<F{)^_%)p+=^/F}knbPPUeN[&R]wG-uWzW@cc(G_%OicOZKA)eD{*RxC)/a[cqCK-ifr/[PzO(py^iqNs=Ykz&?m*Q%^s)UkB@Ptxe^G>qn?[}wrAzkI');
define('LOGGED_IN_KEY', '-MSzXTnnJAIfPEKZXj/Xg*k(NhN]UqMq_LhLYGwH[h&&INGx;-dQDcSYFAQz@dsR&)_c}[zuGes@}Fx^thz?GoJ]FDA]i@eMf]UMqePkpnoWj)x<foUbaqF]tR>p/BPw');
define('NONCE_KEY', 'eEeGv;oZ%yd;SH(?N/EZ)%uq-q<m!FzHdAm&|_ehKbxGejn]kGo&$vkVaDH/er$iX(RY&A|;Etk?ttqi!f}}TlpMmZj+NsaPEc]_Xot@Iu]tK&P$ra<VfGmx;N-=*cCt');
define('AUTH_SALT', '?)VX}N^W[ZPq(pFaWcbIDJF]MMxh+Jv/FRVswJ;$sPTz]Q)KzrHAtQeLm=d+G%U/$lB|^xb$OGc-[Dm$s}-Bt_k$QTXJ-dX]S+YbSra<ytkss?A[DJL+GW[*B^<K^YBZ');
define('SECURE_AUTH_SALT', 'erxPSdI<mA+BJkQ@Fgv]Z/VbZvxYz|(E-Fym&}V^<G^j{p!NAL/C=Lo)N-gbVRvtuu+%g^S|gg?GM%)n|!TXKqo(httFG_N_VfnkqCr%N|T*nCGy}IB{LBtFYxvpt^N+');
define('LOGGED_IN_SALT', 'A>ct[|FAmG@?S-J}l@NHOBeFtV$Po?$pak&_bn{QV/Lmt(vCHh-RnkX[f?UqkWWmC;{GYgk^I}xVeNHU)xTMjnGyu@-SqFqKRrZ=s}-tVGl]Kql&H]rJ&%r)nd?{FHUl');
define('NONCE_SALT', '/SK;If^P][aQTkt;NtS[(P;K*uU<&GgSq<q[su+yQmPhIS(!?PZ*RAKBUiYTvOR+bE@?qf^exf<C(MyyC)o/QG)Ys@^edFX-%F<Kl}Ngh%)GpK[maE@{y|[F<WQsWVoH');

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each a unique
 * prefix. Only numbers, letters, and underscores please!
 */
$table_prefix = 'wp_gduh_';

/**
 * For developers: WordPress debugging mode.
 *
 * Change this to true to enable the display of notices during development.
 * It is strongly recommended that plugin and theme developers use WP_DEBUG
 * in their development environments.
 */
define('WP_DEBUG', false);

/* That's all, stop editing! Happy blogging. */

/** Absolute path to the WordPress directory. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');

/**
 * Include tweaks requested by hosting providers.  You can safely
 * remove either the file or comment out the lines below to get
 * to a vanilla state.
 */
/*if (file_exists(ABSPATH . 'hosting_provider_filters.php')) {
	include('hosting_provider_filters.php');
}*/
