git status
git checkout production
git pull

# Install all or some packages
/usr/bin/php7.4-cli ../composer.phar install

# Add changes from entities to database
/usr/bin/php7.4-cli doctrine orm:schema-tool:update --force
