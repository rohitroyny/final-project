<?php
// Define Vite host for local development environment
const VITE_HOST = 'http://localhost:5133';

// For a real-world example, see:
// https://github.com/wp-bond/bond/blob/master/src/Tooling/Vite.php
// https://github.com/wp-bond/boilerplate/tree/master/app/themes/boilerplate

// Consider using @vitejs/plugin-legacy if you need to support older browsers:
// https://github.com/vitejs/vite/tree/main/packages/plugin-legacy

/**
 * Generates the appropriate HTML tags to include Vite resources.
 *
 * @param string $entry The entry file path.
 * @return string HTML tags for the entry resources.
 */
function vite(string $entry): string
{
    return jsTag($entry) . "\n" . jsPreloadImports($entry) . "\n" . cssTag($entry);
}

/**
 * Determines if the application is running in a development environment.
 *
 * @param string $entry The entry file path.
 * @return bool Returns true if in development environment, otherwise false.
 */
function isDev(string $entry): bool
{
    static $exists = null;
    if ($exists !== null) {
        return $exists;
    }
    
    $handle = curl_init(VITE_HOST . '/' . $entry);
    curl_setopt($handle, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($handle, CURLOPT_NOBODY, true);

    curl_exec($handle);
    $error = curl_errno($handle);
    curl_close($handle);

    return $exists = !$error;
}

/**
 * Generates a script tag for a given JS entry file.
 *
 * @param string $entry The entry file path.
 * @return string The script tag.
 */
function jsTag(string $entry): string
{
    $url = isDev($entry) ? VITE_HOST . '/' . $entry : assetUrl($entry);

    if (!$url) {
        return ''; // Return empty if URL is not found to avoid broken links
    }

    $tag = '<script type="module" src="' . $url . '"></script>';
    return isDev($entry) ? '<script type="module" src="' . VITE_HOST . '/@vite/client"></script>' . "\n" . $tag : $tag;
}

/**
 * Generates preload links for imported modules in production.
 *
 * @param string $entry The entry file path.
 * @return string Preload link tags.
 */
function jsPreloadImports(string $entry): string
{
    if (isDev($entry)) {
        return ''; // Skip preload in development
    }

    $res = '';
    foreach (importsUrls($entry) as $url) {
        $res .= '<link rel="modulepreload" href="' . $url . '">';
    }
    return $res;
}

/**
 * Generates link tags for CSS associated with an entry file.
 *
 * @param string $entry The entry file path.
 * @return string Link tags for CSS files.
 */
function cssTag(string $entry): string
{
    if (isDev($entry)) {
        return ''; // CSS is injected by Vite in development
    }

    $tags = '';
    foreach (cssUrls($entry) as $url) {
        $tags .= '<link rel="stylesheet" href="' . $url . '">';
    }
    return $tags;
}

/**
 * Retrieves the manifest JSON from the Vite build.
 *
 * @return array Decoded manifest content.
 */
function getManifest(): array
{
    $content = file_get_contents(__DIR__ . '/dist/.vite/manifest.json');
    return json_decode($content, true);
}

/**
 * Resolves the URL to a file based on the entry point from the manifest.
 *
 * @param string $entry The entry file path.
 * @return string URL to the asset file.
 */
function assetUrl(string $entry): string
{
    $manifest = getManifest();
    return isset($manifest[$entry]) ? '/dist/' . $manifest[$entry]['file'] : '';
}

/**
 * Retrieves URLs for JS imports from the manifest.
 *
 * @param string $entry The entry file path.
 * @return array URLs of imported JS files.
 */
function importsUrls(string $entry): array
{
    $urls = [];
    $manifest = getManifest();

    if (isset($manifest[$entry]['imports'])) {
        foreach ($manifest[$entry]['imports'] as $import) {
            $urls[] = '/dist/' . $manifest[$import]['file'];
        }
    }
    return $urls;
}

/**
 * Retrieves URLs for CSS files from the manifest.
 *
 * @param string $entry The entry file path.
 * @return array URLs of CSS files.
 */
function cssUrls(string $entry): array
{
    $urls = [];
    $manifest = getManifest();

    if (isset($manifest[$entry]['css'])) {
        foreach ($manifest[$entry]['css'] as $file) {
            $urls[] = '/dist/' . $file;
        }
    }
    return $urls;
}
