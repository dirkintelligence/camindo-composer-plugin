# camindo/composer-plugin

Composer installer for [camindo CMS](https://github.com/dirkintelligence/camindo-cms)
packages. It puts camindo packages into the directories of the project instead of
`vendor/`:

| Package type | Installed into |
|---|---|
| `camindo-core` (the core, `camindo/cms`) | `Core/` |
| `camindo-module` | `Modules/{Name}/` |
| `camindo-processor` | `Processors/{Name}/` |
| `camindo-extension` | `Extensions/{Name}/` |

> Deutsch: Das Plugin legt die Pakete von camindo CMS (Core, Module, Prozessoren,
> Extensions) in die passenden Verzeichnisse des Projekts statt nach `vendor/`.

## Usage

Nothing to do: the project skeleton [`camindo/project`](https://packagist.org/packages/camindo/project)
requires this plugin and allows it in `config.allow-plugins`.

```bash
composer create-project camindo/project mysite
```

In a project without the skeleton:

```bash
composer config allow-plugins.camindo/composer-plugin true
composer require camindo/composer-plugin camindo/cms
```

## Writing a component

Every component package declares its type and its directory name (StudlyCase) in
`composer.json`. Composer enforces lowercase package names, but the directory is the
class and component name, so `extra.installer-name` is mandatory – without a valid
entry the plugin refuses to install the package.

```json
{
    "name": "acme/camindo-module-blog",
    "type": "camindo-module",
    "require": { "camindo/cms": "^9.0" },
    "extra": { "installer-name": "Blog" }
}
```

Download, replacement on update, removal and autoloading are handled by Composer's
`LibraryInstaller`; the plugin only determines the target path. Background and the
release process for components: chapters 09 and 10 of the
[developer documentation](https://github.com/dirkintelligence/camindo-developer-docs).

## Requirements

- PHP 8.1 or newer
- Composer 2 (`composer-plugin-api` ^2.0)

## Versioning

Versions are Git tags (`v1.0.0`); there is no `version` field in `composer.json`.
The major version changes only when `composer-plugin-api` changes (Composer 3) or the
target directories change. A published tag is never moved.

## Security

Please report vulnerabilities privately as described in the
[security policy of camindo CMS](https://github.com/dirkintelligence/camindo-cms/security/policy).

## License

MIT – see [LICENSE](LICENSE). camindo CMS itself is licensed under the AGPL v3 or later.
