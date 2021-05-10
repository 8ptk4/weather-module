#!/usr/bin/env bash
#
# 8ptk4/weather
#
# Integrate the WEATHER MODULE onto an existing anax installation.
#

# Copy the configuration files
rsync -av vendor/8ptk4/weather/config ./

# Copy the documentation
rsync -av vendor/8ptk4/weather/view ./
rsync -av vendor/8ptk4/weather/content ./
rsync -av vendor/8ptk4/weather/src ./
rsync -av vendor/8ptk4/weather/test ./