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

Proses Penambahan Titik
-----------------------
Ketika ada member yang beli barang lagi ke sponsor, maka titiknya harus ada dibawah
titik punya dirinya sendiri, titiknya harus berada pada jaringan punya dirinya.

Array
(
    [idbarang] => Array
        (
            [0] => IvM7%7EU00F.8Nmu8gUO9pqQdTYivWPlecSv47z6hyR4miLl.sYqWdokuS.GgwPZUrpe9MRvxJ8EWlboQyiHurqg--
            [1] => hf6XZUBqGJ5WWAoWrRzj9y2xdDDP1mkuPJK6QVhHbIN1WwAzbKfceRPJGPbK7hjYyNnsRnDAWk0FjIu18IW2Ow--
            [2] => 0CeIZaDBM2uuALtD13LJI%7EKzeV26.lC5kbSxaN18489EFVt9tkn9fGRU3KSrT5VhRsWbiQoQD0urNyYz3UxQTw--
        )

    [biaya] => 50000
    [stokis_pin] => adsadsa234
    [name1] => ada
    [ktp] => apa
    [bank] => dengan
    [norek] => cinta
    [namarek] => saja
    [pin] => Array
        (
            [0] => 4dFlXLZVQ3au2v0FEW3Gf15cgy1Bb5acCaiICEYzgunGtmdd7NPohin9N3UnWLKSSM7M1ThItdPdAC2.1exWVQ--
        )

    [name2] => 
    [alamat] => 
    [kontak] => 
    [mode] => gabung
    [member_id] => ?
)


truncate table user_sponsor;
truncate table parent_childs;
delete from titiks;

