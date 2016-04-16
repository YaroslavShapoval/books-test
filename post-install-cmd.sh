#!/bin/sh
if [ -n "$DYNO" ]
then
    ln -s /app/vendor/bower-asset vendor/bower
    ln -s /app/uploads web/uploads
    php yii migrate --interactive=0
fi