#!/usr/bin/env node

const fs = require('fs');
const path = require('path');

// Read the plugin file
const pluginFile = path.join(__dirname, '../screenly-cast/screenly-cast.php');
const pluginContent = fs.readFileSync(pluginFile, 'utf8');

// Extract version using regex
const versionMatch = pluginContent.match(/Version:\s*([0-9.]+)/);
if (!versionMatch) {
    console.error('Could not find version in plugin file');
    process.exit(1);
}

const version = versionMatch[1];

// Read package.json
const packageFile = path.join(__dirname, '../package.json');
const packageJson = require(packageFile);

// Update version if different
if (packageJson.version !== version) {
    packageJson.version = version;
    fs.writeFileSync(packageFile, JSON.stringify(packageJson, null, 2) + '\n');
    console.log(`Updated package.json version to ${version}`);
} else {
    console.log('Versions are already in sync');
}