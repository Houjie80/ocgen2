#
# Copyright (C) 2019-2024 The Sirpdboy Team <herboy2008@gmail.com>    
#
# This is free software, licensed under the Apache License, Version 2.0 .
#

include $(TOPDIR)/rules.mk
App_NAME:luci-app-ocgen
APP_TITLE:=hj ocgen
PKG_NAME:=luci-app-ocgen
LUCI_TITLE:=hj Theme by houjie
LUCI_DEPENDS:=
PKG_VERSION:=2.0.5
PKG_RELEASE:=11032024

define Package/luci-app-ocgen/postinst
#!/bin/sh

rm -f /tmp/luci-indexcache
	rm -f /tmp/luci-modulecache/*
	chmod -R 755 /usr/lib/lua/luci/controller/*
	chmod -R 755 /usr/lib/lua/luci/view/*
	chmod -R 755 /www/*
	chmod -R 755 /www/ocgen/*
	chmod 7777 /sbin/ocgen
	chmod 7777 /sbin/ocgenup
	# Autofix download index.php, index.html
	if ! grep -q ".php=/usr/bin/php-cgi" /etc/config/uhttpd; then
		echo -e "  ocgenlog : system not using php-cgi, patching php config ..."
		logger "  ocgenlog : system not using php-cgi, patching php config..."
		uci set uhttpd.main.ubus_prefix='/ubus'
		uci set uhttpd.main.interpreter='.php=/usr/bin/php-cgi'
		uci set uhttpd.main.index_page='cgi-bin/luci'
		uci add_list uhttpd.main.index_page='index.html'
		uci add_list uhttpd.main.index_page='index.php'
		uci commit uhttpd
		echo -e "  ocgenlog : patching system with php configuration done ..."
		echo -e "  ocgenlog : restarting some apps ..."
		logger "  ocgenlog : patching system with php configuration done..."
		logger "  ocgenlog : restarting some apps..."
		/etc/init.d/uhttpd restart
	fi
	[ -d /usr/lib/php8 ] && [ ! -d /usr/lib/php ] && ln -sf /usr/lib/php8 /usr/lib/php
exit 0

endef

include $(TOPDIR)/feeds/luci/luci.mk

# call BuildPackage - OpenWrt buildroot signature
