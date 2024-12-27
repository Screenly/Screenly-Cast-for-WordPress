#!/bin/bash

# Exit if any command fails
set -e

# Directory containing this script
SCRIPT_DIR="$( cd "$( dirname "${BASH_SOURCE[0]}" )" && pwd )"

# Plugin root directory (one level up)
PLUGIN_DIR="$(dirname "$SCRIPT_DIR")"

# Build directory
BUILD_DIR="$PLUGIN_DIR/build"

# Clean up any existing build
rm -rf "$BUILD_DIR"
mkdir -p "$BUILD_DIR/screenly-cast"

# Ensure vendor directory exists (Docker might create it as root)
if [ -d "$PLUGIN_DIR/vendor" ]; then
    # Fix permissions if needed
    if [ ! -w "$PLUGIN_DIR/vendor" ]; then
        sudo chown -R $(id -u):$(id -g) "$PLUGIN_DIR/vendor"
    fi
fi

# Create a clean copy of the plugin
rsync -rc --exclude-from="$PLUGIN_DIR/.distignore" "$PLUGIN_DIR/screenly-cast/" "$BUILD_DIR/screenly-cast/"

# Copy assets if they exist
if [ -d "$PLUGIN_DIR/assets" ]; then
    rsync -rc "$PLUGIN_DIR/assets/" "$BUILD_DIR/assets/"
fi

# Ensure all files have correct permissions
find "$BUILD_DIR" -type d -exec chmod 755 {} \;
find "$BUILD_DIR" -type f -exec chmod 644 {} \;

echo "Build completed in: $BUILD_DIR"
echo "You can now test the distribution by copying it to your WordPress plugins directory"