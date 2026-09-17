<?php
/**
 * Wohin ein camindo-Paket installiert wird - relativ zur Projektwurzel (dem
 * Verzeichnis der composer.json des Skeletts):
 *
 *     camindo-core       -> Core/
 *     camindo-module     -> Modules/{Name}/
 *     camindo-processor  -> Processors/{Name}/
 *     camindo-extension  -> Extensions/{Name}/
 *
 * {Name} kommt aus "extra": {"installer-name": "Blog"} des Pakets und muss
 * StudlyCase sein, weil Verzeichnis = Klassenname = Komponentenname. Fehlt der
 * Eintrag oder passt er nicht, wird das Paket gar nicht erst installiert.
 * Download, Ersetzen beim Update, Löschen beim Remove und den Autoload erledigt
 * LibraryInstaller - überschrieben wird nur der Zielpfad.
 */
namespace Camindo\Composer;

use Composer\Installer\LibraryInstaller;
use Composer\Package\PackageInterface;

class Installer extends LibraryInstaller
{
    private const PATHS = [
        'camindo-core'      => 'Core/',
        'camindo-module'    => 'Modules/{name}/',
        'camindo-processor' => 'Processors/{name}/',
        'camindo-extension' => 'Extensions/{name}/',
    ];

    public function supports(string $packageType): bool
    {
        return isset(self::PATHS[$packageType]);
    }

    public function getInstallPath(PackageInterface $package): string
    {
        $type = $package->getType();
        $name = (string)($package->getExtra()['installer-name'] ?? '');
        if ($type !== 'camindo-core' && !preg_match('/^[A-Z][A-Za-z0-9]*$/', $name)) {
            throw new \InvalidArgumentException(sprintf(
                '%s (%s) needs "extra": {"installer-name": "StudlyCase"} in its composer.json',
                $package->getPrettyName(), $type
            ));
        }
        return str_replace('{name}', $name, self::PATHS[$type]);
    }
}
