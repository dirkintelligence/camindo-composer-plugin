# camindo/composer-plugin

Composer installer for [camindo CMS](https://github.com/dirkintelligence/camindo-c9) packages.
It puts packages of type `camindo-core`, `camindo-module`, `camindo-processor` and
`camindo-extension` into `Core/`, `Modules/{Name}/`, `Processors/{Name}/` and
`Extensions/{Name}/` of the project instead of `vendor/`.

Every component package declares its directory name (StudlyCase) in its `composer.json`:

```json
{
    "name": "acme/camindo-module-blog",
    "type": "camindo-module",
    "require": { "camindo/core": "^9.1" },
    "extra": { "installer-name": "Blog" }
}
```

The `camindo/cms` skeleton requires this plugin and allows it in `config.allow-plugins`;
nothing else has to be configured. See `https://github.com/dirkintelligence/camindo-c9-docs/developers/14-installation-und-update.md`,
section 1.2, in the core repository.
