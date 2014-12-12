OXIMA Main Web Project
=====================================

Trial Credits
----------------
- taufik (taufik.oxima@gmail.com)
- yovie (yovi.oxima@gmail.com)
- azkal (azkal.oxima@gmail.com)
- oximaproject@gmail.com

List libraries
----------------
- Layout
	- setLayout($layout)
	- view($view, $data=null, $return=false)

List helpers
----------------
- layout_helper
	- route_url($controller, $action, $params=array())
	- route_url_id($module_id, $params=array())
	- get_mainmenu($position)
	- get_submenu($menu_id)
	- generate_menu($position)
	- web_content($key)
- session_helper
	- get_user()
	- encode_id($table_id)
	- decode_id($decode_string)
	- test_id($decode_result)
- settings_helper
	- load_settings()

List constants
----------------
- LAYOUT (oxima)
- APPTITLE (Oxima)
- LANG (id)


Notes
----------------
- pin expire 3 bulan
- notification history
- syslog

SMS
----------------
- sukses register
- bonus akumulasi
- notif pin buat stokis
- withdraw & repet order
- update profil
- event


TODO
----------------
- export ke excel masuk ke report
- mapping member
- mekanisme backup data
- ada pencatatan resume jumlah member yang dia ajak


Other Info
----------------
Poin ketika repeat order yang dapet cuma satu parent sponsor nya aza

semua bisa RO
ketika member gabung dia langsung dapat bonus tambahan
member bisa menggunakan keseluruha bonus tambahan & bonus titik untuk RO
ketika stokis jual barang harus ada status apakah member sudah lunas atau belum
- bonus
- poin
- promo

register jadi aktivasi
login bisa username n password atau pin n idbarang
proses reserved pin, stokis hanya diberi idbarang, pin diambil secara acak ketika ada member yg beli

yang direserved cukup idbarang
pin diambil oleh stokis, ketika ada idbarang yang terjual
