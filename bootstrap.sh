#!/usr/bin/env bash

#
# Disables installers interactive user interface.
#

export DEBIAN_FRONTEND=noninteractive


#
# Updates packages list.
#

apt-get update


#
# Upgrades installed packages.
#

apt-get upgrade -y


#
# Creates directory for third-party applications executable files.
#

mkdir /opt/bin

export PATH=$PATH:/opt/bin


#
# Vim
#
# Installs Vim editor.
#

apt-get install -y vim


#
# NTP
#
# Installs ntp.
#

apt-get install -y ntp


#
# Apache
#
# Installs Apache with prefork MPM, enables rewrite module and creates and enables virtual host.
#

apt-get install -y apache2 apache2-mpm-prefork

# Enables rewrite_module
a2enmod rewrite

# Test App virtual host
cat << EOF > /etc/apache2/sites-available/test-app.dev.conf
<VirtualHost *:80>
	DocumentRoot /vagrant/public
	ServerName test-app.dev
	ServerAlias www.test-app.dev

	<Directory /vagrant/public>
		Options All
		AllowOverride All
		Require all granted
	</Directory>
</VirtualHost>
EOF

a2ensite test-app.dev.conf

service apache2 restart


#
# PHP
#
# Installs PHP, mcrypt module and PHP module for Apache. Sets displaying PHP's errors.
#

apt-get install -y php5 libapache2-mod-php5 php5-mcrypt

sed -i 's/^display_errors = Off/display_errors = On/' /etc/php5/apache2/php.ini
sed -i 's/^display_errors = Off/display_errors = On/' /etc/php5/cli/php.ini

php5enmod mcrypt


#
# Phalcon
#
# Compiles and activates Phalcon module for PHP and activates mcrypt module.
#

apt-get install -y php5-dev libpcre3-dev gcc make git

cd ~
git clone git://github.com/phalcon/cphalcon.git
cd ~/cphalcon/build
sudo ./install

cat << EOF > /etc/php5/mods-available/phalcon.ini
; configuration for PHP Phalcon framework module
; priority=20
extension=phalcon.so
EOF

php5enmod phalcon

service apache2 restart


#
# Xdebug
#
# Installs re2c and Xdebug extension for PHP.
#

apt-get install -y re2c

ZEND_MODULE_API_VER=$(phpize -v | grep "Zend Module Api No:" | tr -cd [:digit:])

cd ~
git clone git://github.com/xdebug/xdebug.git

cd ~/xdebug
phpize
./configure --enable-xdebug
make
cp ~/xdebug/modules/xdebug.so /usr/lib/php5/$ZEND_MODULE_API_VER/

cat << EOF > /etc/php5/mods-available/xdebug.ini
; configuration for PHP Xdebug module
; priority=20
zend_extension=/usr/lib/php5/$ZEND_MODULE_API_VER/xdebug.so
EOF

php5enmod xdebug

service apache2 restart


#
# Composer
#
# Installs Composer and get dependencies.
#

apt-get install -y curl

mkdir /opt/Composer
cd /opt/Composer
curl -sS https://getcomposer.org/installer | php
cd ~
ln -s /opt/Composer/composer.phar /opt/bin/composer

cd /vagrant
composer install

ln -s /vagrant/vendor/phpunit/phpunit/phpunit /opt/bin/phpunit

#
# Adds /opt/bin to user's PATH.
#

echo -e "\n# Add /opt/bin to user's PATH.\nexport PATH=\$PATH:/opt/bin" >> /home/vagrant/.profile