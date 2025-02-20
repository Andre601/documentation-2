<?php
/**
 * This is a simple example for creating icon bundles for Iconify components.
 *
 * It bundles only icons from Iconify JSON files.
 * For more advanced examples see other code examples in documentation.
 *
 * See Iconify Tools documentation on how to convert custom icons to Iconify JSON format:
 * https://docs.iconify.design/tools/node/import.html
 */

require './vendor/autoload.php';

// Installation: composer require iconify/json-tools
use Iconify\JSONTools\Collection;

// Iconify component (this changes import statement in generated file)
// Available options: '@iconify/react' for React, '@iconify/vue' for Vue 3, '@iconify/vue2' for Vue 2, '@iconify/svelte' for Svelte
$component = '@iconify/react';

// Set to true to use require() instead of import
$commonJS = false;

// File to save bundle to
$target = 'assets/icons-bundle.js';

// JSON files location. Filename inside directory must match prefix. For example, for "line-md" prefix icons should be stored in "line-md.json"
$source = 'json';

// Icons to bundle, array
$icons = [
    'line-md:home-twotone-alt',
    'line-md:github',
    'line-md:image-twotone',
    'octicon:book-24',
    'octicon:code-square-24',
];

// Organize icons by prefix
$icons = organizeIconsList($icons);

// Load icons data
$output = $commonJS ? "const { addCollection } = require('$component');\n\n" : "import { addCollection } from '$component';\n\n";
foreach ($icons as $prefix => $iconsList) {
    // Load icon set
    $collection = new Collection($prefix);
    if (!$collection->loadFromFile($source . '/' . $prefix . '.json')) {
        throw new Error('Cannot find file "' . $prefix . '.json"');
    }

    // Make sure all icons exist
    foreach ($iconsList as $name) {
        if (!$collection->iconExists($name)) {
            // Uncomment next line to throw error if an icon does not exist
            // throw new Error('Could not find icon: "' . $prefix . ':' . $name . '"');
            echo 'Could not find icon: "', $prefix, ':', $name, "\"\n";
        }
    }

    // Get data for all icons as string
    $output .= $collection->scriptify([
        'icons' => $iconsList,
        'callback' => 'addCollection',
        'optimize' => true,
    ]);
}

// Save to file
file_put_contents($target, $output);

echo 'Saved ', $target, ' (', strlen($output), " bytes)\n";

/**
 * Organize icons list by prefix
 *
 * Result is an object, where key is prefix, value is array of icon names
 */
function organizeIconsList($icons)
{
    $results = [];

    foreach ($icons as $str) {
        // Split icon to prefix and name
        $icon = stringToIcon($str);
        if ($icon === null || $icon['provider'] !== '') {
            // Invalid name or icon name has provider.
            // All icons in this example are from Iconify, so providers are not supported.
            throw new Error('Invalid icon name: ' . $str);
        }

        $prefix = $icon['prefix'];
        $name = $icon['name'];

        // Add icon to results
        if (!isset($results[$prefix])) {
            $results[$prefix] = [$name];
            continue;
        }
        if (!in_array($name, $results[$prefix])) {
            $results[$prefix][] = $name;
        }
    }

    return $results;
}

/**
 * Convert icon name from string to object.
 *
 * Object properties:
 * - provider (ignored in this example)
 * - prefix
 * - name
 *
 * This function was converted to PHP from @iconify/utils/src/icon/name.ts
 * See https://github.com/iconify/iconify/blob/master/packages/utils/src/icon/name.ts
 */
function stringToIcon($value)
{
    $provider = '';
    $colonSeparated = explode(':', $value);

    // Check for provider with correct '@' at start
    if (substr($value, 0, 1) === '@') {
        // First part is provider
        if (count($colonSeparated) < 2 || count($colonSeparated) > 3) {
            // "@provider:prefix:name" or "@provider:prefix-name"
            return null;
        }
        $provider = substr(array_shift($colonSeparated), 1);
    }

    // Check split by colon: "prefix:name", "provider:prefix:name"
    if (count($colonSeparated) > 3 || !count($colonSeparated)) {
        return null;
    }
    if (count($colonSeparated) > 1) {
        // "prefix:name"
        $name = array_pop($colonSeparated);
        $prefix = array_pop($colonSeparated);
        return [
            // Allow provider without '@': "provider:prefix:name"
            'provider' => count($colonSeparated) > 0 ? $colonSeparated[0] : $provider,
            'prefix' => $prefix,
            'name' => $name,
        ];
    }

    // Attempt to split by dash: "prefix-name"
    $dashSeparated = explode('-', $colonSeparated[0]);
    if (count($dashSeparated) > 1) {
        return [
            'provider' => $provider,
            'prefix' => array_shift($dashSeparated),
            'name' => implode('-', $dashSeparated),
        ];
    }

    return null;
}
