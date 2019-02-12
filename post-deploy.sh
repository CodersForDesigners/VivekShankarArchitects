
#! /bin/bash

while getopts "p:" opt; do
	case ${opt} in
		p )
			PROJECT_DIR=${OPTARG}
			;;
	esac
done

# Establish a symbolic link for the environment directory and its sub-folders:
rm environment
mkdir -p ../environment/${PROJECT_DIR}
ln -s ../environment/${PROJECT_DIR} environment
	# # the data folder
	rm data
	mkdir -p environment/data
	ln -s environment/data data
	# # the media folder
	rm media
	mkdir -p environment/media
	ln -s environment/media media
	# # the favicon folder
	rm favicon
	mkdir -p environment/media/favicon
	ln -s environment/media/favicon favicon
