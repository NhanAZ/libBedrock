<p align="center">
	<a href="https://github.com/NhanAZ/libBedrock">
			<img height="76" src="https://github.com/NhanAZ/libBedrock/blob/master/assets/libBedrock_Icon.png" loading="eager" />
	</a><br>
	<b>🌈 A library that provides common features for the PocketMine-MP plugin.</b>
</p>

<p align="center">
	<a href="https://github.com/NhanAZ/libBedrock/actions/workflows/ci.yml"><img src="https://github.com/NhanAZ/libBedrock/actions/workflows/ci.yml/badge.svg" alt="CI" /></a>
	<a href="https://github.com/NhanAZ/libBedrock/releases/latest"><img alt="GitHub release (latest SemVer)" src="https://img.shields.io/github/v/release/NhanAZ/libBedrock?label=release&sort=semver"></a>
	<a href="https://discord.gg/j2X83ujT6c"><img src="https://img.shields.io/discord/986553214889517088?label=discord&color=7289DA&logo=discord" alt="Discord" /></a>
</p>

<details>

<summary>Table of Contents</summary>

- [Including in other plugins](#including-in-other-plugins)
- [API documentation](#api-documentation)
- [How to contact me?](#how-to-contact-me)
- [How do I contribute to libBedrock?](#how-do-i-contribute-to-libbedrock)
- [Donate](#donate)
- [Licensing information](https://github.com/NhanAZ/libBedrock/edit/master/README.md#licensing-information)
- [Credits](#credits)

</details>

---

## Including in other plugins
Integrate the virion itself into your plugin or you could also use it as a composer library by running the command below:

`composer require nhanaz/libbedrock`

This library supports being included as a [virion](https://github.com/poggit/support/blob/master/virion.md).

If you use [Poggit](https://poggit.pmmp.io) to build your plugin, you can add it to your `.poggit.yml` like so:

```yml
--- # Poggit-CI Manifest. Open the CI at https://poggit.pmmp.io/ci/YourGithubUserName/YourPluginName
build-by-default: true
branches:
- master
projects:
  YourPluginName:
    path: ""
    libs:
      - src: NhanAZ/libBedrock/libBedrock
        version: x.y.z
...

```

## API documentation
There's no documentation yet, but you can check out the [demo plugin](https://github.com/search?q=org%3Anhanaz-pm-pl%20libBedrock&type=code)/[dependency graph](https://github.com/NhanAZ/libBedrock/network/dependents) which shows how to use its API in a plugin or read the PHPDocs written in the code.

## How to contact me?
You can contact me directly via Discord `NhanAZ` (Originally known as `NhanAZ#9115`), ping `@NhanAZ` in Discord https://discord.gg/j2X83ujT6c, email to `nhanaz@duck.com`.

## How do I contribute to libBedrock?
Before you participate in our community, please read the [Code of Conduct](https://github.com/NhanAZ/libBedrock/blob/master/CODE_OF_CONDUCT.md).

See [Contributing](https://github.com/NhanAZ/libBedrock/blob/master/CONTRIBUTING.md) for more details.

## Donate
- [PayPal](https://www.paypal.com/paypalme/NhanAZ)

## Licensing information
This project is licensed under MIT. Please see the [LICENSE](/LICENSE) file for details.

## Credits
<details>

<summary>Details</summary>

- [Contributors](https://github.com/NhanAZ/libBedrock/graphs/contributors)
- [pmmp/PocketMine-MP](https://github.com/pmmp/PocketMine-MP)
	- https://github.com/NhanAZ/libBedrock/blob/master/src/NhanAZ/libBedrock/StringToItem.php
	- https://github.com/NhanAZ/libBedrock/blob/master/SECURITY.md
	- https://github.com/NhanAZ/libBedrock/blob/master/.github/PULL_REQUEST_TEMPLATE.md
	- https://github.com/NhanAZ/libBedrock/blob/master/README.md
- [thebigcrafter/ktpmpl-cfs](https://github.com/thebigcrafter/ktpmpl-cfs)
	- https://github.com/NhanAZ/libBedrock/blob/master/src/NhanAZ/libBedrock/ConfigChecker.php
- [jasonw4331/libCustomPack](https://github.com/jasonw4331/libCustomPack)
	- https://github.com/NhanAZ/libBedrock/blob/master/src/NhanAZ/libBedrock/ResourcePackManager.php
- [thebigcrafter/oh-my-pmmp](https://github.com/thebigcrafter/oh-my-pmmp)
	https://github.com/NhanAZ/libBedrock/blob/master/.github/workflows/ci.yml
	
- [PHPStan](https://github.com/phpstan/phpstan)
- [PHP Coding Standards Fixer](https://github.com/PHP-CS-Fixer/PHP-CS-Fixer)
- [Visual Studio Code](https://code.visualstudio.com/)
- [PhpStorm](https://www.jetbrains.com/phpstorm/)

</details>
