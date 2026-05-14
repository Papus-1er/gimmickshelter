<?php
/**
 * La configuration de base de votre installation WordPress.
 *
 * Ce fichier est utilisé par le script de création de wp-config.php pendant
 * le processus d’installation. Vous n’avez pas à utiliser le site web, vous
 * pouvez simplement renommer ce fichier en « wp-config.php » et remplir les
 * valeurs.
 *
 * Ce fichier contient les réglages de configuration suivants :
 *
 * Réglages MySQL
 * Préfixe de table
 * Clés secrètes
 * Langue utilisée
 * ABSPATH
 *
 * @link https://fr.wordpress.org/support/article/editing-wp-config-php/.
 *
 * @package WordPress
 */

// ** Réglages MySQL - Votre hébergeur doit vous fournir ces informations. ** //
/** Nom de la base de données de WordPress. */
define( 'DB_NAME', 'gimmicn111' );

/** Utilisateur de la base de données MySQL. */
define( 'DB_USER', 'gimmicn111' );

/** Mot de passe de la base de données MySQL. */
define( 'DB_PASSWORD', 'Penpaany94100' );

/** Adresse de l’hébergement MySQL. */
define( 'DB_HOST', 'gimmicn111.mysql.db' );

/** Jeu de caractères à utiliser par la base de données lors de la création des tables. */
define( 'DB_CHARSET', 'utf8mb4' );

/**
 * Type de collation de la base de données.
 * N’y touchez que si vous savez ce que vous faites.
 */
define( 'DB_COLLATE', '' );

/**#@+
 * Clés uniques d’authentification et salage.
 *
 * Remplacez les valeurs par défaut par des phrases uniques !
 * Vous pouvez générer des phrases aléatoires en utilisant
 * {@link https://api.wordpress.org/secret-key/1.1/salt/ le service de clés secrètes de WordPress.org}.
 * Vous pouvez modifier ces phrases à n’importe quel moment, afin d’invalider tous les cookies existants.
 * Cela forcera également tous les utilisateurs à se reconnecter.
 *
 * @since 2.6.0
 */
define( 'AUTH_KEY',         '}Ys|_okXPok/2a!6`+Ly5Q~pi#=S)h}[RMWhMLoC*5{mUfN71Hr5kOT|B@a10Qb8' );
define( 'SECURE_AUTH_KEY',  '2w2^9G%WE!R>!BToNVDpQ5Z$X]MvKpO91V8Sm*!qv@$S+c.Rt=>FX?8Q->{[I<ej' );
define( 'LOGGED_IN_KEY',    'bV5^gEx_*>9&TmuShD)~o{-TLItV2*CWda0/ioa&3x9!vGvt7$ AQd0<Tpl`?iT}' );
define( 'NONCE_KEY',        'g$gTv4sK(=p0zydLZ.<[bw>+mXr6%T!!X=RB9?zhmMv)0a$>S4qp2v.9>%&wt.At' );
define( 'AUTH_SALT',        '7T6UY-;s}XR+d>{?0llo D9q2xh~JZC9$*3yh;NF@+k}xV)u! O:~Y4u`*gc5?ar' );
define( 'SECURE_AUTH_SALT', 'aGBOLK,R,3Ekk>8b#i2u)u%L@X&da>)p#cinyBg.Ze8!uT;/7~_.b^g4v<Ql5C~4' );
define( 'LOGGED_IN_SALT',   'JDo;8A3D$@oA+!)vv,k>m3)T.]Cr}DH;H3~8/e$is)xYpMSSOD)T>dyynoH*v5._' );
define( 'NONCE_SALT',       'N=q%a(:Jgb?QO3t}8}&,vK0s;j |)nmb/^$LQ1[P)Uw!4w}fVH+F@`o?HX11eY1p' );
/**#@-*/

/**
 * Préfixe de base de données pour les tables de WordPress.
 *
 * Vous pouvez installer plusieurs WordPress sur une seule base de données
 * si vous leur donnez chacune un préfixe unique.
 * N’utilisez que des chiffres, des lettres non-accentuées, et des caractères soulignés !
 */
$table_prefix = 'gs_';

/**
 * Pour les développeurs : le mode déboguage de WordPress.
 *
 * En passant la valeur suivante à "true", vous activez l’affichage des
 * notifications d’erreurs pendant vos essais.
 * Il est fortement recommandé que les développeurs d’extensions et
 * de thèmes se servent de WP_DEBUG dans leur environnement de
 * développement.
 *
 * Pour plus d’information sur les autres constantes qui peuvent être utilisées
 * pour le déboguage, rendez-vous sur le Codex.
 *
 * @link https://fr.wordpress.org/support/article/debugging-in-wordpress/
 */
define( 'WP_DEBUG', false );

/* C’est tout, ne touchez pas à ce qui suit ! Bonne publication. */

/** Chemin absolu vers le dossier de WordPress. */
if ( ! defined( 'ABSPATH' ) )
  define( 'ABSPATH', dirname( __FILE__ ) . '/' );

/** Réglage des variables de WordPress et de ses fichiers inclus. */
require_once( ABSPATH . 'wp-settings.php' );
