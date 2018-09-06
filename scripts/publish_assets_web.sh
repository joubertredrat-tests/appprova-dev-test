#!/usr/bin/env bash

ASSETS=(jquery semantic-ui-css toastr)

# Do not edit below

ROOT_FOLDER=$(pwd)
WEB_FOLDER=$ROOT_FOLDER/web
ASSETS_FOLDER=$WEB_FOLDER/assets/vendor
NODEJS_FOLDER=$ROOT_FOLDER/node_modules

rm -Rf $ASSETS_FOLDER
mkdir -p $ASSETS_FOLDER

for asset_folder in ${ASSETS[@]}; do
	ln -s $NODEJS_FOLDER/${asset_folder} $ASSETS_FOLDER/${asset_folder}
	echo "${asset_folder} installed"
done

echo -e "\e[32mAssets published\e[39m"

exit 0