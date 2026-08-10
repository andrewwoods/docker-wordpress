
# Docker WordPress

__A simple Docker environment for creating a WordPress plugin or theme__

This is the minimal setup you need to get a local WordPress development environment up and running quickly. This makes it easy to create a plugin or theme. Use it to run a modern version of WordPress on an currently supported version of PHP.


## Version

The current version is 0.1.0. This project uses [semantic versioning](http://semver.org).


## Features

* Based on WordPress on 6.9 and PHP 8.3
* Quick Setup of a new WordPress Environment



## Ideas for sections/pages

* Language Translations 
* Frequently Asked Questions (FAQ)
* Screenshots
* Submit Issues

## Docker Commands

* Run `docker compose up -d` to start your containers
* Run `docker compose down` to stop your containers and _keep your data_
* Run `docker compose down -v` to stop your containers and **destroy your data**

### WordPress CLI

The WP-CLI interface has been added to the compose.yaml file. This makes it easier to administer a WordPress install.

The service name `wpcli` is needed to direct your commands to the right place. The rest of  the command is passed to WP-CLI for processing.

Retrieve a list of all plugins, and show their status.

```bash
$ docker compose run --rm wpcli plugin list
```

Show the version info and program install locations.

```bash
$ docker compose run --rm wpcli --info
```

Show the web address (URL) of your website. Note: In a docker environment, the `wpcli admin` command isn't useful, since it can't open the browser on your host. Instead, use this command to print the siteurl value, and copy/paste it into your browser.

```bash
docker compose run --rm wpcli option get siteurl
```

The `media-sizes` package has been installed for your convenience. You may want to browse the available packages to see what else interests you.

```bash
docker compose run --rm wpcli media sizes
```

Copy the wp-config.php to your host from within the container.

```bash
docker compose cp wordpress:/var/www/html/wp-config.php ./wp-config.php
```

Copy the WordPress code to your host from within the container.
Sometimes you want to read the WordPress core code. 

```bash
docker compose cp wordpress:/var/www/html ./wp-code
```

Create a WordPress plugin, prompting for certain field values.

```bash
dot:docker wpcli scaffold plugin <slug> --activate --prompt=plugin_name,plugin_description,plugin_author,plugin_author_uri
```

Use the `mkplugin.bash` script to simplify creation of new plugins. This allows you to hard-code some values, while prompting for others. This is optional. It's just here for your convenience


Check out a list of WP-CLI commands to see what it can do. Review the [WP-CLI
Handbook](https://make.wordpress.org/cli/handbook/) for access to additional
resources.

## Installation

* Clone this template repo from Github
* Run `docker compose up -d` 
* Access the site at `http://localhost:8080` 
* Complete the standard WordPress Install process
* [Create a Git Ignore](https://www.gitignore.io/) file
    - Add the phpdocs directory to your .gitignore file
    - Add Editor-specific files to your .gitignore ( .swp for Vim, .idea for PHPStorm, etc. )
* Select an [Open Source License](http://opensource.org/licenses) and copy it to LICENSE.txt
* Update [CONTRIBUTING.md](docs/CONTRIBUTING.md) to match your project needs

### Optional Installation

* Read [additional instructions](https://hub.docker.com/_/wordpress) 


## Resources

### WordPress

* [WordPress Plugin Header Requirements](https://developer.wordpress.org/plugins/plugin-basics/header-requirements/)
* [WP-CLI Scaffold Plugin Docs](https://developer.wordpress.org/cli/commands/scaffold/plugin/)

### General

* [Semantic Versioning](http://semver.org)
* [GitHub Markdown](https://docs.github.com/en/get-started/writing-on-github/getting-started-with-writing-and-formatting-on-github/basic-writing-and-formatting-syntax)
* [Contributing Guidelines](https://help.github.com/articles/setting-guidelines-for-repository-contributors/)
* [Changelog](docs/CHANGELOG.md)
* [Humans TXT](http://humanstxt.org/) 
* [Robots TXT](http://www.robotstxt.org/) 
* [Git Ignore Generator](https://www.gitignore.io/)
* [Open Source Licenses](http://opensource.org/licenses/GPL-3.0)



## Credits and Acknowledgments

* Project Creator:  [Andrew Woods](https://andrewwoods.net)

