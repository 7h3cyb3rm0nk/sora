#!/bin/bash
code2prompt --exclude-folders docs/,vendor/ --exclude-files composer.json,composer.lock  . --output docs/prompt.md
