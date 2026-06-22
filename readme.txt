=== Ar Design Packing Slip Download Fix ===
Contributors: arpad70
Requires at least: 6.7
Tested up to: 6.9.4
Requires PHP: 8.0
Stable tag: 0.1.2
License: GPLv2
License URI: https://www.gnu.org/licenses/gpl-2.0.txt

Pridava tlacitko pro stazeni dodaciho listu do detailu WooCommerce objednavky.

== Description ==

Plugin rozsiruje administraci WooCommerce objednavky o tlacitko pro stazeni jiz vygenerovaneho dodaciho listu.
Je urceny jako doplnkova integrace k workflow kolem WPO/WCPDF a internich AR Design procesu.
Plugin deklaruje kompatibilitu s WooCommerce HPOS a startuje Woo-specific runtime az po `woocommerce_loaded`.

== Installation ==

1. Nahrajte plugin do adresare `/wp-content/plugins/`.
2. Aktivujte plugin v administraci WordPressu.
3. Overte, ze generovani dodacich listu funguje v navazujicim PDF pluginu.

== Changelog ==

= 0.1.1 =
* Standardizovan build a release pipeline cez `VERSION`, `.distignore`, `scripts/build-plugin.sh` a GitHub workflow.
* Zachovane WooCommerce metadata, HPOS deklaracia a oneskoreny Woo runtime bootstrap cez `woocommerce_loaded`.

= 0.1.0 =
* Prvni verze pluginu.
* Doplnen WordPress-standard `readme.txt`.
* Doplnena WooCommerce metadata a HPOS deklarace.
