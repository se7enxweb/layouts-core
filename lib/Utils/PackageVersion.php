<?php

declare(strict_types=1);

namespace Netgen\Layouts\Utils;

use Composer\InstalledVersions;

/**
 * Reads the installed version of Netgen Layouts core from Composer.
 *
 * The package can be installed under two names: se7enxweb/layouts-core, the
 * fork, which replaces netgen/layouts-core, and netgen/layouts-core itself.
 * For a replaced name Composer knows no version or reference, so the fork's
 * name is tried first and the upstream name second.
 */
final class PackageVersion
{
    /**
     * @var string[]
     */
    public const array PACKAGE_NAMES = ['se7enxweb/layouts-core', 'netgen/layouts-core'];

    /**
     * Returns the name the package is installed under, or null when neither is installed.
     */
    public static function getPackageName(): ?string
    {
        foreach (self::PACKAGE_NAMES as $packageName) {
            if (
                InstalledVersions::isInstalled($packageName, false)
                && InstalledVersions::getPrettyVersion($packageName) !== null
            ) {
                return $packageName;
            }
        }

        return null;
    }

    public static function getPrettyVersion(): string
    {
        $packageName = self::getPackageName();

        return $packageName !== null ? (string) InstalledVersions::getPrettyVersion($packageName) : '';
    }

    public static function getReference(): string
    {
        $packageName = self::getPackageName();

        return $packageName !== null ? (string) InstalledVersions::getReference($packageName) : '';
    }
}
