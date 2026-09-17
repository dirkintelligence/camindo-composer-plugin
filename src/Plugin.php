<?php
/**
 * camindo/composer-plugin - registriert den Installer für die camindo-Pakettypen.
 *
 * Composer lädt Plugins vor allen anderen Paketen; deshalb liegt dieser Code in
 * einem eigenen Paket und nicht im Core. Das Skelett camindo/cms verlangt ihn
 * (require + config.allow-plugins), Zusatzkomponenten nicht - sie werden von ihm
 * installiert. Siehe docs/developers/14-installation-und-update.md, 1.2, im Core.
 */
namespace Camindo\Composer;

use Composer\Composer;
use Composer\IO\IOInterface;
use Composer\Plugin\PluginInterface;

class Plugin implements PluginInterface
{
    public function activate(Composer $composer, IOInterface $io): void
    {
        $composer->getInstallationManager()->addInstaller(new Installer($io, $composer));
    }

    public function deactivate(Composer $composer, IOInterface $io): void
    {
    }

    public function uninstall(Composer $composer, IOInterface $io): void
    {
    }
}
