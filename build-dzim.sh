#!/bin/sh
NAME="dzim_1.3.0_beta"
rm -rf $NAME.zip
rm -rf webim
cp -R bbs webim
cd webim  && find . -name .svn |xargs rm -rf && ./build.sh && rm -rf static_src
cd ..
zip -r $NAME.zip webim
