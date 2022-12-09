git status
git checkout production
git pull

# Remove vendor for clean install
rm -rf vendor

# Install all or some packages
php composer install --no-dev

# Add changes from entities to database
php doctrine orm:schema-tool:update --force
