<?php
Yii::setAlias('@common', dirname(__DIR__));
Yii::setAlias('@frontend', dirname(dirname(__DIR__)) . '/frontend');
Yii::setAlias('@backend', dirname(dirname(__DIR__)) . '/backend');
Yii::setAlias('@console', dirname(dirname(__DIR__)) . '/console');

# Dev Alias Set-up
Yii::setAlias('@mFrontEnd', 'http://fr.ppei.io');
Yii::setAlias('@mBackEnd', 'http://bk.ppei.io');
