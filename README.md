# libBedrock
Common features for PocketMine-MP plugins

Integrate the virion itself into your plugin or you could also use it as a composer library by running the command below:

`composer require nhanaz/libbedrock`

## API documentation
https://github.com/NhanAZ/libBedrock/blob/master/assets/docs.md

## Including in other plugins
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

# Contact
[![Discord](https://img.shields.io/discord/986553214889517088?label=discord&color=7289DA&logo=discord)](https://discord.gg/j2X83ujT6c) [https://discord.gg/j2X83ujT6c] \
You can contact me directly via Discord `NhanAZ` (Originally known as `NhanAZ#9115`)
