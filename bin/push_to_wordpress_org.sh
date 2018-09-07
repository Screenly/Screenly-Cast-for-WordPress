#!/bin/bash
set -euo pipefail
IFS=$'\n\t'

PLUGIN_VERSION="$(head -n1 VERSION)"
GIT_HASH="$(git rev-parse --short HEAD)"

svn co \
  --quiet \
  --username "$WP_USER" \
  --password "$WP_PASS" \
  https://plugins.svn.wordpress.org/screenly-cast wp_org

if [ -d "wp_org/tags/$PLUGIN_VERSION" ]; then
  echo "Version exist. Exiting."
  exit 12
fi

# Clean out non-existing files and folders
svn delete --force wp_org/trunk/*

# Copy in new data
cp -rfv screenly-cast/* wp_org/trunk/
cp -rfv assets/* wp_org/assets/

cd wp_org
sed -i "s/VERSION_PLACEHOLDER/${PLUGIN_VERSION}/" $(find trunk -type f -iname '*.php')

svn add --force trunk
svn add --force assets

svn diff
svn cp trunk "tags/$PLUGIN_VERSION"
svn ci \
  --no-auth-cache \
  --username "$WP_USER" \
  --password "$WP_PASS" \
  -m "Adds version $PLUGIN_VERSION (git hash $GIT_HASH)"
