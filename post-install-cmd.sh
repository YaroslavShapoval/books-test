#!/bin/sh
if [ -n "$DYNO" ]
then
    ln -s /app/vendor/bower-asset vendor/bower
    php yii migrate --interactive=0
fi