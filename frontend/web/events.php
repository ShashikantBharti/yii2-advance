<?php

use yii\base\Event;

function showMessage(Event $event){
    echo ucwords($event->data);
    echo 'This is global event';
}
