<?php

$tpl = Lite::c2r([], Lite::load('error' . DS . '404'));

Lite::render($tpl);