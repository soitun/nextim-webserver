#/bin/sh

ROOT=$PWD
cd static_src/webapi
make clean
make
cd $ROOT
echo $ROOT
make clean
make static

cd $PWD  && rm -rf static_src
