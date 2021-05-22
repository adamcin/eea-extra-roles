#!/usr/bin/env bash
readonly basedir="$(cd "$(dirname "${BASH_SOURCE[0]}")" && pwd)"
plugin="$(basename "${basedir}")"
pushd .. || exit 1
zipfile="${plugin}.zip"
[[ -f "${zipfile}" ]] && rm -f "${zipfile}"
zip "${zipfile}" "${plugin}/" "${plugin}/"*.php "${plugin}/"*.md