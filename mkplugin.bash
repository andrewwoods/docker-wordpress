#!/usr/bin/env bash

source ~/opal/bash/core.bash

##
## @see https://developer.wordpress.org/plugins/plugin-basics/header-requirements/
## @see https://developer.wordpress.org/cli/commands/scaffold/plugin/
##
function mkplugin {
    local slug

    slug="$(opal:ask "Specify the slug")"

    #--dir="wordpress/content/plugins" \
    docker compose run --rm wpcli --prompt=plugin_name,plugin_description,plugin_uri scaffold plugin \
    --plugin_author="Andrew Woods" \
    --plugin_author_uri="https://andrewwoods.net" \
    --ci="github" \
    $slug
}

mkplugin

